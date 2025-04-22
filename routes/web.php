<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/personal', [ProfileController::class, 'personal'])->name('pages.profile.personal');
    Route::get('/profile/analys', [ProfileController::class, 'analys'])->name('pages.profile.analys');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('pages.profile.editData');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

