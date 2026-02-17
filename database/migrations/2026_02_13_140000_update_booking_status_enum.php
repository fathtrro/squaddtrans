<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Update booking status enum to include waiting_penalty and waiting_payment
     */
    public function up(): void
    {
        // For MySQL
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE bookings MODIFY status ENUM('pending', 'confirmed', 'running', 'completed', 'cancelled', 'waiting_penalty', 'waiting_payment') DEFAULT 'pending'");
        }

        // For SQLite (during testing)
        // SQLite doesn't support enum, so we use string with check constraint
        // This migration will be skipped for SQLite in practice
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE bookings MODIFY status ENUM('pending', 'confirmed', 'running', 'completed', 'cancelled') DEFAULT 'pending'");
        }
    }
};
