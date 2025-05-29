<?php

namespace App\Providers;

use App\Models\Courier;
use App\Models\DeliveryType;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Policies\CourierPolicy;
use App\Policies\DeliveryTypePolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PaymentTypePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(PaymentType::class, PaymentTypePolicy::class);
        Gate::policy(Payment::class, PaymentPolicy::class);
        Gate::policy(DeliveryType::class, DeliveryTypePolicy::class);
        Gate::policy(Courier::class, CourierPolicy::class);
    }
}
