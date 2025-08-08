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
        Schema::table('staff_members', function (Blueprint $table) {
            // Add department_id column
            $table->unsignedBigInteger('department_id')->nullable()->after('staff_id');

            // Add foreign key constraint
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

            // Add index for better performance
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_members', function (Blueprint $table) {
            // Drop foreign key and column
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
