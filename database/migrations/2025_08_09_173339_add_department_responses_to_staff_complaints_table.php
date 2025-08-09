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
        Schema::table('staff_complaints', function (Blueprint $table) {
            $table->json('department_responses')->nullable()->after('review_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_complaints', function (Blueprint $table) {
            $table->dropColumn('department_responses');
        });
    }
};
