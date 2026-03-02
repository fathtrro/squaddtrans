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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();

            $table->enum('service_type', ['lepas_kunci', 'dengan_sopir', 'carter']);
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('destination')->nullable();

            $table->decimal('dp_amount', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2)->default(0);

            $table->enum('status', ['pending', 'confirmed', 'running', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
