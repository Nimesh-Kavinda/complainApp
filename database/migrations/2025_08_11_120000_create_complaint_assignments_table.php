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
        Schema::create('complaint_assignments', function (Blueprint $table) {
            $table->id();

            // Complaint Information
            $table->unsignedBigInteger('client_complaint_id');
            $table->string('complaint_reference');

            // Assignment Information
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('assigned_to'); // Department head user ID
            $table->unsignedBigInteger('assigned_by'); // Admin user ID
            $table->timestamp('assigned_at');

            // Assignment Details
            $table->text('assignment_notes')->nullable();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'escalated'])->default('pending');

            // Department Response
            $table->text('department_response')->nullable();
            $table->json('recommended_actions')->nullable(); // Array of recommended actions
            $table->json('evidence_provided')->nullable(); // File paths for department evidence
            $table->timestamp('response_date')->nullable();

            // Completion Information
            $table->text('completion_summary')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('department_rating')->nullable(); // 1-5 rating by admin

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('client_complaint_id')->references('id')->on('client_complaints')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index(['status', 'assigned_at']);
            $table->index(['department_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('complaint_reference');
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
