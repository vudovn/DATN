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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();

			$table->integer('quantity');
            $table->string('thumbnail')->default('https://img.muji.net/img/item/4550583440404_1260.jpg');
            $table->json('albums')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('price')->nullable();
            $table->unsignedBigInteger('product_id');
			$table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
