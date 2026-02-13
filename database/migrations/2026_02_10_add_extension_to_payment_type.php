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
        // Modify payment_type enum to include 'extension'
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_type')->change();
        });
    }
};
