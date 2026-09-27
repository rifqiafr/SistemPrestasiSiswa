<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-20">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Sistem Informasi Prestasi Siswa SMA - Etalase Portofolio & Capaian Unggulan')</title>
    <meta name="title" content="@yield('title', 'Sistem Informasi Prestasi Siswa SMA - Etalase Portofolio & Capaian Unggulan')">
    <meta name="description" content="@yield('meta_description', 'Katalog resmi publikasi prestasi dan capaian siswa SMA tingkat Sekolah, Provinsi, Nasional, hingga Internasional secara transparan, kredibel, dan terverifikasi.')">
    <meta name="keywords" content="prestasi siswa, portofolio sekolah, olimpiade sains, FLS2N, O2SN, LKIR BRIN, SMA unggulan, akreditasi sekolah">
    <meta name="author" content="Tim Kesiswaan SMA Unggulan">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Sistem Informasi Prestasi Siswa SMA')">
    <meta property="og:description" content="@yield('meta_description', 'Katalog resmi publikasi prestasi dan capaian siswa SMA secara kredibel dan terverifikasi.')">
    <meta property="og:image" content="@yield('og_image', asset('build/assets/og-prestasi.jpg'))">

    <!-- Twitter Card -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Sistem Informasi Prestasi Siswa SMA')">
    <meta property="twitter:description" content="@yield('meta_description', 'Katalog resmi publikasi prestasi dan capaian siswa SMA secara kredibel dan terverifikasi.')">
    <meta property="twitter:image" content="@yield('og_image', asset('build/assets/og-prestasi.jpg'))">

    <!-- Favicon & Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="theme-color" content="#074b84">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-brand-500 selection:text-white min-h-screen flex flex-col font-sans">

    <!-- Header / Navbar Sticky with Glassmorphism -->
    <header class="sticky top-0 z-40 w-full transition-all duration-300 backdrop-blur-md bg-white/95 border-b border-slate-200/90 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" onclick="scrollToTop(event)" class="flex items-center gap-2.5 sm:gap-3.5 group focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 rounded-xl min-w-0">
                    <img src="{{ asset('favicon.svg') }}" alt="Logo SMA" class="w-9 h-9 sm:w-11 sm:h-11 rounded-xl shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-300 object-contain flex-shrink-0">
                    <div class="min-w-0">
                        <span class="block text-sm sm:text-base lg:text-lg font-bold font-display tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors whitespace-nowrap">
                            SMAN UNGGULAN
                        </span>
                        <span class="hidden sm:block text-[11px] font-semibold text-slate-500 tracking-wider uppercase truncate">
                            Portal Profil & Prestasi Siswa
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ route('home') }}" onclick="scrollToTop(event)" class="px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors">
                        Beranda
                    </a>

                    <!-- Dropdown Profil -->
                    <div class="relative nav-dropdown-item group">
                        <button type="button" class="nav-dropdown-toggle inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500" aria-expanded="false">
                            <span>Profil</span>
                            <svg class="dropdown-arrow w-4 h-4 text-slate-400 group-hover:text-brand-600 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown-menu absolute left-0 top-full pt-1.5 w-64 z-50 opacity-0 translate-y-1.5 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out before:content-[''] before:absolute before:-top-3 before:left-0 before:w-full before:h-3">
                            <div class="rounded-2xl bg-white border border-slate-200/90 shadow-xl py-2">
                                <a href="{{ route('home') }}#sambutan" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Sambutan Kepala Sekolah
                                </a>
                                <a href="{{ route('home') }}#visi-misi" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Visi & Misi Strategis
                                </a>
                                <a href="{{ route('home') }}#profil-sejarah" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Sejarah & Tenaga Pendidik
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Prestasi -->
                    <div class="relative nav-dropdown-item group">
                        <button type="button" class="nav-dropdown-toggle inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500" aria-expanded="false">
                            <span>Prestasi</span>
                            <svg class="dropdown-arrow w-4 h-4 text-slate-400 group-hover:text-brand-600 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown-menu absolute left-0 top-full pt-1.5 w-64 z-50 opacity-0 translate-y-1.5 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out before:content-[''] before:absolute before:-top-3 before:left-0 before:w-full before:h-3">
                            <div class="rounded-2xl bg-white border border-slate-200/90 shadow-xl py-2">
                                <a href="{{ route('home') }}#statistik" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Statistik & Perolehan Medali
                                </a>
                                <a href="{{ route('home') }}#direktori" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Katalog Direktori Lengkap
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Berita & Agenda -->
                    <div class="relative nav-dropdown-item group">
                        <button type="button" class="nav-dropdown-toggle inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500" aria-expanded="false">
                            <span>Berita & Agenda</span>
                            <svg class="dropdown-arrow w-4 h-4 text-slate-400 group-hover:text-brand-600 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="nav-dropdown-menu absolute left-0 top-full pt-1.5 w-64 z-50 opacity-0 translate-y-1.5 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200 ease-out before:content-[''] before:absolute before:-top-3 before:left-0 before:w-full before:h-3">
                            <div class="rounded-2xl bg-white border border-slate-200/90 shadow-xl py-2">
                                <a href="{{ route('home') }}#berita-agenda" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Berita Kegiatan Sekolah
                                </a>
                                <a href="{{ route('home') }}#berita-agenda" class="block px-4 py-2.5 text-xs sm:text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition-colors font-medium">
                                    Pengumuman Resmi
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#fasilitas" class="px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors">
                        Fasilitas
                    </a>

                    <a href="{{ route('home') }}#kontak-ppdb" class="px-3 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-xl transition-colors">
                        Kontak & PPDB
                    </a>
                </nav>

                <!-- Action Button & Mobile Menu Trigger -->
                <div class="flex items-center gap-1 sm:gap-2.5 flex-shrink-0">
                    <!-- Search Icon Button -->
                    <button 
                        type="button" 
                        onclick="focusDirectorySearch()" 
                        class="p-2 sm:p-2.5 text-slate-600 hover:text-brand-600 hover:bg-slate-100 rounded-xl transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500"
                        title="Cari Prestasi Siswa"
                        aria-label="Cari Prestasi"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>

                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-700 hover:text-brand-700 bg-slate-100 hover:bg-brand-50 border border-slate-200 rounded-xl transition-all shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Masuk Portal</span>
                        </a>
                    @else
                        @if(Auth::user()->isOperator() || Auth::user()->isSuperAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 sm:px-3.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 border border-slate-700 rounded-xl transition-all shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-500">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span>Panel Operator</span>
                            </a>
                        @elseif(Auth::user()->isSiswa() || Auth::user()->student)
                            <a href="{{ route('student.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 sm:px-3.5 sm:py-2 text-xs sm:text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 rounded-xl transition-all shadow-md shadow-brand-500/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard Siswa</span>
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="hidden sm:inline">
                            @csrf
                            <button type="submit" title="Keluar" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-xl border border-transparent hover:border-rose-100 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    @endguest

                    <!-- Mobile Hamburger Button -->
                    <button 
                        type="button" 
                        id="mobile-menu-btn"
                        class="lg:hidden p-2 text-slate-700 hover:text-brand-600 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 active:bg-slate-200/80"
                        aria-label="Buka menu navigasi"
                        aria-expanded="false"
                        onclick="toggleMobileMenu()"
                    >
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200/90 bg-white/98 backdrop-blur-xl px-4 sm:px-6 pt-4 pb-6 space-y-3.5 shadow-2xl max-h-[calc(100vh-4rem)] overflow-y-auto">
            <!-- Top Mobile Auth Card -->
            @guest
                <div class="p-3 bg-gradient-to-r from-brand-50 to-blue-50/60 rounded-2xl border border-brand-100/80 flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-brand-900 font-display">Portal Siswa & Guru</div>
                        <div class="text-[11px] text-brand-700/80">Akses dashboard prestasi resmi</div>
                    </div>
                    <a href="{{ route('login') }}" onclick="closeMobileMenu()" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-brand-600 hover:bg-brand-700 active:scale-[0.98] rounded-xl transition-all shadow-sm shadow-brand-500/20 flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Masuk Portal</span>
                    </a>
                </div>
            @else
                <div class="p-3 bg-slate-900 text-white rounded-2xl flex items-center justify-between gap-3 shadow-sm">
                    <div class="min-w-0 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-400 text-slate-950 font-bold flex items-center justify-center text-xs flex-shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold truncate">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-amber-300 capitalize truncate">
                                {{ Auth::user()->isOperator() ? 'Operator Kesiswaan' : 'Siswa SMAN Unggulan' }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 flex-shrink-0">
                        @if(Auth::user()->isOperator() || Auth::user()->isSuperAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-2.5 py-1.5 text-xs font-bold bg-brand-600 hover:bg-brand-700 rounded-lg text-white transition-colors">
                                Panel
                            </a>
                        @elseif(Auth::user()->isSiswa() || Auth::user()->student)
                            <a href="{{ route('student.dashboard') }}" class="px-2.5 py-1.5 text-xs font-bold bg-brand-600 hover:bg-brand-700 rounded-lg text-white transition-colors">
                                Panel
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" title="Keluar" class="p-1.5 text-slate-400 hover:text-rose-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endguest

            <!-- Quick Search Input inside Mobile Menu -->
            <button 
                type="button" 
                onclick="focusDirectorySearch()" 
                class="w-full flex items-center justify-between px-3.5 py-2.5 bg-slate-100/90 hover:bg-slate-100 text-slate-500 rounded-xl text-xs font-medium border border-slate-200/80 transition-colors"
            >
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Cari data prestasi, nama siswa...</span>
                </span>
                <span class="px-2 py-0.5 text-[10px] font-bold bg-white text-slate-600 border border-slate-200 rounded-md">Cari</span>
            </button>

            <!-- Categorized Navigation Links -->
            <div class="space-y-1 pt-1">
                <a href="{{ route('home') }}" onclick="closeMobileMenu(); scrollToTop(event);" class="flex items-center gap-2.5 px-3 py-2 text-sm font-semibold text-slate-800 hover:bg-brand-50 hover:text-brand-700 rounded-xl transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda Utama</span>
                </a>

                <div class="pt-2 border-t border-slate-100">
                    <div class="px-3 pb-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Profil Sekolah</div>
                    <div class="space-y-0.5">
                        <a href="{{ route('home') }}#sambutan" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Sambutan Kepala Sekolah
                        </a>
                        <a href="{{ route('home') }}#visi-misi" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Visi & Misi Strategis
                        </a>
                        <a href="{{ route('home') }}#profil-sejarah" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Sejarah & Tenaga Pendidik
                        </a>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <div class="px-3 pb-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Katalog Prestasi</div>
                    <div class="space-y-0.5">
                        <a href="{{ route('home') }}#statistik" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Rekapitulasi Medali & Statistik
                        </a>
                        <a href="{{ route('home') }}#direktori" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Direktori Prestasi Siswa Terpadu
                        </a>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <div class="px-3 pb-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Informasi & Fasilitas</div>
                    <div class="space-y-0.5">
                        <a href="{{ route('home') }}#berita-agenda" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Berita Kegiatan & Pengumuman
                        </a>
                        <a href="{{ route('home') }}#fasilitas" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Galeri Fasilitas Sekolah
                        </a>
                        <a href="{{ route('home') }}#kontak-ppdb" onclick="closeMobileMenu()" class="block px-3 py-1.5 text-xs sm:text-sm font-medium text-slate-700 hover:text-brand-600 hover:bg-slate-50 rounded-lg transition-colors">
                            Kontak & Layanan PPDB
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Floating Toast Notification (Zero Layout Shift) -->
    @if(session('success') || session('error') || $errors->any())
        <div id="flash-message-container" class="fixed top-20 left-1/2 -translate-x-1/2 z-50 max-w-md w-[calc(100%-2rem)] transition-all duration-300 pointer-events-auto">
            @if(session('success'))
                <div class="flex items-center justify-between gap-3 px-4 py-3 bg-white/95 backdrop-blur-md border border-emerald-200/90 text-slate-800 rounded-2xl shadow-xl shadow-slate-950/10 ring-1 ring-emerald-500/20 animate-fade-in">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 truncate">{{ session('success') }}</p>
                    </div>
                    <button 
                        type="button" 
                        onclick="dismissFlashMessage()" 
                        class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors cursor-pointer flex-shrink-0" 
                        aria-label="Tutup notifikasi"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center justify-between gap-3 px-4 py-3 bg-white/95 backdrop-blur-md border border-rose-200/90 text-slate-800 rounded-2xl shadow-xl shadow-slate-950/10 ring-1 ring-rose-500/20 animate-fade-in mt-2">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 border border-rose-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-xs sm:text-sm font-semibold text-slate-800 truncate">{{ session('error') }}</p>
                    </div>
                    <button 
                        type="button" 
                        onclick="dismissFlashMessage()" 
                        class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors cursor-pointer flex-shrink-0" 
                        aria-label="Tutup notifikasi"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <script>
            function dismissFlashMessage() {
                const el = document.getElementById('flash-message-container');
                if (el) {
                    el.style.opacity = '0';
                    el.style.transform = 'translate(-50%, -15px)';
                    setTimeout(() => el.remove(), 350);
                }
            }

            // Notifikasi otomatis menghilang dalam 3.5 detik
            setTimeout(dismissFlashMessage, 3500);
        </script>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Lengkap & Peta Lokasi -->
    <footer class="bg-slate-950 text-slate-300 border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800/80">
                
                <!-- Col 1: Identity & Accreditation (4 cols) -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('favicon.svg') }}" alt="Logo SMA" class="w-10 h-10 rounded-xl shadow-md shadow-brand-500/30 object-contain">
                        <div>
                            <span class="text-white text-lg font-bold font-display block leading-tight">SMA NEGERI UNGGULAN</span>
                            <span class="text-xs text-slate-400">Pusat Keunggulan Sains & Karakter</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Portal resmi profil sekolah dan sistem kurasi portofolio prestasi siswa. Berkomitmen mencetak generasi pembelajar yang berakhlak mulia, berprestasi global, dan adaptif terhadap perkembangan teknologi.
                    </p>
                    <div class="flex flex-wrap items-center gap-2 pt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                            Akreditasi A (Unggul: 98)
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold bg-brand-500/10 text-brand-400 border border-brand-500/30">
                            Sekolah Penggerak Mandiri
                        </span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat (2 cols) -->
                <div class="lg:col-span-2">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-100 mb-4 font-display">Profil & Navigasi</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('home') }}#sambutan" class="hover:text-white transition-colors">Sambutan Kepala Sekolah</a></li>
                        <li><a href="{{ route('home') }}#visi-misi" class="hover:text-white transition-colors">Visi & Misi</a></li>
                        <li><a href="{{ route('home') }}#profil-sejarah" class="hover:text-white transition-colors">Pendidik & Sejarah</a></li>
                        <li><a href="{{ route('home') }}#fasilitas" class="hover:text-white transition-colors">Galeri Fasilitas</a></li>
                    </ul>
                </div>

                <!-- Col 3: Portal Prestasi & PPDB (2 cols) -->
                <div class="lg:col-span-2">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-100 mb-4 font-display">Prestasi & PPDB</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}#statistik" class="hover:text-white transition-colors">Statistik Medali</a></li>
                        <li><a href="{{ route('home') }}#direktori" class="hover:text-white transition-colors">Katalog Prestasi</a></li>
                        <li><a href="{{ route('home') }}#berita-agenda" class="hover:text-white transition-colors">Berita & Pengumuman</a></li>
                        <li><a href="{{ route('home') }}#kontak-ppdb" class="hover:text-white transition-colors">Informasi PPDB</a></li>
                    </ul>
                </div>

                <!-- Col 4: Peta Lokasi & Kontak Resmi (4 cols) -->
                <div class="lg:col-span-4 space-y-3">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-100 mb-2 font-display">Lokasi & Kontak Humas</h3>
                    
                    <!-- Google Maps Embed Responsif -->
                    <div class="w-full h-36 rounded-xl overflow-hidden border border-slate-800 shadow-md">
                        <iframe 
                            title="Peta Lokasi Kampus SMA Negeri Unggulan"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.40693574218!2d107.57311681289063!3d-6.9034443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1710000000000!5m2!1sen!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="grayscale opacity-85 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                        ></iframe>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">
                        Jl. Pendidikan Raya No. 128, Kampus Terpadu SMA Negeri Unggulan, Kota Bandung, Jawa Barat 40132
                    </p>
                    <div class="text-xs text-slate-400 space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="text-slate-500">Email:</span>
                            <a href="mailto:info@prestasi.sch.id" class="text-brand-400 hover:underline">info@prestasi.sch.id</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-500">WhatsApp:</span>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="text-emerald-400 hover:underline">+62 812-3456-7890 (Humas)</a>
                        </div>
                    </div>

                    <!-- Media Sosial -->
                    <div class="flex items-center gap-3 pt-2">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-brand-500 transition-colors" title="Instagram Resmi">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-red-500 transition-colors" title="YouTube Resmi">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-blue-500 transition-colors" title="Facebook Resmi">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} SMA Negeri Unggulan. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center gap-4">
                    <span>Sistem Informasi Prestasi Siswa Terpadu</span>
                    <span>•</span>
                    <a href="{{ route('home') }}#kontak-ppdb" class="hover:text-slate-300 transition-colors">Layanan Pengaduan & Informasi</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
            const btn = document.getElementById('mobile-menu-btn');

            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                hamburger.classList.add('hidden');
                close.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                menu.classList.add('hidden');
                hamburger.classList.remove('hidden');
                close.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }
        }

        function closeMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
            const btn = document.getElementById('mobile-menu-btn');
            if (menu) {
                menu.classList.add('hidden');
                if (hamburger) hamburger.classList.remove('hidden');
                if (close) close.classList.add('hidden');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        }

        function scrollToTop(e) {
            const homeUrl = "{{ route('home') }}";
            const currentPath = window.location.pathname;
            const isHomePage = currentPath === '/' || 
                               window.location.href.split('#')[0] === homeUrl ||
                               window.location.href.split('?')[0].split('#')[0] === homeUrl;

            if (isHomePage) {
                if (e) e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                if (window.location.hash) {
                    history.pushState(null, null, currentPath);
                }
            }
        }

        function focusDirectorySearch() {
            closeMobileMenu();
            if (typeof openNavSearchModal === 'function') {
                openNavSearchModal();
                return;
            }
            const searchModal = document.getElementById('nav-search-modal');
            if (searchModal) {
                searchModal.showModal();
                const input = document.getElementById('nav-modal-search-input');
                if (input) setTimeout(() => input.focus(), 50);
                return;
            }
            const dirSection = document.getElementById('direktori');
            if (dirSection) {
                dirSection.scrollIntoView({ behavior: 'smooth' });
            } else {
                window.location.href = "{{ route('home') }}#direktori";
            }
        }

        // Desktop Navbar Dropdown handling with graceful timeout and click toggle
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownItems = document.querySelectorAll('.nav-dropdown-item');
            
            dropdownItems.forEach(item => {
                const toggleBtn = item.querySelector('.nav-dropdown-toggle');
                const menu = item.querySelector('.nav-dropdown-menu');
                const arrow = item.querySelector('.dropdown-arrow');
                let closeTimer = null;

                function openMenu() {
                    if (closeTimer) {
                        clearTimeout(closeTimer);
                        closeTimer = null;
                    }
                    dropdownItems.forEach(other => {
                        if (other !== item) {
                            other.classList.remove('is-open');
                            const otherMenu = other.querySelector('.nav-dropdown-menu');
                            const otherBtn = other.querySelector('.nav-dropdown-toggle');
                            const otherArrow = other.querySelector('.dropdown-arrow');
                            if (otherMenu) otherMenu.classList.remove('menu-active');
                            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                            if (otherArrow) otherArrow.classList.remove('rotate-180');
                        }
                    });

                    item.classList.add('is-open');
                    if (menu) menu.classList.add('menu-active');
                    if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');
                    if (arrow) arrow.classList.add('rotate-180');
                }

                function closeMenu(immediate = false) {
                    if (closeTimer) clearTimeout(closeTimer);
                    if (immediate) {
                        item.classList.remove('is-open');
                        if (menu) menu.classList.remove('menu-active');
                        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
                        if (arrow) arrow.classList.remove('rotate-180');
                    } else {
                        // Graceful delay before closing on mouseleave (300ms)
                        closeTimer = setTimeout(() => {
                            item.classList.remove('is-open');
                            if (menu) menu.classList.remove('menu-active');
                            if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
                            if (arrow) arrow.classList.remove('rotate-180');
                        }, 300);
                    }
                }

                item.addEventListener('mouseenter', () => openMenu());
                item.addEventListener('mouseleave', () => closeMenu(false));

                if (toggleBtn) {
                    toggleBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (item.classList.contains('is-open') && menu && menu.classList.contains('menu-active')) {
                            closeMenu(true);
                        } else {
                            openMenu();
                        }
                    });
                }

                if (menu) {
                    menu.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', () => closeMenu(true));
                    });
                }
            });

            document.addEventListener('click', (e) => {
                if (!e.target.closest('.nav-dropdown-item')) {
                    dropdownItems.forEach(item => {
                        item.classList.remove('is-open');
                        const menu = item.querySelector('.nav-dropdown-menu');
                        const btn = item.querySelector('.nav-dropdown-toggle');
                        const arrow = item.querySelector('.dropdown-arrow');
                        if (menu) menu.classList.remove('menu-active');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                        if (arrow) arrow.classList.remove('rotate-180');
                    });
                }
            });
        });
    </script>

    <style>
        .nav-dropdown-menu.menu-active {
            opacity: 1 !important;
            transform: translateY(0) !important;
            pointer-events: auto !important;
        }
        .nav-dropdown-item.is-open .dropdown-arrow {
            transform: rotate(180deg);
            color: #026fc7;
        }
    </style>

    @stack('scripts')
</body>
</html>
