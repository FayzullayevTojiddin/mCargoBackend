<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'card_type_id',
        'masked_number',
        'exp_date',
        'token',
        'verified'
    ];

    protected $casts = [
        'verified' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function card_type(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }
}
