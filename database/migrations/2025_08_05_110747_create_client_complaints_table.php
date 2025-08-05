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
        Schema::create('client_complaints', function (Blueprint $table) {
            $table->id();

            // Client Information
            $table->string('client_name');
            $table->string('client_email');
            $table->string('nic')->unique(); // NIC as unique identifier

            // Complaint Details
            $table->unsignedBigInteger('category_id');
            $table->string('complaint_title')->nullable();
            $table->text('complaint_details');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');

            // Status Management
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->text('solution')->nullable(); // Admin's solution/response

            // Evidence/Attachments
            $table->json('evidence_files')->nullable(); // Store file paths as JSON array
            $table->text('evidence_description')->nullable();

            // Assignment and Tracking
            $table->unsignedBigInteger('assigned_to')->nullable(); // Staff member assigned
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            // Additional Information
            $table->string('reference_number')->unique()->nullable(); // Auto-generated reference
            $table->integer('severity_score')->nullable(); // 1-10 scale
            $table->text('client_feedback')->nullable(); // Client feedback on resolution
            $table->integer('satisfaction_rating')->nullable(); // 1-5 stars
            $table->boolean('is_anonymous')->default(false);
            $table->string('contact_phone')->nullable();
            $table->string('department')->nullable(); // Department related to complaint
            $table->text('follow_up_notes')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');

            // Indexes for better performance
            $table->index(['status', 'created_at']);
            $table->index(['category_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('nic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_complaints');
    }
};
