<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

// 1. Landing Page Publik
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// 2. Detail Prestasi Publik (Direct URL / OpenGraph Sharing)
Route::get('/prestasi/{slug}', [LandingPageController::class, 'show'])->name('prestasi.detail');

// 3. Login Route Placeholder
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
