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
        Schema::create('cart_item_option_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_option_id')->constrained();
            $table->foreignId('product_option_item_id')->constrained();
            $table->json('name')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->dateTime('saved_at')->nullable();
            $table->json('snapshot_product_option_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_option_items');
    }
};
