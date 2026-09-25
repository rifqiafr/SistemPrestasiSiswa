@extends('layouts.app')

@section('title', 'Etalase Prestasi Siswa SMA - Galeri Kejuaraan & Portofolio Keunggulan')

@section('content')
<div class="relative overflow-hidden">

    <!-- 1. HERO SECTION -->
    <section id="hero" class="relative pt-12 pb-20 lg:pt-20 lg:pb-28 overflow-hidden bg-gradient-to-b from-white via-brand-50/40 to-slate-50">
        <!-- Background Glow Accent -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 hero-glow pointer-events-none -z-10"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-200/40 rounded-full blur-3xl -z-10"></div>
        <div class="absolute top-48 -left-24 w-80 h-80 bg-gold-200/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200/80 text-brand-700 text-xs font-semibold uppercase tracking-wider mb-6 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    <span>Portal Resmi Publikasi Capaian Siswa</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight font-display mb-6">
                    Menyemai Talenta, <br>
                    <span class="bg-gradient-to-r from-brand-600 via-brand-500 to-gold-500 bg-clip-text text-transparent">
                        Mengukir Prestasi Dunia
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-lg sm:text-xl text-slate-600 leading-relaxed mb-10">
                    Katalog portofolio kejuaraan dan rekam jejak medali siswa SMA Negeri Unggulan. Data terpusat, terverifikasi resmi, dan siap mendukung akreditasi sekolah.
                </p>

                <!-- Search Bar Shortcut -->
                <div class="max-w-xl mx-auto mb-16">
                    <div class="relative flex items-center shadow-lg shadow-slate-200/60 rounded-2xl bg-white border border-slate-200 p-1.5 focus-within:ring-2 focus-within:ring-brand-500 focus-within:border-brand-500 transition-all">
                        <div class="pl-3.5 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="hero-search-input" 
                            placeholder="Cari kompetisi, nama siswa, atau guru pembina..." 
                            class="w-full px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent focus:outline-none"
                        >
                        <button 
                            type="button" 
                            onclick="scrollToDirectoryWithSearch()" 
                            class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-sm rounded-xl transition-colors shadow-sm whitespace-nowrap"
                        >
                            Cari Prestasi
                        </button>
                    </div>
                </div>

            </div>

            <!-- 4 Counter Ringkasan (PRD Req: Total, Internasional, Nasional, Provinsi) -->
            <div id="statistik" class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 pt-4">
                
                <!-- Card 1: Total Prestasi -->
                <div class="glass-card rounded-2xl p-6 border border-slate-200/80 shadow-glass hover:shadow-card-hover transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Prestasi</span>
                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalPublished }}">0</span>
                        <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Terbit</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Capaian terverifikasi di database</p>
                </div>

                <!-- Card 2: Tingkat Internasional -->
                <div class="glass-card rounded-2xl p-6 border border-amber-200/60 shadow-glass hover:shadow-card-hover transition-all duration-300 group bg-gradient-to-br from-amber-50/50 via-white to-amber-50/20">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Internasional</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-extrabold text-amber-600 font-display counter-ticker" data-target="{{ $totalInternasional }}">0</span>
                        <span class="text-xs font-semibold text-amber-700 bg-amber-100/80 px-2 py-0.5 rounded-full">Global</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Olimpiade & eksibisi dunia</p>
                </div>

                <!-- Card 3: Tingkat Nasional -->
                <div class="glass-card rounded-2xl p-6 border border-slate-200/80 shadow-glass hover:shadow-card-hover transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Nasional</span>
                        <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalNasional }}">0</span>
                        <span class="text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">Puspresnas</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">OSN, FLS2N, LKIR BRIN</p>
                </div>

                <!-- Card 4: Tingkat Provinsi -->
                <div class="glass-card rounded-2xl p-6 border border-slate-200/80 shadow-glass hover:shadow-card-hover transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Provinsi</span>
                        <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalProvinsi }}">0</span>
                        <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">POPDA/O2SN</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Tingkat wilayah provinsi</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. PRESTASI UNGGULAN (HALL OF FAME) -->
    <section id="hall-of-fame" class="py-16 lg:py-24 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-gold-100/80 text-gold-800 text-xs font-bold uppercase tracking-wider mb-3">
                        <svg class="w-4 h-4 text-gold-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span>Prestasi Unggulan Sekolah</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold font-display text-slate-900 tracking-tight">
                        Hall of Fame Capaian Tertinggi
                    </h2>
                    <p class="text-slate-600 mt-2 max-w-xl text-sm sm:text-base">
                        Deretan medali dan trofi paling bergengsi yang disematkan untuk mengapresiasi dedikasi luar biasa siswa dan pembina.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="#direktori" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 hover:text-brand-700 group">
                        <span>Lihat Semua Katalog</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Grid 3-6 Pinned Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($hallOfFame as $hof)
                <div class="group relative bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-brand-300 transition-all duration-300 overflow-hidden flex flex-col">
                    
                    <!-- Cover Image with Badges -->
                    <div class="relative h-56 w-full overflow-hidden bg-slate-100">
                        <img 
                            src="{{ $hof->coverMedia?->file_url ?? 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=800&q=80' }}" 
                            alt="{{ $hof->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

                        <!-- Top Badges -->
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold text-white shadow-md
                                @if($hof->competition_level === 'Internasional') bg-gradient-to-r from-amber-500 to-amber-600
                                @elseif($hof->competition_level === 'Nasional') bg-gradient-to-r from-rose-500 to-rose-600
                                @else bg-gradient-to-r from-brand-500 to-brand-600 @endif">
                                ★ {{ $hof->competition_level }}
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-md text-slate-800 shadow">
                                {{ $hof->category->name }}
                            </span>
                        </div>

                        <!-- Bottom Level/Rank Title inside Image -->
                        <div class="absolute bottom-3 left-4 right-4">
                            <span class="text-gold-300 font-bold text-sm tracking-wide block uppercase drop-shadow">
                                {{ $hof->rank_grade }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug mb-3">
                                {{ $hof->title }}
                            </h3>

                            <!-- Siswa Peserta -->
                            <div class="space-y-1 mb-4">
                                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Siswa Berprestasi:</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($hof->participants as $part)
                                    <span class="inline-flex items-center text-xs font-semibold text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">
                                        {{ $part->full_name }} ({{ $part->class_grade }})
                                    </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Penyelenggara & Pembina -->
                            <div class="text-xs text-slate-500 space-y-1 mb-4 border-t border-slate-100 pt-3">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    <span class="truncate">Penyelenggara: <strong>{{ $hof->organizer }}</strong></span>
                                </div>
                                @if($hof->mentor_name)
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span class="truncate">Pembimbing: {{ $hof->mentor_name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-2">
                            <button 
                                type="button" 
                                onclick='openDetailModal(@json($hof))'
                                class="w-full py-2.5 px-4 bg-slate-50 hover:bg-brand-600 hover:text-white text-slate-700 font-semibold text-xs rounded-xl border border-slate-200 hover:border-transparent transition-all flex items-center justify-center gap-2 group-hover:bg-brand-600 group-hover:text-white"
                            >
                                <span>Lihat Dokumentasi & Sertifikat</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 3. DIREKTORI & MULTI-FILTER INSTAN -->
    <section id="direktori" class="py-16 lg:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="mb-10 text-center sm:text-left">
            <h2 class="text-3xl sm:text-4xl font-bold font-display text-slate-900 tracking-tight">
                Direktori Prestasi Siswa
            </h2>
            <p class="text-slate-600 mt-2 text-sm sm:text-base">
                Jelajahi seluruh arsip capaian siswa dengan filter kategori lomba, tingkatan kejuaraan, tahun capaian, atau pencarian bebas instan.
            </p>
        </div>

        <!-- Filter Control Box (Glassmorphic) -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-sm mb-8 space-y-5">
            
            <!-- Row 1: Search & Dropdowns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Search Box -->
                <div class="lg:col-span-2 relative">
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1.5">Pencarian Cepat</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="dir-search" 
                            placeholder="Cari nama kompetisi, siswa, NISN, atau pembimbing..." 
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800 placeholder-slate-400"
                        >
                        <div class="absolute left-3.5 top-3 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Dropdown Tingkat -->
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1.5">Tingkat Kejuaraan</label>
                    <select id="filter-level" class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800">
                        <option value="all">Semua Tingkat</option>
                        <option value="Internasional">Internasional</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten/Kota">Kabupaten / Kota</option>
                        <option value="Sekolah">Sekolah</option>
                    </select>
                </div>

                <!-- Dropdown Tahun -->
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-500 mb-1.5">Tahun Capaian</label>
                    <select id="filter-year" class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800">
                        <option value="all">Semua Tahun</option>
                        @foreach($availableYears as $yr)
                        <option value="{{ $yr }}">{{ $yr }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Row 2: Category Chips & Status -->
            <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-slate-100">
                
                <div class="flex flex-wrap items-center gap-2" id="category-pills">
                    <span class="text-xs font-semibold text-slate-400 mr-1 uppercase">Kategori:</span>
                    <button type="button" data-cat="all" class="cat-pill active px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all bg-brand-600 text-white shadow-sm">
                        Semua Bidang
                    </button>
                    @foreach($categories as $cat)
                    <button type="button" data-cat="{{ $cat->id }}" class="cat-pill px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all bg-slate-100 text-slate-700 hover:bg-slate-200">
                        {{ $cat->name }}
                    </button>
                    @endforeach
                </div>

                <!-- Live Results Counter -->
                <div class="text-xs font-medium text-slate-500">
                    Menampilkan <span id="results-count" class="font-bold text-slate-800">{{ $achievements->count() }}</span> capaian prestasi
                </div>

            </div>

        </div>

        <!-- Directory Cards Container -->
        <div id="achievements-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($achievements as $item)
            <div class="achievement-card group bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-lg hover:border-brand-300 transition-all duration-300 flex flex-col overflow-hidden"
                 data-title="{{ strtolower($item->title) }}"
                 data-organizer="{{ strtolower($item->organizer) }}"
                 data-level="{{ $item->competition_level }}"
                 data-category="{{ $item->category_id }}"
                 data-year="{{ date('Y', strtotime($item->event_date)) }}"
                 data-students="{{ strtolower($item->participants->pluck('full_name')->join(' ')) }} {{ strtolower($item->participants->pluck('nisn')->join(' ')) }}"
                 data-mentor="{{ strtolower($item->mentor_name ?? '') }}">
                
                <!-- Thumbnail -->
                <div class="relative h-48 w-full bg-slate-100 overflow-hidden">
                    <img 
                        src="{{ $item->coverMedia?->file_url ?? 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=600&q=80' }}" 
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        loading="lazy"
                    >
                    <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold text-white shadow-sm
                            @if($item->competition_level === 'Internasional') bg-amber-500
                            @elseif($item->competition_level === 'Nasional') bg-rose-500
                            @elseif($item->competition_level === 'Provinsi') bg-indigo-500
                            @else bg-slate-600 @endif">
                            {{ $item->competition_level }}
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-white/90 text-slate-700 shadow-sm">
                            {{ $item->category->name }}
                        </span>
                    </div>
                    <div class="absolute bottom-2 left-3 right-3">
                        <span class="inline-block bg-slate-900/80 backdrop-blur-sm text-gold-300 font-bold text-xs px-2.5 py-1 rounded-md">
                            {{ $item->rank_grade }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="text-xs text-slate-400 mb-1.5 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ date('d M Y', strtotime($item->event_date)) }}</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug mb-3">
                            {{ $item->title }}
                        </h3>

                        <!-- Participants -->
                        <div class="mb-3">
                            <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block mb-1">Peserta:</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach($item->participants as $std)
                                <span class="text-xs font-semibold text-slate-700 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $std->full_name }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Organizer -->
                        <p class="text-xs text-slate-500 line-clamp-1">
                            Oleh: <span class="font-medium text-slate-700">{{ $item->organizer }}</span>
                        </p>
                    </div>

                    <!-- Button Detail -->
                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <button 
                            type="button" 
                            onclick='openDetailModal(@json($item))'
                            class="w-full py-2 px-3 text-xs font-semibold text-brand-600 hover:text-white bg-brand-50 hover:bg-brand-600 rounded-lg transition-colors flex items-center justify-center gap-1.5"
                        >
                            <span>Detail & Bukti Sertifikat</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>

                </div>

            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200 p-8 my-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak ada prestasi yang cocok</h3>
            <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                Coba ubah kata kunci pencarian atau sesuaikan opsi filter tingkat dan kategori perlombaan.
            </p>
            <button 
                type="button" 
                onclick="resetFilters()" 
                class="mt-4 px-4 py-2 bg-brand-50 text-brand-700 hover:bg-brand-100 text-xs font-semibold rounded-lg transition-colors"
            >
                Reset Semua Filter
            </button>
        </div>

    </section>

</div>

<!-- 4. MODAL DETAIL PRESTASI (PRD: Light-dismiss, Bukti Sertifikat, Info Pembina, Social Share) -->
<dialog id="prestasi-modal" class="p-0 rounded-3xl max-w-2xl w-full backdrop:bg-slate-900/60 backdrop:backdrop-blur-sm shadow-2xl border border-slate-200/80 overflow-hidden focus:outline-none">
    <div class="bg-white flex flex-col max-h-[90vh]">
        
        <!-- Modal Header with Cover Image & Close -->
        <div class="relative h-64 sm:h-72 w-full bg-slate-950 overflow-hidden">
            <img id="modal-cover-img" src="" alt="Dokumentasi Lomba" class="w-full h-full object-cover opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeDetailModal()" 
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/50 text-white hover:bg-black/80 flex items-center justify-center backdrop-blur-md transition-colors"
                title="Tutup (ESC)"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Badges on Image -->
            <div class="absolute bottom-4 left-6 right-6">
                <div class="flex items-center gap-2 mb-2">
                    <span id="modal-badge-level" class="px-2.5 py-0.5 rounded-full text-xs font-bold text-white bg-brand-600"></span>
                    <span id="modal-badge-cat" class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/90 text-slate-800"></span>
                </div>
                <h2 id="modal-title" class="text-xl sm:text-2xl font-bold text-white font-display leading-tight drop-shadow"></h2>
                <p id="modal-rank" class="text-gold-300 font-bold text-sm mt-1"></p>
            </div>
        </div>

        <!-- Modal Scrollable Content -->
        <div class="p-6 sm:p-8 overflow-y-auto space-y-6 flex-grow">
            
            <!-- Quick Metadata Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 text-xs">
                <div>
                    <span class="text-slate-400 font-medium block">Tanggal Capaian:</span>
                    <strong id="modal-date" class="text-slate-800 text-sm"></strong>
                </div>
                <div>
                    <span class="text-slate-400 font-medium block">Penyelenggara:</span>
                    <strong id="modal-organizer" class="text-slate-800 text-sm"></strong>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <span class="text-slate-400 font-medium block">Guru Pembimbing:</span>
                    <strong id="modal-mentor" class="text-slate-800 text-sm"></strong>
                </div>
            </div>

            <!-- Peserta Siswa -->
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Siswa Peserta & Peraih Prestasi:</h4>
                <div id="modal-participants-list" class="grid grid-cols-1 sm:grid-cols-2 gap-2"></div>
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Capaian & Rekam Jejak:</h4>
                <p id="modal-description" class="text-sm text-slate-600 leading-relaxed"></p>
            </div>

            <!-- Berkas Bukti & Sertifikat -->
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Dokumentasi & Sertifikat Resmi:</h4>
                <div id="modal-media-list" class="flex flex-wrap gap-3"></div>
            </div>

            <!-- Social Share Buttons -->
            <div class="pt-4 border-t border-slate-100">
                <span class="text-xs font-semibold text-slate-500 block mb-2">Bagikan Prestasi Ini:</span>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="shareWhatsApp()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition-colors">
                        <span>WhatsApp</span>
                    </button>
                    <button type="button" onclick="shareTwitter()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-900 hover:bg-black text-white transition-colors">
                        <span>X (Twitter)</span>
                    </button>
                    <button type="button" onclick="shareFacebook()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                        <span>Facebook</span>
                    </button>
                    <button type="button" onclick="copyShareLink()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
                        <span id="copy-btn-text">Salin Tautan</span>
                    </button>
                </div>
            </div>

        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end">
            <button type="button" onclick="closeDetailModal()" class="px-5 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 rounded-xl transition-colors">
                Tutup Jendela
            </button>
        </div>

    </div>
</dialog>

@endsection

@push('scripts')
<script>
    // 1. Animated Counter Ticker for Stats
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter-ticker');
        const speed = 200;

        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const inc = Math.max(1, Math.ceil(target / 40));

            const updateCount = () => {
                count += inc;
                if (count < target) {
                    counter.innerText = count;
                    setTimeout(updateCount, 25);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });

        // Initialize Filter Listeners
        initLiveFilters();
    });

    // 2. Client-Side Live Multi-Filtering & Instant Search
    let selectedCategory = 'all';
    let currentModalSlug = '';

    function initLiveFilters() {
        const searchInput = document.getElementById('dir-search');
        const levelSelect = document.getElementById('filter-level');
        const yearSelect  = document.getElementById('filter-year');
        const catButtons  = document.querySelectorAll('.cat-pill');

        catButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                catButtons.forEach(b => {
                    b.classList.remove('bg-brand-600', 'text-white', 'shadow-sm');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });
                btn.classList.remove('bg-slate-100', 'text-slate-700');
                btn.classList.add('bg-brand-600', 'text-white', 'shadow-sm');
                selectedCategory = btn.getAttribute('data-cat');
                applyFilters();
            });
        });

        searchInput.addEventListener('input', debounce(applyFilters, 150));
        levelSelect.addEventListener('change', applyFilters);
        yearSelect.addEventListener('change', applyFilters);
    }

    function applyFilters() {
        const query = document.getElementById('dir-search').value.toLowerCase().trim();
        const level = document.getElementById('filter-level').value;
        const year  = document.getElementById('filter-year').value;
        const cards = document.querySelectorAll('.achievement-card');
        const emptyState = document.getElementById('empty-state');
        const countSpan = document.getElementById('results-count');

        let visibleCount = 0;

        cards.forEach(card => {
            const cardTitle     = card.getAttribute('data-title');
            const cardOrganizer = card.getAttribute('data-organizer');
            const cardLevel     = card.getAttribute('data-level');
            const cardCategory  = card.getAttribute('data-category');
            const cardYear      = card.getAttribute('data-year');
            const cardStudents  = card.getAttribute('data-students');
            const cardMentor    = card.getAttribute('data-mentor');

            // Category match
            const matchCat = (selectedCategory === 'all' || selectedCategory === cardCategory);
            // Level match
            const matchLevel = (level === 'all' || level === cardLevel);
            // Year match
            const matchYear = (year === 'all' || year === cardYear);
            // Search query match
            const matchQuery = !query || 
                cardTitle.includes(query) || 
                cardOrganizer.includes(query) || 
                cardStudents.includes(query) || 
                cardMentor.includes(query);

            if (matchCat && matchLevel && matchYear && matchQuery) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        countSpan.innerText = visibleCount;
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    function resetFilters() {
        document.getElementById('dir-search').value = '';
        document.getElementById('filter-level').value = 'all';
        document.getElementById('filter-year').value = 'all';
        const allCatBtn = document.querySelector('.cat-pill[data-cat="all"]');
        if (allCatBtn) allCatBtn.click();
        applyFilters();
    }

    function scrollToDirectoryWithSearch() {
        const heroInput = document.getElementById('hero-search-input');
        const dirInput  = document.getElementById('dir-search');
        dirInput.value = heroInput.value;
        applyFilters();
        document.getElementById('direktori').scrollIntoView({ behavior: 'smooth' });
    }

    // Debounce helper
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // 3. Native <dialog> Modal with Light-Dismiss & ESC Handler
    const modal = document.getElementById('prestasi-modal');

    // Light-dismiss: click outside dialog closes it
    modal.addEventListener('click', (event) => {
        const rect = modal.getBoundingClientRect();
        const isInDialog = (
            rect.top <= event.clientY &&
            event.clientY <= rect.top + rect.height &&
            rect.left <= event.clientX &&
            event.clientX <= rect.left + rect.width
        );
        if (!isInDialog) {
            modal.close();
        }
    });

    function openDetailModal(item) {
        currentModalSlug = item.slug;
        document.getElementById('modal-title').innerText = item.title;
        document.getElementById('modal-rank').innerText = '★ ' + item.rank_grade;
        document.getElementById('modal-badge-level').innerText = item.competition_level;
        document.getElementById('modal-badge-cat').innerText = item.category?.name || 'Prestasi';
        document.getElementById('modal-date').innerText = new Date(item.event_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        document.getElementById('modal-organizer').innerText = item.organizer;
        document.getElementById('modal-mentor').innerText = item.mentor_name || 'Tim Pembina Sekolah';
        document.getElementById('modal-description').innerText = item.description || 'Tidak ada catatan deskripsi tambahan.';

        // Cover Photo
        const coverMedia = item.cover_media?.file_url || (item.media && item.media[0]?.file_url) || 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1200&q=80';
        document.getElementById('modal-cover-img').src = coverMedia;

        // Participants list
        const partList = document.getElementById('modal-participants-list');
        partList.innerHTML = '';
        if (item.participants && item.participants.length > 0) {
            item.participants.forEach(p => {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 p-2 bg-slate-50 border border-slate-200/60 rounded-xl';
                div.innerHTML = `
                    <div class="w-7 h-7 rounded-full bg-brand-500/10 text-brand-600 font-bold flex items-center justify-center text-xs">
                        ${p.full_name.charAt(0)}
                    </div>
                    <div>
                        <strong class="text-xs text-slate-800 block">${p.full_name}</strong>
                        <span class="text-[11px] text-slate-400">NISN: ${p.nisn} | Kelas: ${p.class_grade}</span>
                    </div>
                `;
                partList.appendChild(div);
            });
        }

        // Media List (Thumbnails)
        const mediaList = document.getElementById('modal-media-list');
        mediaList.innerHTML = '';
        if (item.media && item.media.length > 0) {
            item.media.forEach(m => {
                const a = document.createElement('a');
                a.href = m.file_url;
                a.target = '_blank';
                a.className = 'relative group block w-24 h-24 rounded-xl overflow-hidden border border-slate-200 shadow-sm';
                a.innerHTML = `
                    <img src="${m.file_url}" alt="Berkas" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                    <span class="absolute bottom-1 left-1 right-1 text-center bg-black/60 backdrop-blur-sm text-[10px] text-white py-0.5 rounded uppercase font-semibold">
                        ${m.file_type}
                    </span>
                `;
                mediaList.appendChild(a);
            });
        }

        modal.showModal();
    }

    function closeDetailModal() {
        modal.close();
    }

    // 4. Social Sharing Handlers
    function getShareUrl() {
        return window.location.origin + '/prestasi/' + currentModalSlug;
    }

    function shareWhatsApp() {
        const text = encodeURIComponent(`Lihat capaian prestasi membanggakan siswa SMA: ${document.getElementById('modal-title').innerText} - ` + getShareUrl());
        window.open(`https://api.whatsapp.com/send?text=${text}`, '_blank');
    }

    function shareTwitter() {
        const text = encodeURIComponent(`Prestasi Siswa SMA: ${document.getElementById('modal-title').innerText}`);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(getShareUrl())}`, '_blank');
    }

    function shareFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(getShareUrl())}`, '_blank');
    }

    function copyShareLink() {
        navigator.clipboard.writeText(getShareUrl()).then(() => {
            const btn = document.getElementById('copy-btn-text');
            const original = btn.innerText;
            btn.innerText = 'Tersalin!';
            setTimeout(() => { btn.innerText = original; }, 2000);
        });
    }
</script>
@endpush
