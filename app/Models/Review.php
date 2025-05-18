<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'review_type_id',
        'user_id',
        'value',
        'score',
    ];

    public function reviewType(): BelongsTo
    {
        return $this->belongsTo(ReviewType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
