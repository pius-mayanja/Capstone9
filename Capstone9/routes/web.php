<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\OutcomeController;
use App\Models\Facility;
use App\Models\Program;
use App\Models\Project;
use App\Models\Participants;
use App\Models\Service;
use App\Http\Controllers\EquipmentController;


Route::get('/', function () {
    return view('home');
});

Route::get('/', function () {
    return view('home', [
        'programCount' => Program::count(),
        'facilityCount' => Facility::count(),
        'participantsCount' => Participants::count(),
        'projectCount' => Project::count(),
        'serviceCount' => Service::count(),
        // 'equipmentCount' => Equipment::count(),
    ]);
});
    
Route::resource('facilities', FacilityController::class);
Route::resource('programs', ProgramController::class);
Route::resource('services', ServiceController::class);
Route::resource('participants', ParticipantsController::class);
Route::resource('projects', ProjectController::class);
Route::resource('outcomes', OutcomeController::class);
Route::resource('equipment', EquipmentController::class);

// Other routes

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
