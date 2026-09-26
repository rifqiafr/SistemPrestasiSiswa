<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Dashboard Siswa - Sistem Informasi Prestasi Siswa')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-slate-50/70 text-slate-800 antialiased min-h-screen flex flex-col font-sans selection:bg-brand-500 selection:text-white">

    <!-- Navbar Portal Siswa -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-md bg-white/95 border-b border-slate-200/80 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo & School Brand -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-brand-500 flex items-center justify-center text-white shadow-xs group-hover:scale-105 transition-transform duration-200">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-sm sm:text-base font-bold font-display tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">
                                SMA NEGERI UNGGULAN
                            </span>
                            <span class="block text-[10px] font-bold text-brand-600 tracking-wider uppercase">
                                Portal Siswa Berprestasi
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Tabs -->
                <nav class="hidden md:flex items-center gap-1 bg-slate-100/70 p-1 rounded-xl border border-slate-200/60">
                    <a href="{{ route('student.dashboard') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all {{ request()->routeIs('student.dashboard') ? 'bg-white text-brand-700 shadow-2xs' : 'text-slate-600 hover:text-slate-900' }}">
                        Dashboard Saya
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="px-3 py-1.5 text-xs font-semibold text-slate-600 hover:text-brand-600 rounded-lg transition-colors flex items-center gap-1.5">
                        <span>Lihat Web Sekolah</span>
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </nav>

                <!-- User Profile & Action -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-brand-50 border border-brand-100 text-brand-700 font-bold text-xs flex items-center justify-center">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-xs font-bold text-slate-800 leading-tight truncate max-w-[140px]">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-[10px] text-slate-400 font-mono">
                                {{ Auth::user()->student->nisn ?? 'Siswa' }} • {{ Auth::user()->student->class_grade ?? 'Aktif' }}
                            </div>
                        </div>

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" title="Keluar Akun" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Floating Toast Notification (Zero Layout Shift) -->
    @if(session('success') || session('error') || $errors->any())
        <div id="student-flash-container" class="fixed top-20 left-1/2 -translate-x-1/2 z-50 max-w-md w-[calc(100%-2rem)] transition-all duration-300 pointer-events-auto">
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
                    <button type="button" onclick="dismissStudentFlash()" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors cursor-pointer flex-shrink-0" aria-label="Tutup notifikasi">
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
                    <button type="button" onclick="dismissStudentFlash()" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors cursor-pointer flex-shrink-0" aria-label="Tutup notifikasi">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <script>
            function dismissStudentFlash() {
                const el = document.getElementById('student-flash-container');
                if (el) {
                    el.style.opacity = '0';
                    el.style.transform = 'translate(-50%, -15px)';
                    setTimeout(() => el.remove(), 350);
                }
            }
            setTimeout(dismissStudentFlash, 3500);
        </script>
    @endif

    <!-- Content Area -->
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-5 text-xs text-slate-400 text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>© {{ date('Y') }} SMA Negeri Unggulan • Sistem Informasi Portofolio & Prestasi Siswa</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
