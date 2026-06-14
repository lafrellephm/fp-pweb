<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasCreator;

class IncomingLetter extends Model
{
    use HasCreator;
    protected $table = 'incoming_letters';

    protected $fillable = [
        'letter_number',
        'letter_date',
        'received_date',
        'sender',
        'letter_type',
        'subject',
        'file_path',
        'status',
        'urgency',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'letter_date' => 'date',
            'received_date' => 'date',
        ];
    }


    /**
     * Scope a query to sort by urgency (critical > urgent > normal).
     */
    public function scopeSortByUrgency($query)
    {
        return $query->orderByRaw("CASE urgency WHEN 'critical' THEN 1 WHEN 'urgent' THEN 2 WHEN 'normal' THEN 3 ELSE 4 END");
    }
}
