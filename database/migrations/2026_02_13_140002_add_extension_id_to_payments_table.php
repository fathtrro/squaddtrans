<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Add extension_id and booking_extension_type to payments table
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add nullable foreign key to booking_extensions
            if (!Schema::hasColumn('payments', 'booking_extension_id')) {
                $table->foreignId('booking_extension_id')->nullable()->constrained('booking_extensions')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'booking_extension_id')) {
                $table->dropForeign(['booking_extension_id']);
                $table->dropColumn('booking_extension_id');
            }
        });
    }
};
