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
        Schema::table('complaint_discussions', function (Blueprint $table) {
            // Change message_type to varchar to avoid enum limitations
            $table->string('message_type', 50)->default('text')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_discussions', function (Blueprint $table) {
            // Revert back to enum
            $table->enum('message_type', ['text', 'file', 'image', 'video', 'document'])->default('text')->change();
        });
    }
};
