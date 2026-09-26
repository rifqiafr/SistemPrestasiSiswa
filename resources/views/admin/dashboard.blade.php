@extends('admin.layout')

@section('title', 'Dashboard Operator Kesiswaan')
@section('page_title', 'Ringkasan Eksekutif')
@section('page_heading', 'Dashboard Operator & Verifikasi Prestasi')

@section('content')
<div class="space-y-8">

    <!-- 1. Operator Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-brand-950 p-6 sm:p-8 text-white shadow-xl">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-20 -top-10 w-48 h-48 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-semibold text-amber-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Pusat Kendali Prestasi Siswa</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-display tracking-tight text-white">
                    Halo, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Kelola etalase prestasi siswa, kurasi dan verifikasi dokumen sertifikat lomba, serta cetak laporan akreditasi sekolah secara terpusat dan akurat.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.achievement.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 shadow-lg shadow-amber-500/20 transition-all hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Input Prestasi Baru</span>
                </a>
                <a href="{{ route('admin.report.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs sm:text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Laporan Akreditasi</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Four Key Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Prestasi -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Prestasi</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black font-display text-slate-900">{{ $totalAchievements }}</span>
                <span class="text-xs font-semibold text-slate-400">Arsip Masuk</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Sorotan Hall of Fame</span>
                <span class="font-bold text-amber-600">{{ $featuredCount }} Prestasi</span>
            </div>
        </div>

        <!-- Card 2: Menunggu Verifikasi (URGENT) -->
        <div class="p-6 rounded-2xl bg-white border {{ $draftCount > 0 ? 'border-amber-300 ring-2 ring-amber-100' : 'border-slate-200' }} shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Perlu Verifikasi</span>
                <div class="w-10 h-10 rounded-xl {{ $draftCount > 0 ? 'bg-amber-100 text-amber-700 animate-pulse' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black font-display text-amber-600">{{ $draftCount }}</span>
                <span class="text-xs font-semibold text-amber-700">Draf / Menunggu</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                @if($draftCount > 0)
                    <span class="text-amber-700 font-medium">Ada permohonan baru</span>
                    <a href="#antrean-verifikasi" class="font-bold text-amber-600 hover:text-amber-800 underline">Lihat Antrean</a>
                @else
                    <span class="text-emerald-600 font-medium">Semua draf selesai</span>
                    <span class="text-slate-400">Siap</span>
                @endif
            </div>
        </div>

        <!-- Card 3: Terpublikasi -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Tayang di Web</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black font-display text-emerald-600">{{ $publishedCount }}</span>
                <span class="text-xs font-semibold text-slate-400">Terverifikasi</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Rasio Publikasi</span>
                <span class="font-bold text-slate-700">
                    {{ $totalAchievements > 0 ? round(($publishedCount / $totalAchievements) * 100) : 0 }}%
                </span>
            </div>
        </div>

        <!-- Card 4: Siswa Berprestasi -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Siswa Berprestasi</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-baseline gap-2">
                <span class="text-3xl font-black font-display text-purple-600">{{ $studentsWithAwards }}</span>
                <span class="text-xs font-semibold text-slate-400">dari {{ $totalStudents }} Siswa</span>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Siswa Terdaftar</span>
                <a href="{{ route('admin.student.index') }}" class="font-bold text-brand-600 hover:underline">Kelola Data</a>
            </div>
        </div>
    </div>

    <!-- 3. Urgent Verification Queue -->
    <div id="antrean-verifikasi" class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold">
                    {{ $draftCount }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900">
                        Antrean Verifikasi Prestasi Siswa
                    </h3>
                    <p class="text-xs text-slate-500">
                        Pengajuan prestasi oleh siswa yang menunggu kurasi dan persetujuan staf kesiswaan.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.achievement.index', ['status' => 'draft']) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800 transition-colors">
                    Lihat Semua Draf &rarr;
                </a>
            </div>
        </div>

        @if($pendingAchievements->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-4">Prestasi & Kejuaraan</th>
                            <th class="py-3 px-4">Siswa Peserta</th>
                            <th class="py-3 px-4">Tingkat / Bidang</th>
                            <th class="py-3 px-4">Tanggal Diajukan</th>
                            <th class="py-3 px-4 text-right">Tindakan Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($pendingAchievements as $item)
                            <tr class="hover:bg-amber-50/40 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-900 line-clamp-1 max-w-sm">
                                        {{ $item->title }}
                                    </div>
                                    <div class="text-xs text-slate-500 flex items-center gap-2 mt-0.5">
                                        <span class="font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-sm border border-amber-200">
                                            {{ $item->rank_grade }}
                                        </span>
                                        <span>•</span>
                                        <span>{{ $item->organizer }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-xs font-semibold text-slate-800">
                                        {{ $item->participants->pluck('full_name')->join(', ') ?: 'Siswa belum ditautkan' }}
                                    </div>
                                    <div class="text-[11px] text-slate-500">
                                        {{ $item->participants->pluck('class_grade')->filter()->unique()->join(', ') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->competition_level === 'Internasional' ? 'bg-purple-100 text-purple-700' : ($item->competition_level === 'Nasional' ? 'bg-red-100 text-red-700' : ($item->competition_level === 'Provinsi' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700')) }}">
                                        {{ $item->competition_level }}
                                    </span>
                                    <div class="text-[11px] text-slate-400 mt-1">
                                        {{ $item->category->name ?? 'Umum' }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-xs text-slate-500 whitespace-nowrap">
                                    <div>{{ $item->created_at->format('d M Y, H:i') }}</div>
                                    <div class="text-[11px] text-slate-400">Diajukan: {{ $item->creator->name ?? 'Siswa' }}</div>
                                </td>
                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Cepat Verifikasi & Publikasi -->
                                        <form action="{{ route('admin.achievement.toggle-status', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Terbitkan ke Website" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition-colors shadow-xs">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Verifikasi & Terbitkan</span>
                                            </button>
                                        </form>

                                        <!-- Edit / Detail Link -->
                                        <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors" title="Edit Rincian">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.achievement.show', $item->id) }}" class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors" title="Lihat Sertifikat">
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
            <div class="py-12 px-4 text-center">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h4 class="text-sm font-bold text-slate-800">Semua Permohonan Terverifikasi Bersih</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                    Tidak ada prestasi baru yang berstatus draf. Semua pengajuan siswa saat ini telah diperiksa dan diterbitkan ke website.
                </p>
            </div>
        @endif
    </div>

    <!-- 4. Grid Section: Breakdown by Level & Top Students -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Col 1 & 2: Distribusi Prestasi per Wilayah -->
        <div class="lg:col-span-2 rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Distribusi Tingkat Kejuaraan</h3>
                    <p class="text-xs text-slate-500">Statistik perolehan prestasi berdasarkan tingkatan kompetisi</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
                    {{ $totalAchievements }} Arsip
                </span>
            </div>

            <div class="space-y-4">
                @foreach($levels as $levelName => $levelCount)
                    @php
                        $percentage = $totalAchievements > 0 ? round(($levelCount / $totalAchievements) * 100) : 0;
                        $colorClass = match($levelName) {
                            'Internasional' => 'bg-purple-600',
                            'Nasional' => 'bg-red-500',
                            'Provinsi' => 'bg-blue-600',
                            'Kabupaten/Kota' => 'bg-emerald-600',
                            default => 'bg-slate-500',
                        };
                    @endphp
                    <div>
                        <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                            <span class="text-slate-700 flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full {{ $colorClass }}"></span>
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
            <div class="pt-4 border-t border-slate-100">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                    Persebaran Kategori Bidang:
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $cat)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-slate-50 border border-slate-200 text-slate-700">
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
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Siswa Berprestasi Terbanyak</h3>
                        <p class="text-xs text-slate-500">Peringkat perolehan piala & sertifikat</p>
                    </div>
                    <a href="{{ route('admin.student.index') }}" class="text-xs font-bold text-brand-600 hover:underline">
                        Semua
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($topStudents as $index => $std)
                        <div class="py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-7 h-7 rounded-full {{ $index === 0 ? 'bg-amber-400 text-slate-950 font-black' : ($index === 1 ? 'bg-slate-300 text-slate-800 font-bold' : ($index === 2 ? 'bg-amber-700 text-white font-bold' : 'bg-slate-100 text-slate-500 font-semibold')) }} flex items-center justify-center text-xs flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-slate-900 truncate">
                                        {{ $std->full_name }}
                                    </div>
                                    <div class="text-[11px] text-slate-400">
                                        {{ $std->class_grade }} • NISN: {{ $std->nisn }}
                                    </div>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-xl bg-brand-50 text-brand-700 font-bold text-xs border border-brand-200/50 flex-shrink-0">
                                {{ $std->achievements_count }} Prestasi
                            </span>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 py-6 text-center">Belum ada siswa terhubung.</div>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-4">
                <a href="{{ route('admin.student.index') }}" class="w-full block py-2.5 text-center text-xs font-bold text-slate-700 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors border border-slate-200">
                    Buka Direktori {{ $totalStudents }} Siswa &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Recent Published Achievements Table -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900">Prestasi Diterbitkan Terakhir</h3>
                <p class="text-xs text-slate-500">Daftar arsip yang aktif tampil di katalog publik landing page</p>
            </div>
            <a href="{{ route('admin.achievement.index') }}" class="text-xs font-bold text-brand-600 hover:underline">
                Kelola Seluruh Prestasi &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4">Kejuaraan & Prestasi</th>
                        <th class="py-3 px-4">Peringkat & Tingkat</th>
                        <th class="py-3 px-4">Siswa</th>
                        <th class="py-3 px-4">Tanggal Event</th>
                        <th class="py-3 px-4 text-center">Sorotan</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentPublished as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 line-clamp-1 max-w-xs">
                                    {{ $item->title }}
                                </div>
                                <div class="text-xs text-slate-400">
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
                                {{ $item->participants->pluck('full_name')->join(', ') ?: '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-500 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($item->is_featured)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                        ⭐ Unggulan
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.achievement.show', $item->id) }}" class="p-1.5 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-100" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-1.5 text-slate-400 hover:text-brand-600 rounded-lg hover:bg-slate-100" title="Edit">
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
