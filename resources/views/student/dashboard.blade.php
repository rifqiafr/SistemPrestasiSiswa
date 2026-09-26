@extends('student.layout')

@section('title', 'Dashboard Siswa - ' . $student->full_name)

@section('content')
<div class="space-y-6">

    <!-- 1. CLEAN GREETING & PROFILE HEADER -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Akun Siswa Aktif</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold font-display tracking-tight text-slate-900">
                    Halo, {{ $student->full_name }}! 👋
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 max-w-2xl leading-relaxed">
                    Kelola dan laporkan rekam jejak capaian prestasimu. Setiap sertifikat dan medali yang kamu raih akan ditinjau tim kesiswaan untuk arsip akreditasi dan publikasi resmi sekolah.
                </p>
                <div class="flex flex-wrap items-center gap-2 pt-1 text-xs">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-mono font-medium">
                        <span class="text-slate-400">NISN:</span> {{ $student->nisn }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium">
                        <span class="text-slate-400">Kelas:</span> {{ $student->class_grade }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium">
                        <span class="text-slate-400">Angkatan:</span> {{ $student->cohort_year }}
                    </span>
                </div>
            </div>

            <div class="flex-shrink-0 self-start md:self-center">
                <a 
                    href="{{ route('student.achievement.create') }}" 
                    class="inline-flex items-center gap-2 px-5 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-xs hover:shadow-md transition-all cursor-pointer"
                >
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Input Prestasi Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. METRIC STATS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Prestasi -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold">Total Prestasi</span>
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display">
                {{ $totalAchievements }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Seluruh portofolio terdata</div>
        </div>

        <!-- Terverifikasi -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold text-emerald-700">Terverifikasi</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600 font-display">
                {{ $publishedCount }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Tayang di etalase publik</div>
        </div>

        <!-- Menunggu Validasi -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold text-amber-700">Menunggu Validasi</span>
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-extrabold text-amber-600 font-display">
                {{ $draftCount }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Dalam proses pemeriksaan</div>
        </div>

        <!-- Tingkat Nasional / Global -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold text-indigo-700">Nasional & Global</span>
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-extrabold text-indigo-600 font-display">
                {{ $internasionalCount + $nasionalCount }}
            </div>
            <div class="text-[11px] text-slate-400 mt-1">{{ $internasionalCount }} Global • {{ $nasionalCount }} Nasional</div>
        </div>

    </div>

    <!-- 3. SEARCH & FILTER BAR -->
    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs">
        <form method="GET" action="{{ route('student.dashboard') }}" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
            
            <!-- Search Input -->
            <div class="relative w-full sm:w-80">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari prestasi, juara, penyelenggara..." 
                    class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-slate-50/70 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 text-slate-800"
                >
            </div>

            <!-- Filter Controls -->
            <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                <!-- Status Filter -->
                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="px-3 py-2 text-xs sm:text-sm bg-slate-50/70 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 text-slate-700"
                >
                    <option value="all">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terverifikasi (Published)</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Menunggu Validasi (Draft)</option>
                </select>

                <!-- Category Filter -->
                <select 
                    name="category" 
                    onchange="this.form.submit()" 
                    class="px-3 py-2 text-xs sm:text-sm bg-slate-50/70 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 text-slate-700"
                >
                    <option value="all">Semua Bidang</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-xl transition-colors cursor-pointer">
                    Cari
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
            <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">
                Portofolio Prestasi Saya
            </h2>
            <span class="text-xs text-slate-500 font-medium">
                Total {{ $achievements->total() }} data
            </span>
        </div>

        @if($achievements->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-10 text-center border border-slate-200/80 shadow-xs">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 font-display mb-1">Belum Ada Prestasi Terdata</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-5 leading-relaxed">
                    Kamu belum menginputkan prestasi atau tidak ada data yang cocok dengan filter. Catat capaian kompetisimu sekarang!
                </p>
                <a href="{{ route('student.achievement.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Input Prestasi Pertama</span>
                </a>
            </div>
        @else
            <!-- Grid of Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($achievements as $item)
                    <div class="bg-white rounded-2xl border border-slate-200/80 hover:border-brand-300 hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col justify-between group">
                        
                        <!-- Top Image Banner -->
                        <div class="relative h-36 overflow-hidden bg-slate-100">
                            @if($item->coverMedia)
                                <img 
                                    src="{{ $item->coverMedia->file_url }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-slate-800 to-brand-900 flex items-center justify-center text-white/30">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>

                            <!-- Badges -->
                            <div class="absolute top-2.5 left-2.5 right-2.5 flex items-center justify-between">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-white/95 text-slate-800 shadow-2xs backdrop-blur-xs">
                                    {{ $item->category->name ?? 'Umum' }}
                                </span>

                                @if($item->status === 'published')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-white shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        <span>Terverifikasi</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-white shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        <span>Menunggu Validasi</span>
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-2.5 left-2.5 text-white">
                                <span class="inline-block px-2 py-0.5 rounded-md text-[11px] font-bold bg-amber-400 text-slate-950">
                                    {{ $item->rank_grade }} • {{ $item->competition_level }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 flex-grow flex flex-col justify-between space-y-3">
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug line-clamp-2 group-hover:text-brand-600 transition-colors">
                                    {{ $item->title }}
                                </h3>

                                <div class="mt-2 space-y-1 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5 truncate">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="truncate">{{ $item->organizer }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    @if($item->mentor_name)
                                        <div class="flex items-center gap-1.5 truncate">
                                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="truncate">Pembina: {{ $item->mentor_name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <a href="{{ route('student.achievement.show', $item->id) }}" class="font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                    <span>Detail & Piagam</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <div class="flex items-center gap-1.5">
                                    @if($item->status === 'draft')
                                        <a href="{{ route('student.achievement.edit', $item->id) }}" class="p-1.5 text-slate-400 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors" title="Edit Data">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('student.achievement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajuan prestasi ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('prestasi.detail', $item->slug) }}" target="_blank" class="px-2 py-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors flex items-center gap-1">
                                            <span>Web Publik</span>
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

            @if($achievements->hasPages())
                <div class="pt-2">
                    {{ $achievements->links() }}
                </div>
            @endif
        @endif
    </div>

    <!-- 5. ALUR VERIFIKASI GUIDELINE (CLEAN LIGHT CARD) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-6 shadow-xs">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-sm font-bold font-display text-slate-900">
                Alur Verifikasi Prestasi Siswa
            </h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-xs">
            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <div class="font-bold text-slate-800 mb-1 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-brand-100 text-brand-700 text-[11px] font-bold flex items-center justify-center">1</span>
                    <span>Input Data & Bukti</span>
                </div>
                <p class="text-slate-500 leading-relaxed">Isi formulir kejuaraan serta unggah berkas sertifikat dan foto dokumentasi kegiatan.</p>
            </div>

            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <div class="font-bold text-slate-800 mb-1 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 text-[11px] font-bold flex items-center justify-center">2</span>
                    <span>Validasi Tim Kesiswaan</span>
                </div>
                <p class="text-slate-500 leading-relaxed">Operator dan Guru Pembina memverifikasi nomor piagam, penyelenggara, dan legalitas lomba.</p>
            </div>

            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <div class="font-bold text-slate-800 mb-1 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[11px] font-bold flex items-center justify-center">3</span>
                    <span>Tayang di Etalase Publik</span>
                </div>
                <p class="text-slate-500 leading-relaxed">Prestasi disetujui, langsung tampil di katalog publik dan tercatat dalam arsip akreditasi resmi.</p>
            </div>
        </div>
    </div>

</div>
@endsection
