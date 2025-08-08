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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Department name (e.g., "IT", "HR", "Marketing")
            $table->text('description')->nullable(); // Department description
            $table->unsignedBigInteger('head_of_department')->nullable(); // User ID of department head
            $table->boolean('is_active')->default(true); // Whether department is active
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('head_of_department')->references('id')->on('users')->onDelete('set null');

            // Index
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
