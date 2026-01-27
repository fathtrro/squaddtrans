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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('plate_number')->unique();
            $table->string('category')->nullable();
            $table->integer('year');
            $table->integer('seats')->default(5);
            $table->string('transmission')->default('automatic');
            $table->string('fuel_type')->default('bensin');
            $table->decimal('price_12h', 12, 2)->default(0);
            $table->decimal('price_24h', 12, 2)->default(0);
            $table->string('main_image')->nullable();
            $table->enum('status', ['available', 'booked', 'rented', 'maintenance'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
