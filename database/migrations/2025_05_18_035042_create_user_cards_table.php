<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('card_type_id')->constrained();
            $table->string('placeholder_name')->nullable();
            $table->string('number')->nullable();
            $table->string('exp_date')->nullable();
            $table->string('cvv')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'number']);
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_cards');
    }
};
