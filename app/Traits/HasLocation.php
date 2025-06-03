<?php

namespace App\Traits;

use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasLocation
{
    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locationable');
    }
}
