<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourierTransport extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'courier_transport_type_id',
        'number',
        'details',
    ];

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function courierTransportType(): BelongsTo
    {
        return $this->belongsTo(CourierTransportType::class);
    }
}
