<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MikatController;
use App\Http\Controllers\SosecController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PerusahaanController;

Route::get('/', function () {
    return view('pages.landing');
});

// Add home route that redirects to dashboard

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('pages.dashboard');

// Perusahaan Routes
Route::get('/perusahaan', [PerusahaanController::class, 'index'])
    ->name('perusahaan.list')
    ->middleware('auth')
    ->middleware(\App\Http\Middleware\TestCompletionCheck::class);

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

// Mikat Test Routes
Route::middleware(['auth'])->group(function () {
    // Before test page
    Route::get('/testMikat', [MikatController::class, 'showBeforeTest'])->name('mikat.before');
    
    // Test pages
    Route::get('/testMikat/soal/{page?}', [MikatController::class, 'showSoal'])->name('mikat.show');
    Route::post('/testMikat/soal/{page}', [MikatController::class, 'storeAnswer'])->name('mikat.answer');
    
    // Submit final answers
    Route::post('/testMikat/submit', [MikatController::class, 'submitJawaban'])->name('mikat.submit');
    
    // Flag questions
    Route::post('/testMikat/flag/{page}', [MikatController::class, 'flagQuestion'])->name('mikat.flag');
    
    // Result page
    Route::get('/testMikat/hasil', [MikatController::class, 'showHasil'])->name('hasil.mikat');
});

// SoSec Test Routes
Route::middleware(['auth'])->group(function () {
    // Before test page
    Route::get('/testSosec', [SosecController::class, 'showBeforeTest'])->name('sosec.before');
    
    // Test pages
    Route::get('/testSosec/soal/{page?}', [SosecController::class, 'showSoal'])->name('sosec.show');
    Route::post('/testSosec/soal/{page}', [SosecController::class, 'storeAnswer'])->name('sosec.answer');
    
    // Submit final answers
    Route::post('/testSosec/submit', [SosecController::class, 'submit'])->name('sosec.submit');
    
    // Flag questions
    Route::post('/testSosec/flag/{page}', [SosecController::class, 'flagQuestion'])->name('sosec.flag');
    
    // Result page
    Route::get('/testSosec/hasil', [SosecController::class, 'hasil'])->name('sosec.hasil');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
    
    // User Management
    Route::get('/users', [AdminController::class, 'usersList'])->name('admin.users.index')->middleware('auth:admin');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show')->middleware('auth:admin');
    
    // Article Management
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('admin.artikel.index')->middleware('auth:admin');
    Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('admin.artikel.create')->middleware('auth:admin');
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('admin.artikel.store')->middleware('auth:admin');
    Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('admin.artikel.edit')->middleware('auth:admin');
    Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('admin.artikel.update')->middleware('auth:admin');
    Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('admin.artikel.destroy')->middleware('auth:admin');
});