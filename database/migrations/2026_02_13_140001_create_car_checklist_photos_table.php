<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Create car_checklist_photos table to support multiple photos per checklist
     */
    public function up(): void
    {
        Schema::create('car_checklist_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_checklist_id')->constrained('car_checklists')->cascadeOnDelete();

            // Photo path/filename
            $table->string('photo_path');

            // Photo category (damage, interior, fuel, etc)
            $table->string('category')->nullable();

            // Description of the photo
            $table->text('description')->nullable();

            $table->timestamps();

            // Index untuk query yang lebih cepat
            $table->index('car_checklist_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_checklist_photos');
    }
};
