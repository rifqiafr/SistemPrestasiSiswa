<!-- 6. KATALOG & DIREKTORI PRESTASI (PENCARIAN, FILTER KATEGORI & TINGKAT) -->
<section id="direktori" class="py-16 sm:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="mb-8">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
            Pusat Kurasi Capaian
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
            Direktori Prestasi Siswa Terpadu
        </h2>
        <p class="text-slate-600 mt-2 text-sm sm:text-base max-w-2xl">
            Saring arsip prestasi berdasarkan bidang kejuaraan, tingkat kompetisi, dan tahun perolehan.
        </p>
    </div>

    <!-- Filter Control Box -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-sm mb-8 space-y-4">
        
        <!-- Filter Controls: Kategori Chips & Dropdown Filters -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Category Chips -->
            <div class="flex flex-wrap items-center gap-2" id="category-pills">
                <span class="text-xs font-bold text-slate-400 mr-1 uppercase tracking-wider">Bidang:</span>
                <button type="button" data-cat="all" class="cat-pill active px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-brand-600 text-white shadow-sm">
                    Semua Bidang
                </button>
                @foreach($categories as $cat)
                <button type="button" data-cat="{{ $cat->id }}" class="cat-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-slate-100 text-slate-700 hover:bg-slate-200">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>

            <!-- Dropdown Filters: Tingkat & Tahun (Side-by-Side) -->
            <div class="flex items-center gap-2.5 sm:gap-3 shrink-0">
                <!-- Dropdown Tingkat -->
                <div class="relative w-36 sm:w-44">
                    <select id="filter-level" class="w-full appearance-none pl-3 pr-8 py-2 text-xs font-semibold bg-slate-50 hover:bg-slate-100/70 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-700 cursor-pointer">
                        <option value="all">Semua Tingkat</option>
                        <option value="Internasional">Internasional</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten/Kota">Kabupaten / Kota</option>
                        <option value="Sekolah">Sekolah</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <!-- Dropdown Tahun -->
                <div class="relative w-32 sm:w-36">
                    <select id="filter-year" class="w-full appearance-none pl-3 pr-8 py-2 text-xs font-semibold bg-slate-50 hover:bg-slate-100/70 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-700 cursor-pointer">
                        <option value="all">Semua Tahun</option>
                        @foreach($availableYears as $yr)
                        <option value="{{ $yr }}">{{ $yr }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Row 2: Live Results Counter & Reset Filter -->
        <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs font-semibold text-slate-500">
            <div>
                Menampilkan <span id="results-count" class="font-bold text-slate-900">{{ $achievements->count() }}</span> data prestasi
            </div>
            <button type="button" onclick="resetFilters()" class="text-xs text-brand-600 hover:text-brand-700 font-medium hover:underline inline-flex items-center gap-1.5 cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                <span>Reset Filter</span>
            </button>
        </div>

    </div>

    @php
        $slideChunks = $achievements->chunk(8);
    @endphp

    <!-- Carousel Container (2 Baris x 4 Kolom) -->
    <div class="relative group/dir-carousel">
        
        <!-- Viewport -->
        <div id="dir-carousel-viewport" class="overflow-hidden transition-[height] duration-300 ease-out">
            <div id="dir-carousel-track" class="flex items-start transition-transform duration-500 ease-out will-change-transform">
                @foreach($slideChunks as $slideIndex => $chunk)
                <div class="dir-slide w-full flex-shrink-0 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6 p-1 content-start" data-slide="{{ $slideIndex }}">
                    @foreach($chunk as $item)
                    <div class="achievement-card group bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-lg hover:border-brand-300 transition-all duration-300 flex flex-col overflow-hidden"
                         data-title="{{ strtolower($item->title) }}"
                         data-organizer="{{ strtolower($item->organizer) }}"
                         data-level="{{ $item->competition_level }}"
                         data-category="{{ $item->category_id }}"
                         data-year="{{ date('Y', strtotime($item->event_date)) }}"
                         data-students="{{ strtolower($item->participants->pluck('full_name')->join(' ')) }} {{ strtolower($item->participants->pluck('nisn')->join(' ')) }}"
                         data-mentor="{{ strtolower($item->mentor_name ?? '') }}">
                        
                        <!-- Thumbnail -->
                        <div class="relative h-44 w-full bg-slate-100 overflow-hidden">
                            <img 
                                src="{{ $item->coverMedia?->file_url ?? 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=600&q=80' }}" 
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                            >
                            <div class="absolute top-2.5 left-2.5 right-2.5 flex items-center justify-between gap-1">
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold text-white shadow-sm shrink-0
                                    @if($item->competition_level === 'Internasional') bg-amber-500
                                    @elseif($item->competition_level === 'Nasional') bg-rose-500
                                    @elseif($item->competition_level === 'Provinsi') bg-indigo-500
                                    @else bg-slate-600 @endif">
                                    {{ $item->competition_level }}
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-medium bg-white/90 text-slate-800 shadow-sm truncate max-w-[120px]">
                                    {{ $item->category->name }}
                                </span>
                            </div>
                            <div class="absolute bottom-2 left-2.5 right-2.5">
                                <span class="inline-block bg-slate-900/85 backdrop-blur-sm text-amber-300 font-bold text-[11px] px-2 py-0.5 rounded-md truncate max-w-full">
                                    {{ $item->rank_grade }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="text-[11px] text-slate-400 mb-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>{{ date('d M Y', strtotime($item->event_date)) }}</span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug mb-2 min-h-[2.5rem]">
                                    {{ $item->title }}
                                </h3>

                                <!-- Siswa Peserta -->
                                <div class="mb-2">
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-0.5">Peserta:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($item->participants->take(2) as $std)
                                        <span class="text-[11px] font-medium text-slate-700 bg-slate-100 px-1.5 py-0.5 rounded truncate max-w-[130px]">
                                            {{ $std->full_name }}
                                        </span>
                                        @endforeach
                                        @if($item->participants->count() > 2)
                                        <span class="text-[10px] font-semibold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded">
                                            +{{ $item->participants->count() - 2 }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-[11px] text-slate-500 line-clamp-1 mb-2">
                                    Penyelenggara: <span class="font-medium text-slate-700">{{ $item->organizer }}</span>
                                </p>
                            </div>

                            <!-- Button Detail Modal -->
                            <div class="mt-2 pt-2.5 border-t border-slate-100">
                                <button 
                                    type="button" 
                                    onclick='openDetailModal(@json($item))'
                                    class="w-full py-2 px-3 text-xs font-semibold text-brand-600 hover:text-white bg-brand-50 hover:bg-brand-600 rounded-xl transition-colors flex items-center justify-center gap-1.5"
                                >
                                    <span>Detail & Bukti Sertifikat</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>



    </div>

    <!-- Carousel Pagination Footer -->
    <div id="dir-pagination-container" class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100">
        <div class="text-xs text-slate-500 font-medium">
            Halaman <span id="dir-current-page" class="font-bold text-slate-800">1</span> dari <span id="dir-total-pages" class="font-bold text-slate-800">{{ max(1, $slideChunks->count()) }}</span> 
            <span class="text-slate-400">· (Format 2 baris × 4 kolom, maks. 8 prestasi per tampilan)</span>
        </div>
        
        <!-- Controls: Prev, Dots, Next -->
        <div class="flex items-center gap-3">
            <button 
                type="button" 
                onclick="dirPrevSlide()" 
                id="dir-footer-prev"
                class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed flex items-center gap-1.5"
            >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <span>Sebelumnya</span>
            </button>

            <!-- Dots -->
            <div id="dir-carousel-dots" class="flex items-center gap-1.5 px-2">
                @for($i = 0; $i < max(1, $slideChunks->count()); $i++)
                <button 
                    type="button" 
                    onclick="dirGoToSlide({{ $i }})" 
                    class="dir-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-6 bg-brand-600' : 'w-2 bg-slate-300 hover:bg-slate-400' }}"
                    aria-label="Ke slide {{ $i + 1 }}"
                ></button>
                @endfor
            </div>

            <button 
                type="button" 
                onclick="dirNextSlide()" 
                id="dir-footer-next"
                class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed flex items-center gap-1.5"
            >
                <span>Berikutnya</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="hidden text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 my-8">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Tidak ada data prestasi yang cocok</h3>
        <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">
            Silakan sesuaikan pilihan filter bidang, tingkat kejuaraan, atau tahun capaian perlombaan.
        </p>
        <button 
            type="button" 
            onclick="resetFilters()" 
            class="mt-4 px-5 py-2.5 bg-brand-50 text-brand-700 hover:bg-brand-100 text-xs font-semibold rounded-xl transition-colors"
        >
            Reset Semua Filter
        </button>
    </div>

</section>
