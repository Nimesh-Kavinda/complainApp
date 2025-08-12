<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\ClientComplaint;

// Get the first complaint
$complaint = ClientComplaint::first();

if ($complaint) {
    echo "Found complaint: " . $complaint->reference_number . "\n";

    // Create some test conversation data
    $conversation = [
        [
            'id' => 1,
            'message' => 'Hello, I have submitted this complaint and would like to know the status.',
            'sender_type' => 'client',
            'sender_id' => null,
            'sender_name' => $complaint->client_name,
            'created_at' => now()->subDays(2)->toISOString(),
            'timestamp' => now()->subDays(2)->toISOString()
        ],
        [
            'id' => 2,
            'message' => 'Thank you for your complaint. We have received it and are currently reviewing the details. We will get back to you within 24 hours.',
            'sender_type' => 'admin',
            'sender_id' => 1,
            'sender_name' => 'Admin',
            'created_at' => now()->subDays(1)->toISOString(),
            'timestamp' => now()->subDays(1)->toISOString(),
            'status_update' => 'in_progress'
        ],
        [
            'id' => 3,
            'message' => 'Is there any update on my complaint? It has been 2 days.',
            'sender_type' => 'client',
            'sender_id' => null,
            'sender_name' => $complaint->client_name,
            'created_at' => now()->subHours(6)->toISOString(),
            'timestamp' => now()->subHours(6)->toISOString()
        ]
    ];

    // Update the complaint with conversation data
    $complaint->conversation = $conversation;
    $complaint->status = 'in_progress';
    $complaint->save();

    echo "Added test conversation data to complaint " . $complaint->reference_number . "\n";
    echo "Conversation count: " . count($conversation) . "\n";

    // Verify the data was saved
    $complaint->refresh();
    echo "Saved conversation count: " . count($complaint->getConversation()) . "\n";

} else {
    echo "No complaints found in database.\n";
}
