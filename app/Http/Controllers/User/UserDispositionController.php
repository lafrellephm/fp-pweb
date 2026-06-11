<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Disposition;
use Illuminate\Http\Request;

class UserDispositionController extends Controller
{
    /**
     * Display dispositions assigned to the current user.
     */
    public function index()
    {
        $dispositions = Disposition::with('incomingLetter')
            ->where('assigned_to', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.dispositions.index', compact('dispositions'));
    }

    /**
     * Update the status of a disposition.
     */
    public function updateStatus(Request $request, string $id)
    {
        $disposition = Disposition::findOrFail($id);

        if ($disposition->assigned_to !== auth()->id()) {
            abort(403);
        }

        $rules = [
            'status' => 'required|in:read,completed',
        ];

        if ($request->input('status') === 'completed') {
            $rules['reply_note'] = 'required|string|max:2000';
        }

        $validated = $request->validate($rules);

        $disposition->status = $validated['status'];

        if (isset($validated['reply_note'])) {
            $disposition->reply_note = $validated['reply_note'];
        }

        $disposition->save();

        return redirect()->back()->with('success', 'Status disposisi berhasil diperbarui.');
    }
}
