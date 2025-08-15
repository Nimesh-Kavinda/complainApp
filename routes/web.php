<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientComplaintController;
use App\Http\Controllers\ComplaintAssignmentController;
use App\Http\Controllers\DepartmentHeadController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffRegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/category', [AdminController::class, 'category'])->name('admin.category');
Route::post('/admin/category/store', [AdminController::class, 'category_store'])->name('admin.category.store');
Route::delete('/admin/category/{id}', [AdminController::class, 'category_destroy'])->name('admin.category.destroy');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::put('/admin/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.updateRole');
Route::get('/admin/complaints', [AdminController::class, 'complains'])->name('admin.complaints');
Route::put('/admin/complaints/{id}/status', [AdminController::class, 'updateComplaintStatus'])->name('admin.complaints.updateStatus');
Route::get('/admin/complaints/{id}/conversation', [AdminController::class, 'getComplaintConversation'])->name('admin.complaints.conversation');
Route::post('/admin/complaints/{id}/reply', [AdminController::class, 'replyToComplaint'])->name('admin.complaints.reply');
Route::get('/admin/complaints/{id}/evidence/{fileIndex}', [AdminController::class, 'downloadEvidence'])->name('admin.complaints.evidence');
Route::get('/admin/discussions/{discussionId}/attachment', [AdminController::class, 'downloadDiscussionAttachment'])->name('admin.discussions.attachment');
Route::delete('/admin/complaints/{id}', [AdminController::class, 'deleteComplaint'])->name('admin.complaints.delete');

// Debug route for testing conversation
Route::get('/debug/conversation/{id}', function($id) {
    $complaint = App\Models\ClientComplaint::findOrFail($id);
    return response()->json([
        'complaint_id' => $complaint->id,
        'reference_number' => $complaint->reference_number,
        'client_name' => $complaint->client_name,
        'status' => $complaint->status,
        'conversation_count' => count($complaint->getConversation()),
        'conversation' => $complaint->getConversation()
    ]);
});
Route::get('/admin/add-department', [DepartmentController::class, 'index'])->name('admin.departments');

// Department Management Routes (Admin)
Route::middleware('auth')->group(function () {
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/{department}', [DepartmentController::class, 'show'])->name('admin.departments.show');
    Route::put('/admin/departments/{department}/status', [DepartmentController::class, 'updateStatus'])->name('admin.departments.updateStatus');
    Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');
});

// Complaint Assignment Routes (Admin & Department Heads)
Route::middleware('auth')->group(function () {
    // Admin assignment routes
    Route::post('/complaints/{id}/assign', [ComplaintAssignmentController::class, 'assignComplaint'])->name('complaints.assign');
    Route::get('/complaints/{id}/assignments', [ComplaintAssignmentController::class, 'getComplaintAssignments'])->name('complaints.assignments.get');

    // Discussion routes (Admin & Department Heads)
    Route::post('/assignments/{assignment}/messages', [ComplaintAssignmentController::class, 'sendMessage'])->name('assignments.messages.send');
    Route::put('/assignments/{assignment}/status', [ComplaintAssignmentController::class, 'updateAssignmentStatus'])->name('assignments.status.update');
    Route::post('/assignments/{assignment}/messages/read', [ComplaintAssignmentController::class, 'markMessagesAsRead'])->name('assignments.messages.read');

    // Dashboard stats
    Route::get('/assignments/dashboard-stats', [ComplaintAssignmentController::class, 'getDashboardStats'])->name('assignments.dashboard.stats');
});

// Staff Registration Routes (Admin)
Route::get('/admin/staff-registrations', [StaffRegistrationController::class, 'index'])->name('admin.staff-registrations');
Route::post('/admin/staff-registrations/{id}/status', [StaffRegistrationController::class, 'updateStatus'])->name('admin.staff-registrations.updateStatus');



//  Client Routes
Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/client/complain', [ClientController::class, 'complainForm'])->name('client.complain');
Route::get('/client/my-complaints', [ClientController::class, 'myComplaints'])->name('client.my-complaints');
Route::get('/client/past-complaints', [ClientController::class, 'pastComplaints'])->name('client.past-complaints');
Route::get('/client/complaint/{id}/conversation', [ClientController::class, 'getComplaintConversation'])->name('client.complaint.conversation');
Route::post('/client/complaint/{id}/message', [ClientController::class, 'addMessageToComplaint'])->name('client.complaint.message');
Route::post('/client/complaint/{id}/close', [ClientController::class, 'closeComplaint'])->name('client.complaint.close');

// Client Complaint Routes
Route::post('/client/complaint/store', [ClientComplaintController::class, 'store'])->name('client.complaint.store');
Route::get('/client/complaint/success/{id}', [ClientComplaintController::class, 'showSuccess'])->name('client.complaint.success');
Route::get('/client/complaint/{id}', [ClientComplaintController::class, 'show'])->name('client.complaint.show');
Route::get('/client/complaint/{id}/evidence/{fileIndex}', [ClientComplaintController::class, 'downloadEvidence'])->name('client.complaint.evidence');
Route::post('/client/complaint/{id}/feedback', [ClientComplaintController::class, 'submitFeedback'])->name('client.complaint.feedback');

// Staff Registration Routes (Client/User)
Route::middleware('auth')->group(function () {
    Route::get('/staff-registration/departments', [StaffRegistrationController::class, 'getDepartments'])->name('staff-registration.departments');
    Route::post('/staff-registration/submit', [StaffRegistrationController::class, 'store'])->name('staff-registration.submit');
    Route::get('/staff-registration/status', [StaffRegistrationController::class, 'getRegistrationStatus'])->name('staff-registration.status');
});

//staff routes
Route::middleware(['auth'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/complain', [StaffController::class, 'complainForm'])->name('staff.complaint.form');
    Route::post('/staff/complaint/store', [StaffController::class, 'storeComplaint'])->name('staff.complaint.store');
    Route::get('/staff/past-complaints', [StaffController::class, 'pastComplaints'])->name('staff.pastcomplaints');
    Route::get('/staff/complaint/{id}', [StaffController::class, 'viewComplaint'])->name('staff.complaint.view');
    Route::get('/staff/complaint/{id}/evidence/{fileIndex}', [StaffController::class, 'downloadEvidence'])->name('staff.complaint.evidence');
    Route::post('/staff/complaint/{id}/feedback', [StaffController::class, 'updateComplaintStatus'])->name('staff.complaint.feedback');
});

// Department Head Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/department-head', [DepartmentHeadController::class, 'index'])->name('department.head.index');
    Route::get('/department-head/staff', [DepartmentHeadController::class, 'staffMembers'])->name('department.head.staff');
    Route::get('/department-head/staff/{staffMember}', [DepartmentHeadController::class, 'viewStaffMember'])->name('department.head.staff.view');
    Route::get('/department-head/staff/{staffMember}/id-image', [DepartmentHeadController::class, 'downloadStaffIdImage'])->name('department.head.staff.id-image');
    Route::post('/department-head/staff/{staffMember}/status', [DepartmentHeadController::class, 'updateStaffStatus'])->name('department.head.staff.updateStatus');
    Route::get('/department-head/stats', [DepartmentHeadController::class, 'getStats'])->name('department.head.stats');

    // Staff Complaints for Department Heads
    Route::get('/department-head/staff-complaints', [DepartmentHeadController::class, 'staffcomplaints'])->name('department.head.staff.complaints');
    Route::get('/department-head/staff-complaints/{complaint}', [DepartmentHeadController::class, 'showStaffComplaint'])->name('department.head.staff.complaint.show');
    Route::get('/department-head/staff-complaints/{complaint}/evidence/{fileIndex}', [DepartmentHeadController::class, 'downloadStaffComplaintEvidence'])->name('department.head.staff.complaint.evidence');
    Route::post('/department-head/staff-complaints/{complaint}/response', [DepartmentHeadController::class, 'addStaffComplaintResponse'])->name('department.head.staff.complaint.response');

    // Admin Assigned Complaints for Department Heads
    Route::get('/department-head/admin-assigned-complaints', [DepartmentHeadController::class, 'adminAssignedComplaints'])->name('department.head.admin.assigned.complaints');
    Route::post('/department-head/admin-assigned-complaints/{assignment}/discussion', [DepartmentHeadController::class, 'sendDiscussionMessage'])->name('department.head.assignment.discussion.send');
    Route::get('/department-head/admin-assigned-complaints/{assignment}/discussions', [DepartmentHeadController::class, 'getDiscussionMessages'])->name('department.head.assignment.discussions.get');
    Route::patch('/department-head/admin-assigned-complaints/{assignment}/status', [DepartmentHeadController::class, 'updateAssignmentStatus'])->name('department.head.assignment.status.update');
});

// Additional Admin Routes for Discussions
Route::middleware(['auth'])->group(function () {
    Route::post('/admin/complaint-assignments/{assignment}/discussion', [ComplaintAssignmentController::class, 'sendAdminResponse'])->name('admin.assignment.discussion.send');
    Route::get('/admin/complaint-assignments/{assignment}/discussions', [ComplaintAssignmentController::class, 'getAssignmentDiscussions'])->name('admin.assignment.discussions.get');
});


