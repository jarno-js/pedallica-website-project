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
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/fotos-sponsors', [SponsorsController::class, 'index'])->name('fotos-sponsors');
Route::get('/fotos-ploegen', [PloegenController::class, 'index'])->name('fotos-ploegen');
Route::get('/fotos-ploegen/{slug}', [PloegenController::class, 'show'])->name('fotos-ploegen.show');
Route::get('/evenementen', [EvenementenController::class, 'index'])->name('evenementen');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Publieke profielpagina (voor iedereen toegankelijk)
Route::get('/users/{username}', [ProfielController::class, 'showPublic'])->name('profiel.public');

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

    // FAQ Category management
    Route::post('/faq-categories', [AdminDashboardController::class, 'storeFaqCategory'])->name('admin.faq-categories.store');
    Route::put('/faq-categories/{id}', [AdminDashboardController::class, 'updateFaqCategory'])->name('admin.faq-categories.update');
    Route::delete('/faq-categories/{id}', [AdminDashboardController::class, 'deleteFaqCategory'])->name('admin.faq-categories.delete');

    // FAQ management
    Route::post('/faqs', [AdminDashboardController::class, 'storeFaq'])->name('admin.faqs.store');
    Route::put('/faqs/{id}', [AdminDashboardController::class, 'updateFaq'])->name('admin.faqs.update');
    Route::delete('/faqs/{id}', [AdminDashboardController::class, 'deleteFaq'])->name('admin.faqs.delete');
});
