<?php

namespace App\Traits;

use App\Models\User;

trait HasCreator
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
