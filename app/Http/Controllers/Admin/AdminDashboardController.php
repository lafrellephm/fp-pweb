<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Disposition;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalIncoming     = IncomingLetter::count();
        $pendingApproval   = OutgoingLetter::where('status', 'pending_approval')->count();
        $activeDisposition = Disposition::where('status', '!=', 'completed')->count();
        $totalSent         = OutgoingLetter::where('status', 'sent')->count();

        return view('admin.dashboard', compact(
            'totalIncoming',
            'pendingApproval',
            'activeDisposition',
            'totalSent'
        ));
    }
}
