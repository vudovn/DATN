<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('price', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->string('thumbnail')->nullable();
            $table->json('albums')->nullable(); 
            $table->boolean('publish')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->softDeletes();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};