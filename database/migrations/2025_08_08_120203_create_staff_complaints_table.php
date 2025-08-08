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
        Schema::create('staff_complaints', function (Blueprint $table) {
            $table->id();

            // Staff Information
            $table->unsignedBigInteger('user_id'); // Reference to users table
            $table->unsignedBigInteger('staff_member_id'); // Reference to staff_members table
            $table->string('staff_id'); // Staff ID for reference
            $table->string('staff_name');
            $table->string('staff_email');
            $table->unsignedBigInteger('department_id'); // Staff's department

            // Complaint Details
            $table->unsignedBigInteger('category_id');
            $table->string('complaint_title')->nullable();
            $table->text('complaint_details');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');

            // Status Management
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->text('solution')->nullable(); // Department head's solution/response

            // Evidence/Attachments
            $table->json('evidence_files')->nullable(); // Store file paths as JSON array
            $table->text('evidence_description')->nullable();

            // Assignment and Tracking
            $table->unsignedBigInteger('assigned_to')->nullable(); // Department head assigned
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            // Additional Information
            $table->string('reference_number')->unique()->nullable(); // Auto-generated reference
            $table->integer('severity_score')->nullable(); // 1-10 scale
            $table->text('staff_feedback')->nullable(); // Staff feedback on resolution
            $table->integer('satisfaction_rating')->nullable(); // 1-5 stars
            $table->string('contact_phone')->nullable();
            $table->text('follow_up_notes')->nullable();

            // Review Information
            $table->unsignedBigInteger('reviewed_by')->nullable(); // Department head who reviewed
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('staff_member_id')->references('id')->on('staff_members')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');

            // Indexes for better performance
            $table->index(['status', 'created_at']);
            $table->index(['department_id', 'status']);
            $table->index(['staff_member_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('staff_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_complaints');
    }
};
