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

        $totalLetters  = OutgoingLetter::where('created_by', $userId)->count();
        $draftCount    = OutgoingLetter::where('created_by', $userId)
                            ->where('status', 'draft')->count();
        $pendingCount  = OutgoingLetter::where('created_by', $userId)
                            ->where('status', 'pending_approval')->count();
        $approvedCount = OutgoingLetter::where('created_by', $userId)
                            ->whereIn('status', ['approved', 'sent'])->count();

        $recentLetters = OutgoingLetter::where('created_by', $userId)
                            ->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'totalLetters',
            'draftCount',
            'pendingCount',
            'approvedCount',
            'recentLetters'
        ));
    }
}
