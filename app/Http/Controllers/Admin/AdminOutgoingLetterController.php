<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessOutgoingLetterRequest;
use App\Http\Requests\RejectOutgoingLetterRequest;
use App\Models\Notification;
use App\Models\OutgoingLetter;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOutgoingLetterController extends Controller
{
    /**
     * Display a listing of outgoing letters.
     */
    public function index(Request $request)
    {
        $query = OutgoingLetter::with('createdBy');

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

        $letters = $query->sortByUrgency()
                         ->orderBy('created_at', 'asc')
                         ->paginate(10)->withQueryString();

        return view('admin.outgoing-letters.index', compact('letters'));
    }

    /**
     * Display the specified outgoing letter.
     */
    public function show(string $id)
    {
        $letter = OutgoingLetter::with('createdBy', 'approvedBy')->findOrFail($id);

        return view('admin.outgoing-letters.show', compact('letter'));
    }

    /**
     * Show the processing form for a draft letter.
     */
    public function edit(string $id)
    {
        $letter = OutgoingLetter::with('createdBy')->findOrFail($id);

        if ($letter->status !== 'draft') {
            abort(403);
        }

        return view('admin.outgoing-letters.process', compact('letter'));
    }

    /**
     * Process the letter: assign letter_number and letter_date, forward for approval.
     */
    public function update(ProcessOutgoingLetterRequest $request, string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->status !== 'draft') {
            abort(403);
        }

        $validated = $request->validated();

        $letter->update([
            'letter_number' => $validated['letter_number'],
            'letter_date'   => $validated['letter_date'],
            'status'        => 'pending_approval',
        ]);

        return redirect()->route('admin.outgoing-letters.index')
                         ->with('success', 'Surat berhasil diteruskan untuk persetujuan.');
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

        return redirect()->route('admin.outgoing-letters.index')
                         ->with('success', 'Surat berhasil ditandai sebagai terkirim dan diarsipkan.');
    }
    /**
     * Show the approval review page for a pending letter.
     */
    public function reviewApproval(string $id)
    {
        $letter = OutgoingLetter::with('createdBy')->findOrFail($id);

        if ($letter->status !== 'pending_approval') {
            abort(403);
        }

        return view('admin.outgoing-letters.approve', compact('letter'));
    }

    /**
     * Approve the letter.
     */
    public function approve(Request $request, string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->status !== 'pending_approval') {
            abort(403);
        }

        $letter->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        return redirect()->route('admin.outgoing-letters.show', $letter->id)
                         ->with('success', 'Surat berhasil disetujui.');
    }

    /**
     * Reject the letter.
     */
    public function reject(RejectOutgoingLetterRequest $request, string $id)
    {
        $letter = OutgoingLetter::findOrFail($id);

        if ($letter->status !== 'draft' && $letter->status !== 'pending_approval') {
            abort(403);
        }

        $validated = $request->validated();

        $letter->update([
            'status' => 'rejected',
            'rejection_note' => $validated['rejection_note'],
        ]);

        return redirect()->route('admin.outgoing-letters.show', $letter->id)
                         ->with('success', 'Surat berhasil ditolak.');
    }

    /**
     * Print the letter using the appropriate template.
     */
    public function print(string $id)
    {
        $letter = OutgoingLetter::with('approvedBy')->findOrFail($id);

        if (!in_array($letter->status, ['approved', 'sent'])) {
            abort(403);
        }

        $admin = $letter->approvedBy ?? User::where('role', 'admin')->first();

        $template = match ($letter->letter_type) {
            'recommendation'     => 'templates.surat_rekomendasi',
            'active_certificate' => 'templates.surat_keterangan_aktif',
            'assignment'         => 'templates.surat_tugas',
        };

        return view($template, compact('letter', 'admin'));
    }
}
