<?php
// Test script to check staff members and their user roles

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\StaffMember;
use App\Models\User;

echo "=== Staff Members and User Roles ===\n";

$staffMembers = StaffMember::with('user')->get();

foreach ($staffMembers as $staff) {
    echo "Staff ID: {$staff->staff_id}\n";
    echo "Status: {$staff->status}\n";
    echo "User Name: {$staff->user_name}\n";
    echo "User Role: " . ($staff->user ? $staff->user->role : 'N/A') . "\n";
    echo "User ID: {$staff->user_id}\n";
    echo "---\n";
}

echo "\n=== Testing Role Update ===\n";

// Find a pending staff member
$pendingStaff = StaffMember::where('status', 'pending')->first();

if ($pendingStaff) {
    echo "Found pending staff: {$pendingStaff->staff_id}\n";
    echo "Current user role: {$pendingStaff->user->role}\n";

    // Update to approved
    $pendingStaff->update(['status' => 'approved']);
    $pendingStaff->user->update(['role' => 'staff_member']);

    echo "Updated to approved\n";
    echo "New user role: {$pendingStaff->user->fresh()->role}\n";
} else {
    echo "No pending staff members found\n";
}
