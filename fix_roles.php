<?php
// Fix script to update all approved staff members' user roles

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\StaffMember;
use App\Models\User;

echo "=== Fixing User Roles for Approved Staff ===\n";

$approvedStaff = StaffMember::where('status', 'approved')->with('user')->get();

echo "Found {$approvedStaff->count()} approved staff members\n\n";

foreach ($approvedStaff as $staff) {
    echo "Updating Staff ID: {$staff->staff_id}\n";
    echo "User: {$staff->user_name}\n";
    echo "Current role: {$staff->user->role}\n";

    // Update user role to staff_member
    $staff->user->update(['role' => 'staff_member']);

    echo "Updated role to: {$staff->user->fresh()->role}\n";
    echo "---\n";
}

echo "\nRole update completed!\n";
