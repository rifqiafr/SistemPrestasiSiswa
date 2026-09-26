<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Panel Operator') - SMA Negeri Unggulan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="h-full flex flex-col font-sans antialiased text-slate-800 bg-slate-50 selection:bg-brand-500 selection:text-white">

    <div class="min-h-full flex">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebarBackdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs hidden lg:hidden transition-opacity"></div>

        <!-- Sidebar Admin Template -->
        <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 flex flex-col border-r border-slate-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Sidebar Header / Branding -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-slate-950/40">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold font-display tracking-tight text-white group-hover:text-brand-300 transition-colors">
                            SMAN UNGGULAN
                        </div>
                        <div class="text-[10px] uppercase font-bold tracking-widest text-amber-400 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Panel Operator</span>
                        </div>
                    </div>
                </a>

                <!-- Close button for mobile -->
                <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
                <!-- Group 1: Navigasi Utama -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Menu Utama
                    </div>
                    <nav class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Dashboard Utama</span>
                        </a>

                        <!-- Kelola Prestasi -->
                        <a href="{{ route('admin.achievement.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.achievement.*') && !request()->routeIs('admin.achievement.create') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->routeIs('admin.achievement.*') && !request()->routeIs('admin.achievement.create') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                                <span>Kelola Prestasi</span>
                            </div>
                            @php
                                $sidebarDraftCount = \App\Models\Achievement::where('status', 'draft')->count();
                            @endphp
                            @if($sidebarDraftCount > 0)
                                <span class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-amber-400 text-slate-950 animate-pulse" title="{{ $sidebarDraftCount }} Menunggu Verifikasi">
                                    {{ $sidebarDraftCount }}
                                </span>
                            @endif
                        </a>

                        <!-- Input Prestasi Baru -->
                        <a href="{{ route('admin.achievement.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.achievement.create') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.achievement.create') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Tambah Prestasi Baru</span>
                        </a>
                    </nav>
                </div>

                <!-- Group 2: Master Data & Manajemen -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Master Data
                    </div>
                    <nav class="space-y-1">
                        <!-- Data Siswa -->
                        <a href="{{ route('admin.student.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.student.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.student.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>Direktori Siswa</span>
                        </a>

                        <!-- Kategori Bidang -->
                        <a href="{{ route('admin.category.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.category.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.category.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span>Kategori Prestasi</span>
                        </a>

                        <!-- Laporan Akreditasi -->
                        <a href="{{ route('admin.report.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.report.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.report.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Laporan Akreditasi</span>
                        </a>
                    </nav>
                </div>

                <!-- Group 3: Kelola Landing Page & CMS -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Kelola Website & CMS
                    </div>
                    <nav class="space-y-1">
                        <!-- Profil & Visi Misi -->
                        <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.profile.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.profile.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span>Profil & Visi Misi</span>
                        </a>

                        <!-- Berita Sekolah -->
                        <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.news.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span>Berita & Warta</span>
                        </a>

                        <!-- Pengumuman Resmi -->
                        <a href="{{ route('admin.announcement.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.announcement.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.announcement.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            <span>Pengumuman Resmi</span>
                        </a>

                        <!-- Agenda Kalender Akademik -->
                        <a href="{{ route('admin.agenda.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.agenda.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.agenda.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Agenda Akademik</span>
                        </a>

                        <!-- Galeri Fasilitas -->
                        <a href="{{ route('admin.facility.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.facility.*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-500/20' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.facility.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Galeri Fasilitas</span>
                        </a>
                    </nav>
                </div>

                <!-- Group 4: Akses Cepat Web -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Tautan Eksternal
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-emerald-400 transition-colors">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>Lihat Web Sekolah</span>
                            </div>
                            <span class="text-[10px] px-1.5 py-0.5 rounded-sm bg-slate-800 text-slate-400">Tab Baru</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Operator Profile in Sidebar Footer -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/60">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-600 text-slate-950 font-bold flex items-center justify-center flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold text-white truncate">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-[11px] text-amber-400 flex items-center gap-1 font-medium">
                                <span>Staf Kesiswaan</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" title="Keluar Akun" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 lg:pl-72 flex flex-col min-w-0">
            <!-- Top Header Bar -->
            <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 lg:px-8 shadow-xs">
                <!-- Left: Hamburger button & Breadcrumbs -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden p-2 text-slate-600 hover:text-slate-900 rounded-xl hover:bg-slate-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <div class="text-xs text-slate-400 flex items-center gap-1.5 font-medium">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Operator</a>
                            <span>/</span>
                            <span class="text-slate-600 font-semibold">@yield('page_title', 'Dashboard')</span>
                        </div>
                        <h1 class="text-base sm:text-lg font-bold font-display text-slate-900 tracking-tight leading-tight">
                            @yield('page_heading', 'Dashboard Operator')
                        </h1>
                    </div>
                </div>

                <!-- Right: Quick actions & School Indicator -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Academic Year Badge -->
                    <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 text-xs font-semibold text-slate-700 border border-slate-200/80">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>T.A. 2026/2027 Ganjil</span>
                    </div>

                    <!-- Shortcut to create achievement -->
                    <a href="{{ route('admin.achievement.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs sm:text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 rounded-xl transition-all shadow-md shadow-brand-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="hidden sm:inline">Input Prestasi</span>
                    </a>

                    <!-- Direct link to website -->
                    <a href="{{ route('home') }}" target="_blank" title="Buka Website Sekolah" class="p-2 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </header>

            <!-- Flash Alert Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 w-full">
                    <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 w-full">
                    <div class="flex items-center justify-between p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold">{{ session('error') ?? 'Terdapat kesalahan pada input formulir:' }}</p>
                                @if($errors->any())
                                    <ul class="text-xs list-disc list-inside mt-1 space-y-0.5 text-rose-700">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Main Page Content Body -->
            <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="bg-white border-t border-slate-200 py-4 px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 max-w-7xl mx-auto">
                    <div>
                        &copy; {{ date('Y') }} SMA Negeri Unggulan • Sistem Manajemen Prestasi Siswa & Portal Profil Sekolah
                    </div>
                    <div class="font-medium text-slate-400">
                        Versi Aplikasi 2.4-Enterprise (Laravel 11 / PHP 8.5)
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
