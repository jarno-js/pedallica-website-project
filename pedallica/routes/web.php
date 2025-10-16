<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SponsorsController;
use App\Http\Controllers\PloegenController;
use App\Http\Controllers\EvenementenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfielController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/fotos-sponsors', [SponsorsController::class, 'index'])->name('fotos-sponsors');
Route::get('/fotos-ploegen', [PloegenController::class, 'index'])->name('fotos-ploegen');
Route::get('/evenementen', [EvenementenController::class, 'index'])->name('evenementen');

// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard Route (alleen toegankelijk voor ingelogde gebruikers die goedgekeurd zijn)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'approved']);

// Profiel Routes (alleen toegankelijk voor ingelogde gebruikers)
Route::middleware('auth')->group(function () {
    Route::get('/profiel', [ProfielController::class, 'show'])->name('profiel');
    Route::put('/profiel', [ProfielController::class, 'update'])->name('profiel.update');
    Route::put('/profiel/wachtwoord', [ProfielController::class, 'updatePassword'])->name('profiel.password');
    Route::put('/profiel/foto', [ProfielController::class, 'updateProfilePicture'])->name('profiel.picture');
    Route::delete('/profiel/foto', [ProfielController::class, 'deleteProfilePicture'])->name('profiel.picture.delete');
});
