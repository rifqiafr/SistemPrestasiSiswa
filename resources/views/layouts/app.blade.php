<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
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
    <header class="sticky top-0 z-40 w-full transition-all duration-300 backdrop-blur-md bg-white/80 border-b border-slate-200/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-brand-400 flex items-center justify-center text-white shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-lg font-bold font-display tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">
                            SMA NEGERI UNGGULAN
                        </span>
                        <span class="block text-xs font-medium text-slate-500 tracking-wide uppercase">
                            Sistem Prestasi Siswa
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <a href="{{ route('home') }}#hero" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-lg transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('home') }}#hall-of-fame" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-lg transition-colors">
                        Hall of Fame
                    </a>
                    <a href="{{ route('home') }}#direktori" class="px-3.5 py-2 text-sm font-semibold text-slate-700 hover:text-brand-600 hover:bg-slate-100/80 rounded-lg transition-colors">
                        Katalog Prestasi
                    </a>
                </nav>

                <!-- Action Button -->
                <div class="flex items-center gap-2 sm:gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-700 hover:text-brand-700 bg-slate-100 hover:bg-brand-50 border border-slate-200 rounded-xl transition-all shadow-sm">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>Masuk Siswa / Guru</span>
                        </a>
                    @else
                        @if(Auth::user()->isSiswa() || Auth::user()->student)
                            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs sm:text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 rounded-xl transition-all shadow-md shadow-brand-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard Siswa</span>
                            </a>
                        @endif

                        <div class="hidden sm:flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-xs font-medium text-slate-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" title="Keluar" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-xl border border-transparent hover:border-rose-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    @endguest
                </div>

            </div>
        </div>
    </header>

    <!-- Flash Messages Container -->
    @if(session('success') || session('error') || $errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm mt-2">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                
                <!-- Col 1: Identity -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-brand-500 flex items-center justify-center text-white font-bold">
                            SMA
                        </div>
                        <span class="text-white text-lg font-bold font-display">SMA NEGERI UNGGULAN</span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-md leading-relaxed">
                        Pusat arsip digital dan publikasi resmi capaian talenta siswa SMA di bidang Akademik dan Non-Akademik. Mendukung transparansi akreditasi sekolah dan apresiasi siswa berprestasi.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                            Terakreditasi A (Unggul)
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-brand-500/10 text-brand-400 border border-brand-500/20">
                            Sekolah Penggerak
                        </span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-200 mb-4 font-display">Tautan Cepat</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-white transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('home') }}#hall-of-fame" class="hover:text-white transition-colors">Hall of Fame (Unggulan)</a></li>
                        <li><a href="{{ route('home') }}#direktori" class="hover:text-white transition-colors">Katalog & Filter Prestasi</a></li>
                        <li><a href="{{ route('home') }}#statistik" class="hover:text-white transition-colors">Rekapitulasi Capaian</a></li>
                    </ul>
                </div>

                <!-- Col 3: Kontak & Info -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-200 mb-4 font-display">Layanan Kesiswaan</h3>
                    <p class="text-sm leading-relaxed text-slate-400">
                        Jl. Pendidikan Raya No. 128, Kampus SMA Negeri Unggulan<br>
                        Email: kesiswaan@prestasi.sch.id<br>
                        Telp: (022) 728-1920
                    </p>
                </div>

            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} SMA Negeri Unggulan. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center gap-6">
                    <span class="hover:text-slate-400 transition-colors">PRD v1.0 Production Ready</span>
                    <span>•</span>
                    <span class="hover:text-slate-400 transition-colors">Core Web Vitals Optimized</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
