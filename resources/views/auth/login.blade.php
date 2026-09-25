@extends('layouts.app')

@section('title', 'Portal Masuk Kesiswaan - Sistem Informasi Prestasi Siswa')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl border border-slate-200/90 shadow-xl p-8 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center mb-4 shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold font-display text-slate-900">Portal Kesiswaan</h2>
            <p class="text-xs text-slate-500 mt-1">Masuk untuk mengelola data prestasi dan laporan akreditasi</p>
        </div>

        <!-- Form Login -->
        <form action="#" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">Alamat Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    placeholder="nama@prestasi.sch.id"
                    value="kesiswaan@prestasi.sch.id"
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800"
                >
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold uppercase text-slate-600">Kata Sandi</label>
                    <a href="#" class="text-xs font-semibold text-brand-600 hover:text-brand-700">Lupa Sandi?</a>
                </div>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    placeholder="••••••••"
                    value="operator123"
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800"
                >
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
                    <span class="text-xs text-slate-600">Ingat Sesi Saya</span>
                </label>
                <span class="text-[11px] text-slate-400">Proteksi Rate Limit Aktif</span>
            </div>

            <button 
                type="submit" 
                class="w-full py-3 px-4 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md shadow-brand-500/20"
            >
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Credentials Helper for Demo -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-xs text-slate-500 space-y-2">
            <p class="font-semibold text-slate-700">Akun Pengujian Demo (Seeder):</p>
            <div class="p-2.5 bg-slate-50 rounded-lg border border-slate-200/80 font-mono text-[11px] space-y-1">
                <div>Superadmin: <strong class="text-slate-800">admin@prestasi.sch.id</strong> / admin123</div>
                <div>Operator: <strong class="text-slate-800">kesiswaan@prestasi.sch.id</strong> / operator123</div>
            </div>
        </div>

    </div>
</div>
@endsection
