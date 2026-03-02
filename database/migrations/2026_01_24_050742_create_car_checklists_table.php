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
        Schema::create('car_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();

            $table->enum('checklist_type', ['before', 'after']);
            $table->text('body_condition')->nullable();
            $table->text('interior_condition')->nullable();
            $table->string('fuel_level')->nullable();
            $table->text('accessories')->nullable();
            $table->text('notes')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_checklists');
    }
};
