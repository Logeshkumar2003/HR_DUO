<?php

use App\Http\Controllers\AdminAccessController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Unified Project (template131 + Job Listings Application)
|--------------------------------------------------------------------------
*/

// Primary Website - Homepage (template131 Home with dynamic featured jobs)
Route::get('/', [ListingController::class, 'home']);

// Jobs Application (Public Browsing)
Route::get('/jobs', [ListingController::class, 'index']);
Route::get('/listings', fn() => redirect('/jobs'));
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Admin-Only Routes: Creating, Editing, Deleting, and Managing Listings
// (Available to Main Admin and Secondary Admins)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/create', [ListingController::class, 'create']);
    Route::post('/create', [ListingController::class, 'store']);
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/listings/{listing}', [ListingController::class, 'update']);
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    Route::get('/manage', [ListingController::class, 'manage']);
});

// Main Admin Only Routes: Admin Access Management
// (Only the permanent Main Admin has permission to access, grant or revoke admin access)
Route::middleware(['auth', 'main_admin'])->group(function () {
    Route::get('/admin/access', [AdminAccessController::class, 'index'])->name('admin.access');
    Route::post('/admin/access', [AdminAccessController::class, 'store'])->name('admin.access.store');
    Route::delete('/admin/access/{user}', [AdminAccessController::class, 'destroy'])->name('admin.access.destroy');
});

// Authentication Routes
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'loginNow']);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');

// Self-Registration is Disabled (Redirects to Login)
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);

// Preserved Template131 Pages
Route::get('/about', fn() => view('about'));
Route::get('/team', fn() => view('team'));
Route::get('/blog', fn() => view('blog'));
Route::get('/blog-details', fn() => view('blog-details'));
Route::get('/testimonials', fn() => view('testimonials'));
Route::get('/terms', fn() => view('terms'));
// Contact Us Pages & Submission
Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'send']);
