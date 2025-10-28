<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::get('/collections/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/search', [ItemController::class, 'search'])->name('items.search');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::view('/about', 'about')->name('about');


// Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/submissions', [UserDashboardController::class, 'submissions'])->name('user.submissions');

    // Submissions (Create/Store)
    Route::get('/user/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/user/create', [ItemController::class, 'store'])->name('items.store');
});

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('admin.submissions');

    // Category Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    // Admin Create Submission
    Route::get('/create', [AdminController::class, 'createItem'])->name('admin.items.create');
    Route::post('/create', [AdminController::class, 'storeItem'])->name('admin.items.store');

    Route::patch('/approve/{item}', [AdminController::class, 'approve'])->name('admin.approve');
});

require __DIR__ . '/auth.php';
