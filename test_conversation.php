<?php
// Simple test script to add conversation data

// Include Laravel's autoloader
require 'vendor/autoload.php';

// Boot Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ClientComplaint;
use Carbon\Carbon;

echo "Adding test conversation data...\n";

// Get the first complaint
$complaint = ClientComplaint::first();

if (!$complaint) {
    echo "No complaints found. Please create a complaint first.\n";
    exit;
}

echo "Found complaint: {$complaint->reference_number} - {$complaint->client_name}\n";

// Create test conversation data
$conversation = [
    [
        'id' => 1,
        'message' => 'Hello, I submitted this complaint yesterday and wanted to check the status. This is regarding the poor service I received at your office.',
        'sender_type' => 'client',
        'sender_id' => null,
        'sender_name' => $complaint->client_name,
        'created_at' => Carbon::now()->subDays(2)->toISOString(),
        'timestamp' => Carbon::now()->subDays(2)->toISOString()
    ],
    [
        'id' => 2,
        'message' => 'Thank you for contacting us. We have received your complaint and are currently reviewing the details. We will investigate this matter and get back to you within 24 hours with an update.',
        'sender_type' => 'admin',
        'sender_id' => 1,
        'sender_name' => 'Admin Support',
        'created_at' => Carbon::now()->subDays(1)->toISOString(),
        'timestamp' => Carbon::now()->subDays(1)->toISOString(),
        'status_update' => 'in_progress'
    ],
    [
        'id' => 3,
        'message' => 'Thank you for the update. I appreciate the quick response. Please let me know what actions will be taken to resolve this issue.',
        'sender_type' => 'client',
        'sender_id' => null,
        'sender_name' => $complaint->client_name,
        'created_at' => Carbon::now()->subHours(12)->toISOString(),
        'timestamp' => Carbon::now()->subHours(12)->toISOString()
    ],
    [
        'id' => 4,
        'message' => 'We have completed our internal investigation. The issue has been identified and we have implemented corrective measures. We apologize for any inconvenience caused and have taken steps to prevent similar issues in the future.',
        'sender_type' => 'admin',
        'sender_id' => 1,
        'sender_name' => 'Admin Support',
        'created_at' => Carbon::now()->subHours(2)->toISOString(),
        'timestamp' => Carbon::now()->subHours(2)->toISOString(),
        'status_update' => 'resolved'
    ]
];

// Update the complaint with conversation data
$complaint->conversation = $conversation;
$complaint->status = 'resolved';
$complaint->save();

echo "Successfully added conversation with " . count($conversation) . " messages\n";
echo "Updated complaint status to: {$complaint->status}\n";

// Verify the data
$complaint->refresh();
$savedConversation = $complaint->getConversation();
echo "Verified: " . count($savedConversation) . " messages saved in database\n";

echo "Test conversation data added successfully!\n";
