<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientComplaintController;
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
Route::delete('/admin/complaints/{id}', [AdminController::class, 'deleteComplaint'])->name('admin.complaints.delete');





//  Client Routes
Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/client/complain', [ClientController::class, 'complainForm'])->name('client.complain');
Route::get('/client/my-complaints', [ClientController::class, 'myComplaints'])->name('client.my-complaints');

// Client Complaint Routes
Route::post('/client/complaint/store', [ClientComplaintController::class, 'store'])->name('client.complaint.store');
Route::get('/client/complaint/success/{id}', [ClientComplaintController::class, 'showSuccess'])->name('client.complaint.success');
Route::get('/client/complaint/{id}', [ClientComplaintController::class, 'show'])->name('client.complaint.show');
Route::get('/client/complaint/{id}/evidence/{fileIndex}', [ClientComplaintController::class, 'downloadEvidence'])->name('client.complaint.evidence');
Route::post('/client/complaint/{id}/feedback', [ClientComplaintController::class, 'submitFeedback'])->name('client.complaint.feedback');

