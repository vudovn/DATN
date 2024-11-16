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
        Schema::create('collection_product', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('productVariant_sku')->nullable();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('product_sku')->references('sku')->on('products')->onDelete('cascade')->nullable();
            $table->foreign('productVariant_sku')->references('sku')->on('product_variants')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_product');
    }
};
