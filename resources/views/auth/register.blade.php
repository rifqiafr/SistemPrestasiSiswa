@extends('layouts.app')

@section('title', 'Daftar Akun Siswa Baru - Sistem Informasi Prestasi Siswa')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full bg-white rounded-3xl border border-slate-200/90 shadow-xl p-8 sm:p-10 relative overflow-hidden">
        
        <!-- Top Accent Bar -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-brand-600 via-brand-500 to-gold-500"></div>

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-50 text-brand-600 border border-brand-100 flex items-center justify-center mb-4 shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold font-display text-slate-900">Registrasi Akun Siswa</h2>
            <p class="text-xs text-slate-500 mt-1">Daftarkan profil Anda untuk menginput dan memantau capaian prestasi</p>
        </div>

        <!-- Form Register -->
        <form action="{{ route('register.attempt') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- NISN -->
                <div>
                    <label for="nisn" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        NISN Siswa <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nisn" 
                        name="nisn" 
                        required 
                        placeholder="Contoh: 0092837461"
                        value="{{ old('nisn') }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('nisn') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                    @error('nisn')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required 
                        placeholder="Nama sesuai rapor"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('name') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Kelas -->
                <div>
                    <label for="class_grade" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Kelas <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="class_grade" 
                        name="class_grade" 
                        required 
                        placeholder="Contoh: XII MIPA 1"
                        value="{{ old('class_grade') }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>

                <!-- Angkatan -->
                <div>
                    <label for="cohort_year" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Tahun Masuk <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="cohort_year" 
                        name="cohort_year" 
                        required 
                        min="2020" 
                        max="2035" 
                        value="{{ old('cohort_year', date('Y')) }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="gender" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Jenis Kelamin <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="gender" 
                        name="gender" 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                        <option value="L" {{ old('gender') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender') === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                    Alamat Email Aktif <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    placeholder="nama@gmail.com"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('email') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                >
                @error('email')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Kata Sandi -->
                <div>
                    <label for="password" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Kata Sandi <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="Minimal 6 karakter"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border @error('password') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase text-slate-600 mb-1.5">
                        Ulangi Kata Sandi <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required 
                        placeholder="Ketik ulang kata sandi"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>
            </div>

            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md shadow-brand-500/20 flex items-center justify-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Daftar & Masuk ke Dashboard</span>
                </button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-600">
            <span>Sudah memiliki akun siswa? </span>
            <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-700 hover:underline">
                Masuk Disini
            </a>
        </div>

    </div>
</div>
@endsection
