<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
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





//  Client Routes
Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/client/complain', [ClientController::class, 'complainForm'])->name('client.complain');

