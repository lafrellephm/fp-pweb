<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mark all unread notifications as read automatically
        auth()->user()->notifications()->where('is_read', false)->update(['is_read' => true]);

        $notifications = auth()->user()->notifications()
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);
                            
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markRead(string $id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }
}
