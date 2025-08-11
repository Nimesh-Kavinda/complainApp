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
        // Drop existing table if it exists with foreign key constraints disabled
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('complaint_assignments');
        Schema::enableForeignKeyConstraints();

        Schema::create('complaint_assignments', function (Blueprint $table) {
            $table->id();

            // Complaint Reference
            $table->unsignedBigInteger('client_complaint_id');

            // Assignment Information
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('assigned_to'); // Department head
            $table->unsignedBigInteger('assigned_by'); // Admin who assigned

            // Assignment Details
            $table->enum('status', ['assigned', 'in_progress', 'pending_feedback', 'resolved', 'cancelled'])->default('assigned');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->timestamp('deadline')->nullable();
            $table->text('assignment_notes')->nullable();

            // Resolution Information
            $table->timestamp('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('client_complaint_id')->references('id')->on('client_complaints')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index(['client_complaint_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['department_id', 'status']);
            $table->index('deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_assignments');
    }
};
