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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id'); 
            $table->unsignedBigInteger('sku'); 

            // $table->unsignedBigInteger('product_id'); 
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade'); 
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_products');
    }
};
