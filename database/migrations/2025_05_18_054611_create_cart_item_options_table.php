<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_item_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id')->constrained();
            $table->foreignId('cart_item_id')->constrained();
            $table->decimal('price', 8, 2)->nullable();
            $table->json('name')->nullable();
            $table->dateTime('saved_at')->nullable();
            $table->json('snapshot_product_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_options');
    }
};
