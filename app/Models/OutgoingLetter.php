<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutgoingLetter extends Model
{
    protected $table = 'outgoing_letters';

    protected $fillable = [
        'letter_number',
        'letter_date',
        'letter_type',
        'related_name',
        'purpose',
        'addressed_to',
        'letter_body',
        'event_name',
        'event_date',
        'event_location',
        'file_path',
        'status',
        'rejection_note',
        'created_by',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'letter_date' => 'date',
            'event_date' => 'date',
        ];
    }

    /**
     * User who submitted this letter draft.
     */
    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Pimpinan who approved this letter.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
