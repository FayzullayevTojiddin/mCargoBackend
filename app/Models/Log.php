<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    protected $fillable = [
        'logable_type',
        'logable_id',
        'performable_type',
        'performable_id',
        'action',
        'data',
        'notes'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function performable(): MorphTo
    {
        return $this->morphTo();
    }

    public function logable(): MorphTo
    {
        return $this->morphTo();
    }
}
