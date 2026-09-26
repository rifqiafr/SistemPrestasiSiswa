<?php

use App\Http\Controllers\Admin\AcademicAgendaController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\StudentController;
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

// 5. Portal Dashboard Operator Admin (Protected Routes)
Route::middleware(['auth', 'operator'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen & Verifikasi Prestasi Siswa
    Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievement.index');
    Route::get('/prestasi/tambah', [AchievementController::class, 'create'])->name('achievement.create');
    Route::post('/prestasi/simpan', [AchievementController::class, 'store'])->name('achievement.store');
    Route::get('/prestasi/{id}', [AchievementController::class, 'show'])->name('achievement.show');
    Route::get('/prestasi/{id}/edit', [AchievementController::class, 'edit'])->name('achievement.edit');
    Route::put('/prestasi/{id}', [AchievementController::class, 'update'])->name('achievement.update');
    Route::delete('/prestasi/{id}', [AchievementController::class, 'destroy'])->name('achievement.destroy');
    Route::patch('/prestasi/{id}/toggle-status', [AchievementController::class, 'toggleStatus'])->name('achievement.toggle-status');
    Route::patch('/prestasi/{id}/toggle-featured', [AchievementController::class, 'toggleFeatured'])->name('achievement.toggle-featured');

    // Direktori & Manajemen Siswa
    Route::get('/siswa', [StudentController::class, 'index'])->name('student.index');
    Route::post('/siswa/simpan', [StudentController::class, 'store'])->name('student.store');
    Route::put('/siswa/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/siswa/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

    // Manajemen Kategori Prestasi
    Route::get('/kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/kategori/simpan', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/kategori/{id}/toggle', [CategoryController::class, 'toggle'])->name('category.toggle');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Laporan & Rekapitulasi Akreditasi
    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');

    // Manajemen Konten Landing Page & Profil Sekolah (Visi Misi, Sambutan, Kontak)
    Route::get('/profil-sekolah', [SchoolProfileController::class, 'index'])->name('profile.index');
    Route::post('/profil-sekolah/simpan', [SchoolProfileController::class, 'update'])->name('profile.update');

    // Manajemen Berita Sekolah
    Route::resource('berita', NewsController::class)->names('news');
    Route::patch('/berita/{id}/toggle-status', [NewsController::class, 'toggleStatus'])->name('news.toggle-status');

    // Manajemen Pengumuman Resmi
    Route::resource('pengumuman', AnnouncementController::class)->except(['show', 'create', 'edit'])->names('announcement');

    // Manajemen Agenda Kalender Akademik
    Route::resource('agenda', AcademicAgendaController::class)->except(['show', 'create', 'edit'])->names('agenda');

    // Manajemen Galeri Fasilitas Sekolah
    Route::resource('fasilitas', FacilityController::class)->except(['show', 'create', 'edit'])->names('facility');
});
