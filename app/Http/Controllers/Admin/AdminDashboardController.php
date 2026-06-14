<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalIncoming     = IncomingLetter::count();
        $pendingApproval   = OutgoingLetter::where('status', 'draft')->count();
        $totalSent         = OutgoingLetter::where('status', 'sent')->count();

        $recentLetters = OutgoingLetter::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalIncoming',
            'pendingApproval',
            'totalSent',
            'recentLetters'
        ));
    }
}
