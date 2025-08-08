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
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();

            // User association
            $table->unsignedBigInteger('user_id'); // Reference to users table
            $table->string('user_name'); // Cache user name
            $table->string('user_email'); // Cache user email

            // Staff-specific information
            $table->string('staff_id')->unique(); // Staff ID provided by user
            $table->string('department'); // Department name
            $table->date('date_of_birth'); // Date of birth
            $table->string('nic_number'); // NIC number
            $table->string('staff_id_image_path')->nullable(); // Path to uploaded staff ID image

            // Status and approval
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Registration status
            $table->unsignedBigInteger('reviewed_by')->nullable(); // Admin who reviewed (reference to users table)
            $table->timestamp('reviewed_at')->nullable(); // When it was reviewed
            $table->text('rejection_reason')->nullable(); // Reason for rejection if applicable

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['department', 'status']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_members');
    }
};
