<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page Publik
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// 2. Detail Prestasi Publik (Direct URL / OpenGraph Sharing)
Route::get('/prestasi/{slug}', [LandingPageController::class, 'show'])->name('prestasi.detail');

// 3. Autentikasi Pengguna & Siswa
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 4. Portal Dashboard Siswa (Protected Routes)
Route::middleware(['auth', 'student'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/prestasi/tambah', [StudentDashboardController::class, 'create'])->name('achievement.create');
    Route::post('/prestasi/simpan', [StudentDashboardController::class, 'store'])->name('achievement.store');
    Route::get('/prestasi/{id}', [StudentDashboardController::class, 'show'])->name('achievement.show');
    Route::get('/prestasi/{id}/edit', [StudentDashboardController::class, 'edit'])->name('achievement.edit');
    Route::put('/prestasi/{id}', [StudentDashboardController::class, 'update'])->name('achievement.update');
    Route::delete('/prestasi/{id}', [StudentDashboardController::class, 'destroy'])->name('achievement.destroy');
});
