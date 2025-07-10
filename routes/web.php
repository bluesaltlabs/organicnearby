<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FarmController;
use App\Models\Farm;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('farms/map', function () {
        return Inertia::render('farms/MapView');
    })->name('farms.map');
    Route::resource('farms', FarmController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
