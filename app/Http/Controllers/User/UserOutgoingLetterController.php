<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutgoingLetterRequest;
use App\Http\Requests\UpdateOutgoingLetterRequest;
use App\Models\OutgoingLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserOutgoingLetterController extends Controller
{
    /**
     * Display a listing of the user's outgoing letters.
     */
    public function index(Request $request)
    {
        $query = OutgoingLetter::where('created_by', auth()->id());

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

        $letters = $query->latest()->paginate(10)->withQueryString();

        return view('user.outgoing-letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new outgoing letter.
     */
    public function create()
    {
        return view('user.outgoing-letters.create');
    }

    /**
     * Store a newly created outgoing letter.
     */
    public function store(StoreOutgoingLetterRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('outgoing-letters', 'public');
        }

        $data['created_by']     = auth()->id();
        $data['status']         = 'draft';
        $data['letter_number']  = null;
        $data['letter_date']    = null;
        $data['approved_by']    = null;
        $data['rejection_note'] = null;

        // For non-assignment types, explicitly null out event fields
        if ($data['letter_type'] !== 'assignment') {
            $data['event_name']     = null;
            $data['event_date']     = null;
            $data['event_location'] = null;
        }

        OutgoingLetter::create($data);

        if ($data['urgency'] === 'critical') {
            $admin = \App\Models\User::where('role', 'admin')->first();
            if ($admin) {
                \App\Helpers\NotificationHelper::send(
                    $admin,
                    'Surat Kritis Masuk',
                    'Surat dengan tingkat urgensi kritis telah diajukan oleh pengguna dan memerlukan perhatian segera.'
                );
            }
        }

        return redirect()->route('user.outgoing-letters.index')
                         ->with('success', 'Surat berhasil diajukan.');
    }

    /**
     * Display the specified outgoing letter.
     */
    public function show(string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->created_by !== auth()->id()) {
            abort(403);
        }

        return view('user.outgoing-letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified outgoing letter.
     */
    public function edit(string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->created_by !== auth()->id()) {
            abort(403);
        }

        if ($letter->status !== 'draft') {
            abort(403);
        }

        return view('user.outgoing-letters.edit', compact('letter'));
    }

    /**
     * Update the specified outgoing letter.
     */
    public function update(UpdateOutgoingLetterRequest $request, string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->created_by !== auth()->id()) {
            abort(403);
        }

        if ($letter->status !== 'draft') {
            abort(403);
        }

        $data = $request->validated();

        if ($request->hasFile('file_path')) {
            // Delete old file if exists
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('outgoing-letters', 'public');
        }

        // For non-assignment types, explicitly null out event fields
        if ($data['letter_type'] !== 'assignment') {
            $data['event_name']     = null;
            $data['event_date']     = null;
            $data['event_location'] = null;
        }

        // Do NOT change status, created_by, letter_number, letter_date, approved_by
        unset($data['status'], $data['created_by'], $data['letter_number'], $data['letter_date'], $data['approved_by']);

        $letter->update($data);

        return redirect()->route('user.outgoing-letters.show', $letter->id)
                         ->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Remove the specified outgoing letter.
     */
    public function destroy(string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->created_by !== auth()->id()) {
            abort(403);
        }

        if ($letter->status !== 'draft') {
            abort(403);
        }

        // Delete the file from storage if it exists
        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }

        $letter->delete();

        return redirect()->route('user.outgoing-letters.index')
                         ->with('success', 'Surat berhasil dihapus.');
    }

    /**
     * Print the user's letter using the appropriate template.
     */
    public function print(string $id)
    {
        $letter = OutgoingLetter::with('approvedBy')->findOrFail($id);

        if ($letter->created_by !== auth()->id()) {
            abort(403);
        }

        if (!in_array($letter->status, ['approved', 'sent'])) {
            abort(403);
        }

        $admin = $letter->approvedBy ?? \App\Models\User::where('role', 'admin')->first();

        $template = match ($letter->letter_type) {
            'recommendation'     => 'templates.surat_rekomendasi',
            'active_certificate' => 'templates.surat_keterangan_aktif',
            'assignment'         => 'templates.surat_tugas',
        };

        return view($template, compact('letter', 'admin'));
    }
}
