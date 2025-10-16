<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SponsorsController;
use App\Http\Controllers\PloegenController;
use App\Http\Controllers\EvenementenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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
