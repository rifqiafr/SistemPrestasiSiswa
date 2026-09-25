@extends('layouts.app')

@section('title', 'Masuk Portal Siswa & Kesiswaan - Sistem Informasi Prestasi Siswa')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl border border-slate-200/90 shadow-xl p-8 sm:p-10 relative overflow-hidden">
        
        <!-- Top Accent Bar -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-brand-600 via-brand-500 to-gold-500"></div>

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center mb-4 shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold font-display text-slate-900">Portal Masuk Prestasi</h2>
            <p class="text-xs text-slate-500 mt-1">Siswa dapat masuk menggunakan <strong>NISN</strong> atau <strong>Email</strong></p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="login" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                    NISN atau Alamat Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="login" 
                        name="login" 
                        required 
                        autofocus
                        placeholder="Contoh: 0071283910 atau nama@email.com"
                        value="{{ old('login', '0071283910') }}"
                        class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border @error('login') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800"
                    >
                </div>
                @error('login')
                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold uppercase text-slate-600">Kata Sandi</label>
                    <span class="text-[11px] text-slate-400">Default Siswa: <code class="text-brand-600 font-mono">siswa123</code></span>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="••••••••"
                        value="siswa123"
                        class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border @error('password') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800"
                    >
                </div>
                @error('password')
                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
                    <span class="text-xs text-slate-600">Ingat Sesi Saya</span>
                </label>
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-slate-800">
                    Kembali ke Beranda
                </a>
            </div>

            <button 
                type="submit" 
                class="w-full py-3 px-4 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md shadow-brand-500/20 flex items-center justify-center gap-2"
            >
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-600">
            <span>Siswa belum punya akun? </span>
            <a href="{{ route('register') }}" class="font-bold text-brand-600 hover:text-brand-700 hover:underline">
                Daftar Akun Siswa Baru
            </a>
        </div>

        <!-- 1-Click Demo Login Helpers -->
        <div class="mt-6 p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 text-xs">
            <p class="font-semibold text-slate-700 mb-2 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                </svg>
                <span>1-Click Coba Akun Demo:</span>
            </p>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" onclick="setDemo('0071283910', 'siswa123')" class="p-2 text-left bg-white border border-slate-200 rounded-xl hover:border-brand-500 hover:bg-brand-50/50 transition-colors">
                    <div class="font-semibold text-slate-800 text-[11px] truncate">Sarah Azzahra</div>
                    <div class="text-[10px] text-slate-500">Siswa (NISN)</div>
                </button>
                <button type="button" onclick="setDemo('0082910291', 'siswa123')" class="p-2 text-left bg-white border border-slate-200 rounded-xl hover:border-brand-500 hover:bg-brand-50/50 transition-colors">
                    <div class="font-semibold text-slate-800 text-[11px] truncate">M. Rizky Pratama</div>
                    <div class="text-[10px] text-slate-500">Siswa (NISN)</div>
                </button>
                <button type="button" onclick="setDemo('kesiswaan@prestasi.sch.id', 'operator123')" class="p-2 text-left bg-white border border-slate-200 rounded-xl hover:border-brand-500 hover:bg-brand-50/50 transition-colors">
                    <div class="font-semibold text-slate-800 text-[11px] truncate">Staf Kesiswaan</div>
                    <div class="text-[10px] text-slate-500">Operator</div>
                </button>
                <button type="button" onclick="setDemo('admin@prestasi.sch.id', 'admin123')" class="p-2 text-left bg-white border border-slate-200 rounded-xl hover:border-brand-500 hover:bg-brand-50/50 transition-colors">
                    <div class="font-semibold text-slate-800 text-[11px] truncate">Kepala Sekolah</div>
                    <div class="text-[10px] text-slate-500">Superadmin</div>
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    function setDemo(login, password) {
        document.getElementById('login').value = login;
        document.getElementById('password').value = password;
    }
</script>
@endsection
