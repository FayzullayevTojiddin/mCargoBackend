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
        Schema::create('order_product_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->decimal('total_price', 8, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('net_weight')->nullable();
            $table->json('product_snapshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_items');
    }
};
