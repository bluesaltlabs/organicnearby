<?php

use Illuminate\Support\Facades\Route;
use App\Models\Farm;

Route::middleware('api')->group(function () {
    Route::get('farms', function () {
        return Farm::with('location')->get();
    });
}); 