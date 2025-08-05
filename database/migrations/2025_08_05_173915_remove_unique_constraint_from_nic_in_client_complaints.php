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
        Schema::table('client_complaints', function (Blueprint $table) {
            // Drop the unique constraint on NIC field
            $table->dropUnique(['nic']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_complaints', function (Blueprint $table) {
            // Re-add the unique constraint on NIC field if rolling back
            $table->unique('nic');
        });
    }
};
