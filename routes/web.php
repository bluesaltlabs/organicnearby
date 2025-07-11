<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// User dashboard
Route::get('dashboard', function () {
    return Inertia::render('admin/Dashboard'); // temp
})->middleware(['auth', 'verified'])->name('dashboard');

// Public map
Route::get('farms', function () {
    return Inertia::render('farms/MapView');
})->name('farms.map');

// Farm detail page by slug
Route::get('farms/{farm:slug}', [\App\Http\Controllers\FarmController::class, 'show'])->name('farms.show');

// Admin area
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('admin/Dashboard');
    })->name('dashboard');

    Route::resource('farms', App\Http\Controllers\Admin\FarmController::class);
    // Add Route::get('maps', ...) here if you have an admin-only map page
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
