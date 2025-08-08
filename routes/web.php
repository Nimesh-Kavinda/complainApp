<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientComplaintController;
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
Route::delete('/admin/complaints/{id}', [AdminController::class, 'deleteComplaint'])->name('admin.complaints.delete');
Route::get('/admin/add-department', [DepartmentController::class, 'index'])->name('admin.departments');

// Department Management Routes (Admin)
Route::middleware('auth')->group(function () {
    Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/{department}', [DepartmentController::class, 'show'])->name('admin.departments.show');
    Route::put('/admin/departments/{department}/status', [DepartmentController::class, 'updateStatus'])->name('admin.departments.updateStatus');
    Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');
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
Route::get('/client/complaint/{id}/evidence/{fileIndex}', [ClientController::class, 'downloadEvidence'])->name('client.complaint.evidence');

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
    Route::post('/department-head/staff/{staffMember}/status', [DepartmentHeadController::class, 'updateStaffStatus'])->name('department.head.staff.updateStatus');
    Route::get('/department-head/stats', [DepartmentHeadController::class, 'getStats'])->name('department.head.stats');

    // Staff Complaints for Department Heads
    Route::get('/department-head/staff-complaints', [StaffController::class, 'departmentComplaints'])->name('department.head.staff.complaints');
    Route::get('/department-head/staff-complaint/{id}', [StaffController::class, 'departmentComplaintDetails'])->name('department.head.staff.complaint.view');
    Route::post('/department-head/staff-complaint/{id}/status', [StaffController::class, 'updateDepartmentComplaintStatus'])->name('department.head.staff.complaint.updateStatus');
});


