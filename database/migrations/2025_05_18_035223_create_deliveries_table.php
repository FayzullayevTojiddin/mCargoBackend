<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_id')->constrained();
            $table->foreignId('courier_transport_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('number')->nullable();
            $table->date('delivery_at')->nullable();
            $table->unsignedBigInteger('delivery_from_id')->nullable();
            $table->unsignedBigInteger('delivery_to_id')->nullable();
            $table->decimal('price', 15, 2);
            $table->unsignedInteger('estimated_time_sec_min')->nullable();
            $table->unsignedInteger('estimated_time_sec_max')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
