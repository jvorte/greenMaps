<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimateDataController;

// Route to delete a specific climate data entry by ID
Route::delete('/climate/{id}', [ClimateDataController::class, 'destroy'])->name('climate.destroy');

// Route to display the list of all climate data entries
Route::get('/climate', [ClimateDataController::class, 'index'])->name('climate.index');

// Route to view climate data (used by a specific view)
Route::get('/climate-view', [ClimateDataController::class, 'index']);

// Route to store new climate data entries
Route::post('/climate-view', [ClimateDataController::class, 'store'])->name('climate.store');

// Route to fetch climate data, likely for AJAX or API usage
Route::post('/climate-fetch', [ClimateDataController::class, 'fetchClimateData'])->name('climate.fetch');

// Named route for climate view (note: duplicated path with above `/climate-view`)
Route::get('/climate-view', [ClimateDataController::class, 'index'])->name('climate.view');

// Raw route to get climate data (possibly JSON or API response)
Route::get('/climate-data', [ClimateDataController::class, 'getClimateData']);

// Default home route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Show the form to create a new survey item
Route::get('/items/create', [SurveyController::class, 'create'])->name('items.create');

// Store the form submission for a new survey item
Route::post('/items', [SurveyController::class, 'store'])->name('items.store');

// Import surveys from an external source (e.g., CSV upload)
Route::post('/surveys/import', [SurveyController::class, 'import'])->name('surveys.import');

// Show dashboard with surveys (requires authentication and verification)
Route::get('/dashboard', [SurveyController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require user authentication
Route::middleware('auth')->group(function () {
    // Edit user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update user profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Delete user profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resourceful routes for SurveyController (index, create, store, show, edit, update, destroy)
Route::resource('survey', SurveyController::class);

// Include authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
