<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courier_transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_id')->constrained();
            $table->foreignId('courier_transport_type_id')->constrained();
            $table->string('number')->nullable();
            $table->string('details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courier_transports');
    }
};
