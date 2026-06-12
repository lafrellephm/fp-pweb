<?php

namespace App\Helpers;

use App\Mail\NotificationMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class NotificationHelper
{
    /**
     * Create an in-app notification and send an email via Mailpit.
     */
    public static function send(User $user, string $title, string $message): void
    {
        // 1. Create the in-app notification record
        Notification::create([
            'user_id' => $user->id,
            'title'   => $title,
            'message' => $message,
            'is_read' => false,
        ]);

        // 2. Attempt to send an email notification
        try {
            Mail::to($user->email)->send(new NotificationMail($title, $message));
        } catch (Throwable $e) {
            // Log the error but do not throw exception or break HTTP response
            Log::error('Failed to send notification email: ' . $e->getMessage());
        }
    }
}
