<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposition extends Model
{
    protected $table = 'dispositions';

    protected $fillable = [
        'incoming_letter_id',
        'assigned_to',
        'assigned_by',
        'instructions',
        'status',
        'reply_note',
    ];

    /**
     * The incoming letter this disposition belongs to.
     */
    public function incomingLetter(): BelongsTo
    {
        return $this->belongsTo(IncomingLetter::class, 'incoming_letter_id');
    }

    /**
     * User assigned to handle this disposition.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Admin who created this disposition.
     */
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
