<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\OutgoingLetter;
use Illuminate\Http\Request;

class AdminOutgoingLetterController extends Controller
{
    /**
     * Display a listing of outgoing letters.
     */
    public function index(Request $request)
    {
        $query = OutgoingLetter::with('submittedBy')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('purpose', 'like', "%{$search}%")
                  ->orWhere('addressed_to', 'like', "%{$search}%")
                  ->orWhere('related_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('letter_type', $request->type);
        }

        $letters = $query->paginate(10)->withQueryString();

        return view('admin.outgoing-letters.index', compact('letters'));
    }

    /**
     * Display the specified outgoing letter.
     */
    public function show(string $id)
    {
        $letter = OutgoingLetter::with('submittedBy', 'approvedBy')->findOrFail($id);

        return view('admin.outgoing-letters.show', compact('letter'));
    }

    /**
     * Show the processing form for a draft letter.
     */
    public function edit(string $id)
    {
        $letter = OutgoingLetter::with('submittedBy')->findOrFail($id);

        if ($letter->status !== 'draft') {
            abort(403);
        }

        return view('admin.outgoing-letters.process', compact('letter'));
    }

    /**
     * Process the letter: assign letter_number and letter_date, forward to pimpinan.
     */
    public function update(Request $request, string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->status !== 'draft') {
            abort(403);
        }

        $validated = $request->validate([
            'letter_number' => 'required|string|max:50',
            'letter_date'   => 'required|date',
        ]);

        $letter->update([
            'letter_number' => $validated['letter_number'],
            'letter_date'   => $validated['letter_date'],
            'status'        => 'pending_approval',
        ]);

        Notification::create([
            'user_id' => $letter->created_by,
            'title'   => 'Letter Being Processed',
            'message' => 'Your letter "' . $letter->purpose . '" is now pending approval from leadership.',
            'is_read' => false,
        ]);

        return redirect()->route('admin.outgoing-letters.index')
                         ->with('success', 'Letter has been forwarded to Pimpinan for approval.');
    }

    /**
     * Mark an approved letter as sent.
     */
    public function markSent(string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->status !== 'approved') {
            abort(403);
        }

        $letter->update(['status' => 'sent']);

        Notification::create([
            'user_id' => $letter->created_by,
            'title'   => 'Letter Sent',
            'message' => 'Your letter "' . $letter->purpose . '" has been officially sent.',
            'is_read' => false,
        ]);

        return redirect()->route('admin.outgoing-letters.index')
                         ->with('success', 'Letter has been marked as sent and archived.');
    }
}
