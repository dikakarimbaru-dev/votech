<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// 1. GUEST ROUTES
Route::get('/', function () {
    return view('welcome');
});

// 2. AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {

    // --- ROLE: VOTER (Siswa) ---
    Route::middleware('role:voter')->group(function () {
        Route::get('/dashboard', [VoteController::class, 'index'])->name('dashboard');
        Route::post('/vote/{id}', [VoteController::class, 'castVote'])->name('cast.vote');
    });

    // --- ROLE: ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // CRUD Kandidat Lengkap (Create, Read, Update, Delete)
        Route::get('/candidates', [AdminController::class, 'candidates'])->name('admin.candidates.index');
        Route::get('/candidates/create', [AdminController::class, 'create'])->name('admin.candidates.create');
        Route::post('/candidates/store', [AdminController::class, 'store'])->name('admin.candidates.store');
        Route::get('/candidates/{id}/edit', [AdminController::class, 'edit'])->name('admin.candidates.edit');
        Route::put('/candidates/{id}', [AdminController::class, 'update'])->name('admin.candidates.update');
        Route::delete('/candidates/{id}', [AdminController::class, 'destroy'])->name('admin.candidates.destroy');
    });

    // --- UMUM (Profile) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';