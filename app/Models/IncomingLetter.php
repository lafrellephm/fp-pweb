<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomingLetter extends Model
{
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
     * Dispositions for this incoming letter.
     */
    public function dispositions(): HasMany
    {
        return $this->hasMany(Disposition::class, 'incoming_letter_id');
    }

    /**
     * Admin who created this record.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
