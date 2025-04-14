<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Εμφάνιση φόρμας δημιουργίας
Route::get('/items/create', [SurveyController::class, 'create'])->name('items.create');

// Αποθήκευση δεδομένων της φόρμας
Route::post('/items', [SurveyController::class, 'store'])->name('items.store');


Route::get('/dashboard', [SurveyController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('survey', SurveyController::class);
require __DIR__.'/auth.php';
