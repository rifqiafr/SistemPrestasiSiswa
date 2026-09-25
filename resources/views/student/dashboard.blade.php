@extends('student.layout')

@section('title', 'Dashboard Siswa - ' . $student->full_name)

@section('content')
<div class="space-y-8">

    <!-- 1. HERO WELCOME BANNER -->
    <div class="relative overflow-hidden bg-gradient-to-r from-brand-900 via-brand-800 to-indigo-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl">
        <!-- Glow Orbs -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-48 -bottom-16 w-48 h-48 bg-gold-400/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2.5 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-white text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Portal Prestasi Siswa Terpadu</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-display tracking-tight text-white">
                    Halo, {{ $student->full_name }}! 👋
                </h1>
                <p class="text-sm sm:text-base text-slate-200 leading-relaxed">
                    Kelola dan laporkan rekam jejak capaian prestasimu. Setiap sertifikat dan medali yang kamu raih menjadi kebanggaan sekolah dan siap mendukung penilaian akreditasi.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2 text-xs text-slate-300">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/10 border border-white/10 font-mono">
                        <strong>NISN:</strong> {{ $student->nisn }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/10 border border-white/10">
                        <strong>Kelas:</strong> {{ $student->class_grade }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/10 border border-white/10">
                        <strong>Angkatan:</strong> {{ $student->cohort_year }}
                    </span>
                </div>
            </div>

            <!-- Primary Action Button -->
            <div class="flex-shrink-0 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('student.achievement.create') }}" class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-gold-500 to-amber-500 hover:from-gold-600 hover:to-amber-600 text-slate-900 font-bold text-sm rounded-2xl shadow-lg shadow-gold-500/30 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Input Prestasi Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. METRIC STATS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Total Prestasi -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Prestasi</span>
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900 font-display">{{ $totalAchievements }}</span>
                <span class="text-xs text-slate-500">Rekam Capaian</span>
            </div>
            <p class="text-[11px] text-slate-400 mt-2">Seluruh portofolio kompetisi Anda</p>
        </div>

        <!-- Terverifikasi (Published) -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-emerald-200/80 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Terverifikasi</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-emerald-600 font-display">{{ $publishedCount }}</span>
                <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">Tayang</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">Tampil resmi di etalase publik</p>
        </div>

        <!-- Menunggu Verifikasi (Draft) -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-amber-200/80 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Menunggu Validasi</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-amber-600 font-display">{{ $draftCount }}</span>
                <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">Proses</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">Sedang ditinjau Tim Kesiswaan</p>
        </div>

        <!-- Prestasi Nasional / Internasional -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-indigo-200/80 shadow-xs hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-700">Nasional / Global</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-indigo-600 font-display">{{ $internasionalCount + $nasionalCount }}</span>
                <span class="text-xs text-slate-500">Tingkat Tinggi</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">{{ $internasionalCount }} Internasional • {{ $nasionalCount }} Nasional</p>
        </div>

    </div>

    <!-- 3. FILTER & SEARCH BAR -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs space-y-4">
        <form method="GET" action="{{ route('student.dashboard') }}" class="flex flex-col md:flex-row gap-3 items-center justify-between">
            
            <!-- Search Input -->
            <div class="relative w-full md:w-80">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari kejuaraan, juara, instansi..." 
                    class="w-full pl-10 pr-4 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                >
            </div>

            <div class="flex flex-wrap items-center gap-2.5 w-full md:w-auto">
                <!-- Status Filter -->
                <select name="status" onchange="this.form.submit()" class="px-3 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 text-slate-700">
                    <option value="all">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terverifikasi (Published)</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Menunggu Validasi (Draft)</option>
                </select>

                <!-- Category Filter -->
                <select name="category" onchange="this.form.submit()" class="px-3 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 text-slate-700">
                    <option value="all">Semua Bidang</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold rounded-xl transition-colors">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status', 'category']))
                    <a href="{{ route('student.dashboard') }}" class="px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- 4. ACHIEVEMENTS LIST -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 font-display">
                Daftar Prestasi & Portofolio Saya
            </h2>
            <span class="text-xs text-slate-500 font-medium">
                Menampilkan {{ $achievements->total() }} prestasi
            </span>
        </div>

        @if($achievements->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-xs">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 font-display mb-1">Belum Ada Prestasi Terdata</h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mb-6">
                    Kamu belum menginputkan prestasi atau tidak ada prestasi yang cocok dengan kata kunci pencarian. Mulai catat capaian prestasimu sekarang!
                </p>
                <a href="{{ route('student.achievement.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs sm:text-sm rounded-xl transition-all shadow-md shadow-brand-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Input Prestasi Pertama Kamu</span>
                </a>
            </div>
        @else
            <!-- Grid of Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($achievements as $item)
                    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-card-hover transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        
                        <!-- Top Image / Media or Banner -->
                        <div class="relative h-44 overflow-hidden bg-slate-100">
                            @if($item->coverMedia)
                                <img 
                                    src="{{ $item->coverMedia->file_url }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-brand-700 to-indigo-800 flex items-center justify-center text-white/40">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            <!-- Badges on Image -->
                            <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-white/90 backdrop-blur-md text-slate-800 shadow-xs">
                                    {{ $item->category->name ?? 'Umum' }}
                                </span>

                                @if($item->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500 text-white shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        <span>Terverifikasi</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500 text-white shadow-xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        <span>Menunggu Validasi</span>
                                    </span>
                                @endif
                            </div>

                            <!-- Rank & Level on bottom of image -->
                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <div class="text-xs font-bold text-gold-300 flex items-center gap-1.5 drop-shadow-sm">
                                    <svg class="w-4 h-4 text-gold-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $item->rank_grade }}</span>
                                </div>
                                <div class="text-[11px] text-slate-200">
                                    Tingkat {{ $item->competition_level }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-base font-bold text-slate-900 font-display line-clamp-2 leading-snug group-hover:text-brand-600 transition-colors">
                                    {{ $item->title }}
                                </h3>

                                <div class="mt-2.5 space-y-1 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="truncate">{{ $item->organizer }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}</span>
                                    </div>

                                    @if($item->mentor_name)
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="truncate">Pembina: {{ $item->mentor_name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Participants list (if team) -->
                                @if($item->participants->count() > 1)
                                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center gap-1.5 text-[11px] text-slate-500">
                                        <span class="font-semibold text-slate-700">Tim:</span>
                                        <span class="truncate">{{ $item->participants->pluck('full_name')->join(', ') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-5 pt-3.5 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('student.achievement.show', $item->id) }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                    <span>Lihat Detail & Bukti</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <div class="flex items-center gap-2">
                                    @if($item->status === 'draft')
                                        <a href="{{ route('student.achievement.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-colors text-xs font-semibold" title="Edit Pengajuan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('student.achievement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan prestasi ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors text-xs font-semibold" title="Hapus Pengajuan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('prestasi.detail', $item->slug) }}" target="_blank" class="px-2.5 py-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors flex items-center gap-1">
                                            <span>Lihat di Publik</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pt-4">
                {{ $achievements->links() }}
            </div>
        @endif
    </div>

    <!-- 5. ALUR VERIFIKASI GUIDELINE -->
    <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-3xl p-6 sm:p-8 shadow-md">
        <h3 class="text-base sm:text-lg font-bold font-display text-gold-400 mb-2 flex items-center gap-2">
            <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Alur Verifikasi Prestasi Siswa</span>
        </h3>
        <p class="text-xs sm:text-sm text-slate-300 mb-6 max-w-2xl">
            Semua prestasi yang kamu laporkan akan melalui proses verifikasi oleh Tim Kesiswaan sekolah untuk memastikan keaslian sertifikat dan validitas instansi penyelenggara:
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                <div class="w-8 h-8 rounded-xl bg-brand-500/20 text-brand-300 font-bold text-sm flex items-center justify-center mb-3">
                    1
                </div>
                <h4 class="font-bold text-sm text-white mb-1">Input Data & Bukti</h4>
                <p class="text-xs text-slate-400">Siswa mengisi formulir kejuaraan serta mengunggah piagam/sertifikat dan foto dokumentasi lomba.</p>
            </div>

            <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                <div class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-300 font-bold text-sm flex items-center justify-center mb-3">
                    2
                </div>
                <h4 class="font-bold text-sm text-white mb-1">Validasi Kesiswaan</h4>
                <p class="text-xs text-slate-400">Operator/Guru Pembina memeriksa kelengkapan berkas, nomor sertifikat, dan legalitas lomba.</p>
            </div>

            <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-300 font-bold text-sm flex items-center justify-center mb-3">
                    3
                </div>
                <h4 class="font-bold text-sm text-white mb-1">Terbit di Etalase Publik</h4>
                <p class="text-xs text-slate-400">Prestasi disetujui, langsung tampil di Hall of Fame beranda sekolah dan masuk arsip akreditasi resmi.</p>
            </div>
        </div>
    </div>

</div>
@endsection
