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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('note')->nullable();
            $table->string('province_id', 20)->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->string('district_id', 20)->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->string('ward_id', 20)->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->timestamps();

            $table->foreign('province_id')->references('code')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('code')->on('districts')->onDelete('cascade');
            $table->foreign('ward_id')->references('code')->on('wards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
