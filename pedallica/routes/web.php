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
use App\Http\Controllers\Admin\AdminDashboardController;

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

// Admin Routes (alleen toegankelijk voor admins)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // User management
    Route::put('/users/{id}/approve', [AdminDashboardController::class, 'approveUser'])->name('admin.users.approve');
    Route::put('/users/{id}/make-admin', [AdminDashboardController::class, 'makeAdmin'])->name('admin.users.make-admin');
    Route::put('/users/{id}/remove-admin', [AdminDashboardController::class, 'removeAdmin'])->name('admin.users.remove-admin');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');

    // News management
    Route::post('/news', [AdminDashboardController::class, 'storeNews'])->name('admin.news.store');
    Route::put('/news/{id}', [AdminDashboardController::class, 'updateNews'])->name('admin.news.update');
    Route::delete('/news/{id}', [AdminDashboardController::class, 'deleteNews'])->name('admin.news.delete');

    // Sponsor management
    Route::post('/sponsors', [AdminDashboardController::class, 'storeSponsor'])->name('admin.sponsors.store');
    Route::put('/sponsors/{id}', [AdminDashboardController::class, 'updateSponsor'])->name('admin.sponsors.update');
    Route::delete('/sponsors/{id}', [AdminDashboardController::class, 'deleteSponsor'])->name('admin.sponsors.delete');

    // Event management
    Route::post('/events', [AdminDashboardController::class, 'storeEvent'])->name('admin.events.store');
    Route::put('/events/{id}', [AdminDashboardController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/events/{id}', [AdminDashboardController::class, 'deleteEvent'])->name('admin.events.delete');

    // Rit management
    Route::post('/ritten', [AdminDashboardController::class, 'storeRit'])->name('admin.ritten.store');
    Route::put('/ritten/{id}', [AdminDashboardController::class, 'updateRit'])->name('admin.ritten.update');
    Route::delete('/ritten/{id}', [AdminDashboardController::class, 'deleteRit'])->name('admin.ritten.delete');
});
