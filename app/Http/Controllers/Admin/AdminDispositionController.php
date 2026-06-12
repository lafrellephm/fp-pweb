<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDispositionRequest;
use App\Models\Disposition;
use App\Models\IncomingLetter;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDispositionController extends Controller
{
    /**
     * Display a listing of dispositions.
     */
    public function index(Request $request)
    {
        $query = Disposition::with(['incomingLetter', 'assignedTo']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('incomingLetter', function ($sub) use ($search) {
                    $sub->where('subject', 'like', "%{$search}%");
                })->orWhereHas('assignedTo', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                });
            });
        }

        $dispositions = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dispositions.index', compact('dispositions'));
    }

    /**
     * Show the form for creating a new disposition.
     */
    public function create(Request $request)
    {
        $incomingLetters = IncomingLetter::whereIn('status', ['unassigned', 'assigned'])
            ->latest()
            ->get();

        $users = User::where('role', 'user')->orderBy('name')->get();

        $selectedLetterId = $request->query('incoming_letter_id');

        return view('admin.dispositions.create', compact('incomingLetters', 'users', 'selectedLetterId'));
    }

    /**
     * Store a newly created disposition.
     */
    public function store(StoreDispositionRequest $request)
    {
        $validated = $request->validated();

        $validated['assigned_by'] = auth()->id();
        $validated['status'] = 'unread';

        Disposition::create($validated);

        // Update the incoming letter status to assigned
        $incomingLetter = IncomingLetter::find($validated['incoming_letter_id']);
        $incomingLetter->update(['status' => 'assigned']);

        // Create notification for the assigned user
        $user = User::find($validated['assigned_to']);
        if ($user) {
            \App\Helpers\NotificationHelper::send(
                $user,
                'Disposisi Baru',
                'Anda mendapat disposisi baru untuk surat: ' . $incomingLetter->subject
            );
        }

        return redirect()->route('admin.dispositions.index')
                         ->with('success', 'Disposisi berhasil dibuat.');
    }

    /**
     * Remove the specified disposition.
     */
    public function destroy(string $id)
    {
        $disposition = Disposition::findOrFail($id);
        $disposition->delete();

        return redirect()->back()->with('success', 'Disposisi berhasil dihapus.');
    }
}
