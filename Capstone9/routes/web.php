<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ParticipantsController;


Route::get('/', function () {
    return view('home');
});


Route::resource('facilities', FacilityController::class);
Route::resource('programs', ProgramController::class);
Route::resource('services', ServiceController::class);
Route::resource('participants', ParticipantsController::class);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
