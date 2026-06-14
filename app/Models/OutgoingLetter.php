<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasCreator;

class OutgoingLetter extends Model
{
    use HasCreator;
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
        'urgency',
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
     * Pimpinan who approved this letter.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope a query to sort by urgency (critical > urgent > normal).
     */
    public function scopeSortByUrgency($query)
    {
        return $query->orderByRaw("CASE urgency WHEN 'critical' THEN 1 WHEN 'urgent' THEN 2 WHEN 'normal' THEN 3 ELSE 4 END");
    }
}
