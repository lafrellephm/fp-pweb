<?php

namespace App\Observers;

use App\Models\OutgoingLetter;
use App\Models\User;
use App\Helpers\NotificationHelper;

class OutgoingLetterObserver
{
    /**
     * Handle the OutgoingLetter "created" event.
     */
    public function created(OutgoingLetter $outgoingLetter): void
    {
        if ($outgoingLetter->urgency === 'critical') {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                NotificationHelper::send(
                    $admin,
                    'Surat Kritis Masuk',
                    'Surat dengan tingkat urgensi kritis telah diajukan oleh pengguna dan memerlukan perhatian segera.'
                );
            }
        }
    }

    /**
     * Handle the OutgoingLetter "updated" event.
     */
    public function updated(OutgoingLetter $outgoingLetter): void
    {
        if ($outgoingLetter->wasChanged('status')) {
            $status = $outgoingLetter->status;
            $user = User::find($outgoingLetter->created_by);

            if ($user) {
                $title = '';
                $message = '';

                if ($status === 'pending_approval') {
                    $title = 'Surat Sedang Diproses';
                    $message = 'Surat Anda "' . $outgoingLetter->purpose . '" telah diproses admin dan sedang menunggu persetujuan pimpinan.';
                } elseif ($status === 'approved') {
                    $title = 'Surat Disetujui';
                    $message = 'Surat Anda "' . $outgoingLetter->purpose . '" telah disetujui pimpinan dan akan segera dikirim/dicetak oleh admin.';
                } elseif ($status === 'rejected') {
                    $title = 'Surat Ditolak';
                    $message = 'Surat Anda "' . $outgoingLetter->purpose . '" ditolak oleh pimpinan. Silakan periksa catatan penolakan dan perbaiki draf Anda.';
                } elseif ($status === 'sent') {
                    $title = 'Surat Terkirim';
                    $message = 'Surat Anda "' . $outgoingLetter->purpose . '" telah berhasil dikirim/diproses.';
                }

                if ($title && $message) {
                    NotificationHelper::send($user, $title, $message);
                }
            }
        }
    }

    /**
     * Handle the OutgoingLetter "deleted" event.
     */
    public function deleted(OutgoingLetter $outgoingLetter): void
    {
        //
    }

    /**
     * Handle the OutgoingLetter "restored" event.
     */
    public function restored(OutgoingLetter $outgoingLetter): void
    {
        //
    }

    /**
     * Handle the OutgoingLetter "force deleted" event.
     */
    public function forceDeleted(OutgoingLetter $outgoingLetter): void
    {
        //
    }
}
