<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SponsorsController;
use App\Http\Controllers\PloegenController;
use App\Http\Controllers\EvenementenController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/fotos-sponsors', [SponsorsController::class, 'index'])->name('fotos-sponsors');
Route::get('/fotos-ploegen', [PloegenController::class, 'index'])->name('fotos-ploegen');
Route::get('/evenementen', [EvenementenController::class, 'index'])->name('evenementen');
