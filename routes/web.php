<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClimateDataController;

Route::delete('/climate/{id}', [ClimateDataController::class, 'destroy'])->name('climate.destroy');

// Display the list of climate data
Route::get('/climate', [ClimateDataController::class, 'index'])->name('climate.index');

Route::get('/climate-view', [ClimateDataController::class, 'index']);
Route::post('/climate-view', [ClimateDataController::class, 'store'])->name('climate.store');

Route::post('/climate-fetch', [ClimateDataController::class, 'fetchClimateData'])->name('climate.fetch');

Route::get('/climate-view', [ClimateDataController::class, 'index'])->name('climate.view');

Route::get('/climate-data', [ClimateDataController::class, 'getClimateData']);


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Εμφάνιση φόρμας δημιουργίας
Route::get('/items/create', [SurveyController::class, 'create'])->name('items.create');

// Αποθήκευση δεδομένων της φόρμας
Route::post('/items', [SurveyController::class, 'store'])->name('items.store');

Route::post('/surveys/import', [SurveyController::class, 'import'])->name('surveys.import');

Route::get('/dashboard', [SurveyController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('survey', SurveyController::class);
require __DIR__.'/auth.php';
