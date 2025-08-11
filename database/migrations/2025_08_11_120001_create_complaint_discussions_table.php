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
        Schema::create('complaint_discussions', function (Blueprint $table) {
            $table->id();

            // Assignment Reference
            $table->unsignedBigInteger('complaint_assignment_id');

            // Message Information
            $table->unsignedBigInteger('sender_id'); // User who sent the message
            $table->enum('sender_type', ['admin', 'department_head']); // Message sender type
            $table->text('message');
            $table->enum('message_type', ['text', 'file', 'image', 'video', 'document'])->default('text');

            // File Attachments
            $table->json('attachments')->nullable(); // Array of file information
            $table->boolean('is_confidential')->default(false);

            // Message Status
            $table->timestamp('sent_at');
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_important')->default(false);

            // Reply Information
            $table->unsignedBigInteger('reply_to_message_id')->nullable(); // For threaded conversations

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('complaint_assignment_id')->references('id')->on('complaint_assignments')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reply_to_message_id')->references('id')->on('complaint_discussions')->onDelete('set null');

            // Indexes
            $table->index(['complaint_assignment_id', 'sent_at']);
            $table->index(['sender_id', 'sender_type']);
            $table->index('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_discussions');
    }
};
