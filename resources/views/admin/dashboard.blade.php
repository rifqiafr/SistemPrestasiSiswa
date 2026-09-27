@extends('admin.layout')

@section('title', 'Dashboard Operator Kesiswaan')
@section('page_title', 'Ringkasan Eksekutif')
@section('page_heading', 'Dashboard Operator & Verifikasi Prestasi')

@section('content')
<div class="space-y-8">

    <!-- 1. Operator Welcome Banner (Aligned with Landing Page Palette) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#074b84] via-[#0358a1] to-[#026fc7] p-6 sm:p-8 text-white shadow-xl shadow-brand-900/10">
        <!-- Background Ambient Glow & Patterns -->
        <div class="absolute -right-12 -bottom-12 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/4 -top-10 w-56 h-56 bg-amber-400/15 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(255,255,255,0.12)_0%,transparent_60%)] pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-xs font-semibold text-white/95">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pusat Kendali Prestasi Siswa Terpadu</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-display tracking-tight text-white">
                    Selamat Bertugas, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-sm text-blue-100/90 leading-relaxed">
                    Kelola etalase capaian siswa, kurasi dan verifikasi dokumen sertifikat lomba yang diajukan, serta pantau statistik akreditasi sekolah secara terpusat dan akurat.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.achievement.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-amber-400 hover:bg-amber-300 text-slate-950 shadow-md shadow-amber-500/25 active:scale-[0.98] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Input Prestasi Baru</span>
                </a>

                @if($draftCount > 0)
                    <a href="#antrean-verifikasi" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-white/20 hover:bg-white/30 text-white border border-white/30 backdrop-blur-sm transition-all shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-300 animate-ping"></span>
                        <span>Verifikasi {{ $draftCount }} Draf</span>
                    </a>
                @endif

                <a href="{{ route('admin.report.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs sm:text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-sm transition-colors">
                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Laporan Akreditasi</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Four Key Stat Cards (Clean, Elevated, Consistent Badges) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Prestasi -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md hover:border-brand-200 transition-all relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Prestasi</span>
                <div class="w-11 h-11 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold font-display text-slate-900 tracking-tight">{{ $totalAchievements }}</span>
                <span class="text-xs font-semibold text-slate-400">Total Arsip</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Prestasi Unggulan</span>
                <span class="inline-flex items-center gap-1 font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200/60 text-[11px]">
                    ⭐ {{ $featuredCount }} Terpilih
                </span>
            </div>
        </div>

        <!-- Card 2: Menunggu Verifikasi (URGENT) -->
        <div class="p-6 rounded-2xl bg-white border {{ $draftCount > 0 ? 'border-amber-300 ring-2 ring-amber-100/70 bg-gradient-to-b from-amber-50/20 to-white' : 'border-slate-200/80' }} shadow-xs hover:shadow-md transition-all relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider {{ $draftCount > 0 ? 'text-amber-800' : 'text-slate-500' }}">Perlu Verifikasi</span>
                <div class="w-11 h-11 rounded-xl {{ $draftCount > 0 ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center">
                    <svg class="w-5 h-5 {{ $draftCount > 0 ? 'animate-bounce' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold font-display {{ $draftCount > 0 ? 'text-amber-600' : 'text-slate-700' }} tracking-tight">{{ $draftCount }}</span>
                <span class="text-xs font-semibold {{ $draftCount > 0 ? 'text-amber-800' : 'text-slate-400' }}">Draf Menunggu</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                @if($draftCount > 0)
                    <span class="text-amber-800 font-medium flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        <span>Ada permohonan baru</span>
                    </span>
                    <a href="#antrean-verifikasi" class="font-bold text-amber-700 hover:text-amber-900 underline transition-colors">
                        Periksa Antrean &darr;
                    </a>
                @else
                    <span class="text-emerald-700 font-medium flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Semua draf selesai</span>
                    </span>
                    <span class="text-slate-400 text-[11px]">Terkurasi</span>
                @endif
            </div>
        </div>

        <!-- Card 3: Terpublikasi Aktif -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md hover:border-emerald-200 transition-all relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tayang di Web</span>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold font-display text-emerald-600 tracking-tight">{{ $publishedCount }}</span>
                <span class="text-xs font-semibold text-slate-400">Terverifikasi</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Rasio Publikasi</span>
                <span class="font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded-full text-[11px]">
                    {{ $totalAchievements > 0 ? round(($publishedCount / $totalAchievements) * 100) : 0 }}% Aktif
                </span>
            </div>
        </div>

        <!-- Card 4: Siswa Berprestasi -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:shadow-md hover:border-purple-200 transition-all relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Siswa Berprestasi</span>
                <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold font-display text-purple-600 tracking-tight">{{ $studentsWithAwards }}</span>
                <span class="text-xs font-semibold text-slate-400">dari {{ $totalStudents }} Siswa</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Direktori Siswa</span>
                <a href="{{ route('admin.student.index') }}" class="font-bold text-brand-600 hover:text-brand-800 transition-colors">
                    Kelola Siswa &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Urgent Verification Queue (Antrean Verifikasi Prestasi) -->
    <div id="antrean-verifikasi" class="rounded-2xl bg-white border border-slate-200/80 shadow-xs overflow-hidden scroll-mt-24">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl {{ $draftCount > 0 ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-100 text-emerald-700 border border-emerald-200' }} flex items-center justify-center font-bold text-sm shadow-xs">
                    {{ $draftCount }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-display">
                        Antrean Verifikasi Prestasi Siswa
                    </h3>
                    <p class="text-xs text-slate-500">
                        Pengajuan prestasi oleh siswa yang menunggu kurasi dan persetujuan staf kesiswaan.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.achievement.index', ['status' => 'draft']) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-brand-700 hover:text-brand-800 bg-brand-50 hover:bg-brand-100/70 border border-brand-200/60 transition-colors">
                    <span>Buka Semua Draf ({{ $draftCount }})</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        @if($pendingAchievements->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200/80">
                        <tr>
                            <th class="py-3.5 px-4 sm:px-6">Prestasi & Kejuaraan</th>
                            <th class="py-3.5 px-4">Siswa Peserta</th>
                            <th class="py-3.5 px-4">Tingkat / Bidang</th>
                            <th class="py-3.5 px-4">Waktu Pengajuan</th>
                            <th class="py-3.5 px-4 sm:px-6 text-right">Tindakan Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($pendingAchievements as $item)
                            <tr class="hover:bg-amber-50/30 transition-colors">
                                <td class="py-4 px-4 sm:px-6">
                                    <div class="font-bold text-slate-900 line-clamp-1 max-w-sm">
                                        {{ $item->title }}
                                    </div>
                                    <div class="text-xs text-slate-500 flex items-center gap-2 mt-1">
                                        <span class="font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/70 text-[11px]">
                                            {{ $item->rank_grade }}
                                        </span>
                                        <span class="text-slate-300">•</span>
                                        <span class="truncate max-w-[200px]">{{ $item->organizer }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-xs font-semibold text-slate-800">
                                        {{ $item->participants->pluck('full_name')->join(', ') ?: 'Siswa belum ditautkan' }}
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">
                                        {{ $item->participants->pluck('class_grade')->filter()->unique()->join(', ') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @php
                                        $levelBadge = match($item->competition_level) {
                                            'Internasional' => 'bg-purple-50 text-purple-700 border-purple-200/70',
                                            'Nasional' => 'bg-rose-50 text-rose-700 border-rose-200/70',
                                            'Provinsi' => 'bg-sky-50 text-sky-700 border-sky-200/70',
                                            'Kabupaten/Kota' => 'bg-teal-50 text-teal-700 border-teal-200/70',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200',
                                        };
                                    @endphp
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold border {{ $levelBadge }}">
                                        {{ $item->competition_level }}
                                    </span>
                                    <div class="text-[11px] text-slate-400 mt-1">
                                        {{ $item->category->name ?? 'Umum' }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-xs text-slate-500 whitespace-nowrap">
                                    <div class="font-medium text-slate-700">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Oleh: {{ $item->creator->name ?? 'Siswa' }}</div>
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Cepat Verifikasi & Publikasi -->
                                        <form action="{{ route('admin.achievement.toggle-status', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Terbitkan ke Website Publik" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 active:scale-[0.98] transition-all shadow-xs">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Verifikasi & Terbitkan</span>
                                            </button>
                                        </form>

                                        <!-- Edit / Detail Link -->
                                        <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-2 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-xl transition-colors border border-slate-200/70" title="Edit Rincian">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.achievement.show', $item->id) }}" class="p-2 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-xl transition-colors border border-slate-200/70" title="Lihat Sertifikat & Bukti">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Clean Empty State -->
            <div class="py-12 px-6 text-center">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mx-auto mb-3 shadow-xs">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-base font-bold text-slate-800 font-display">Semua Pengajuan Telah Terverifikasi</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                    Tidak ada antrean tertunda saat ini. Seluruh permohonan prestasi siswa telah diperiksa dan aktif tampil di direktori portal publik sekolah.
                </p>
            </div>
        @endif
    </div>

    <!-- 4. Grid Section: Breakdown by Level & Top Students Leaderboard -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Col 1 & 2: Distribusi Prestasi per Wilayah -->
        <div class="lg:col-span-2 rounded-2xl bg-white border border-slate-200/80 p-6 shadow-xs space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-display">Distribusi Tingkat Kejuaraan</h3>
                    <p class="text-xs text-slate-500">Statistik perolehan medali & juara berdasarkan tingkatan kompetisi</p>
                </div>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200/70">
                    {{ $totalAchievements }} Total Prestasi
                </span>
            </div>

            <div class="space-y-4">
                @foreach($levels as $levelName => $levelCount)
                    @php
                        $percentage = $totalAchievements > 0 ? round(($levelCount / $totalAchievements) * 100) : 0;
                        $colorClass = match($levelName) {
                            'Internasional' => 'bg-purple-600',
                            'Nasional' => 'bg-rose-500',
                            'Provinsi' => 'bg-brand-600',
                            'Kabupaten/Kota' => 'bg-teal-600',
                            default => 'bg-slate-500',
                        };
                        $dotColor = match($levelName) {
                            'Internasional' => 'bg-purple-500',
                            'Nasional' => 'bg-rose-500',
                            'Provinsi' => 'bg-brand-500',
                            'Kabupaten/Kota' => 'bg-teal-500',
                            default => 'bg-slate-400',
                        };
                    @endphp
                    <div>
                        <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                            <span class="text-slate-700 flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full {{ $dotColor }}"></span>
                                <span>Tingkat {{ $levelName }}</span>
                            </span>
                            <span class="text-slate-900 font-bold">
                                {{ $levelCount }} <span class="text-slate-400 font-normal">({{ $percentage }}%)</span>
                            </span>
                        </div>
                        <div class="w-full h-2.5 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full rounded-full {{ $colorClass }} transition-all duration-500" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Categories pills footer -->
            <div class="pt-5 border-t border-slate-100">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2.5">
                    Persebaran Kategori Bidang Kompetisi:
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $cat)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-slate-50 border border-slate-200/80 text-slate-700 hover:bg-slate-100 transition-colors">
                            <span>{{ $cat->name }}</span>
                            <span class="px-1.5 py-0.2 rounded-full bg-slate-200 text-[10px] font-bold text-slate-800">
                                {{ $cat->achievements_count }}
                            </span>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Col 3: Top Students Leaderboard -->
        <div class="rounded-2xl bg-white border border-slate-200/80 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 font-display">Siswa Berprestasi Terbanyak</h3>
                        <p class="text-xs text-slate-500">Peringkat perolehan piala & sertifikat</p>
                    </div>
                    <a href="{{ route('admin.student.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 transition-colors">
                        Lihat Semua
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($topStudents as $index => $std)
                        <div class="py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-7 h-7 rounded-full {{ $index === 0 ? 'bg-gradient-to-br from-amber-400 to-amber-500 text-slate-950 font-black shadow-xs' : ($index === 1 ? 'bg-gradient-to-br from-slate-200 to-slate-300 text-slate-800 font-bold' : ($index === 2 ? 'bg-gradient-to-br from-amber-700 to-amber-800 text-white font-bold' : 'bg-slate-100 text-slate-600 font-semibold')) }} flex items-center justify-center text-xs flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-slate-900 truncate">
                                        {{ $std->full_name }}
                                    </div>
                                    <div class="text-[11px] text-slate-400 truncate">
                                        {{ $std->class_grade }} • NISN: {{ $std->nisn }}
                                    </div>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-xl bg-brand-50 text-brand-700 font-bold text-xs border border-brand-200/60 flex-shrink-0">
                                {{ $std->achievements_count }} Prestasi
                            </span>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 py-6 text-center">Belum ada siswa terhubung.</div>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-4">
                <a href="{{ route('admin.student.index') }}" class="w-full block py-2.5 text-center text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors border border-slate-200/80">
                    Buka Direktori {{ $totalStudents }} Siswa &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Recent Published Achievements Table -->
    <div class="rounded-2xl bg-white border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-slate-50/60">
            <div>
                <h3 class="text-base font-bold text-slate-900 font-display">Prestasi Diterbitkan Terakhir</h3>
                <p class="text-xs text-slate-500">Daftar arsip yang aktif tampil di direktori portal publik sekolah</p>
            </div>
            <a href="{{ route('admin.achievement.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-700 hover:text-brand-800 transition-colors">
                <span>Kelola Seluruh Prestasi</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50/80 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200/80">
                    <tr>
                        <th class="py-3.5 px-4 sm:px-6">Kejuaraan & Prestasi</th>
                        <th class="py-3.5 px-4">Peringkat & Tingkat</th>
                        <th class="py-3.5 px-4">Siswa Penerima</th>
                        <th class="py-3.5 px-4">Tanggal Event</th>
                        <th class="py-3.5 px-4 text-center">Sorotan</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentPublished as $item)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-3.5 px-4 sm:px-6">
                                <div class="font-bold text-slate-900 line-clamp-1 max-w-xs">
                                    {{ $item->title }}
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5">
                                    {{ $item->organizer }} • {{ $item->category->name ?? '-' }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="font-semibold text-slate-800 text-xs block">
                                    {{ $item->rank_grade }}
                                </span>
                                <span class="text-[11px] font-medium text-slate-500">
                                    {{ $item->competition_level }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-700">
                                <span class="line-clamp-1 max-w-[200px]">
                                    {{ $item->participants->pluck('full_name')->join(', ') ?: '-' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($item->is_featured)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200/70">
                                        ⭐ Unggulan
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 sm:px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.achievement.show', $item->id) }}" class="p-2 text-slate-500 hover:text-brand-600 rounded-xl hover:bg-slate-100 border border-slate-200/60 transition-colors" title="Lihat Rincian">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-2 text-slate-500 hover:text-brand-600 rounded-xl hover:bg-slate-100 border border-slate-200/60 transition-colors" title="Edit Prestasi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
