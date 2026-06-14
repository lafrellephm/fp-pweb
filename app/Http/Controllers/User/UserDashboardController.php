<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OutgoingLetter;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard with letter statistics.
     */
    public function index()
    {
        $userId = auth()->id();

        $totalLetters = OutgoingLetter::where('created_by', $userId)->count();
        $draftCount = OutgoingLetter::where('created_by', $userId)
            ->where('status', 'draft')->count();
        $pendingCount = OutgoingLetter::where('created_by', $userId)
            ->where('status', 'pending_approval')->count();
        $approvedCount = OutgoingLetter::where('created_by', $userId)
            ->whereIn('status', ['approved', 'sent'])->count();

        $recentLetters = OutgoingLetter::where('created_by', $userId)
            ->latest()->take(5)->get();

        // Check for unread approval/rejection notification for popup
        $popupNotification = auth()->user()->notifications()
            ->where('is_read', false)
            ->whereIn('title', ['Surat Disetujui', 'Surat Ditolak'])
            ->latest()
            ->first();

        if ($popupNotification) {
            $popupNotification->update(['is_read' => true]);
        }

        return view('user.dashboard', compact(
            'totalLetters',
            'draftCount',
            'pendingCount',
            'approvedCount',
            'recentLetters',
            'popupNotification'
        ));
    }
}
