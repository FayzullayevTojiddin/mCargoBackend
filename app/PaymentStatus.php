<?php

namespace App;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';

    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}
