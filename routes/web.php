<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

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

Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::get('/collections/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/search', [ItemController::class, 'search'])->name('items.search');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function () {
    Route::get('/submit', [ItemController::class, 'create'])->name('items.create');
    Route::post('/submit', [ItemController::class, 'store'])->name('items.store');
});


require __DIR__.'/auth.php';
