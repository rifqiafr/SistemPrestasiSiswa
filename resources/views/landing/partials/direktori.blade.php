<!-- 6. KATALOG & DIREKTORI PRESTASI (PENCARIAN, FILTER KATEGORI & TINGKAT) -->
<section id="direktori" class="py-16 sm:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="mb-10 text-center sm:text-left">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
            Pusat Kurasi Capaian
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
            Direktori Prestasi Siswa Terpadu
        </h2>
        <p class="text-slate-600 mt-2 text-sm sm:text-base">
            Saring arsip prestasi berdasarkan bidang kejuaraan (Akademik maupun Non-Akademik), tingkat kompetisi, tahun perolehan, atau kata kunci pencarian.
        </p>
    </div>

    <!-- Filter Control Box -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm mb-8 space-y-6">
        
        <!-- Row 1: Search & Dropdowns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Search Box -->
            <div class="lg:col-span-2">
                <label for="dir-search" class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Pencarian Bebas</label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="dir-search" 
                        placeholder="Cari event lomba, nama siswa, NISN, atau pembimbing..." 
                        class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800 placeholder-slate-400"
                    >
                    <div class="absolute left-3.5 top-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Dropdown Tingkat -->
            <div>
                <label for="filter-level" class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Tingkat Kejuaraan</label>
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
                <label for="filter-year" class="block text-xs font-bold uppercase text-slate-500 mb-1.5">Tahun Capaian</label>
                <select id="filter-year" class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all text-slate-800">
                    <option value="all">Semua Tahun</option>
                    @foreach($availableYears as $yr)
                    <option value="{{ $yr }}">{{ $yr }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Row 2: Category Chips & Live Results Counter -->
        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-slate-100">
            <div class="flex flex-wrap items-center gap-2" id="category-pills">
                <span class="text-xs font-bold text-slate-400 mr-1 uppercase">Kategori:</span>
                <button type="button" data-cat="all" class="cat-pill active px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-brand-600 text-white shadow-sm">
                    Semua Bidang
                </button>
                @foreach($categories as $cat)
                <button type="button" data-cat="{{ $cat->id }}" class="cat-pill px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all bg-slate-100 text-slate-700 hover:bg-slate-200">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>

            <!-- Live Results Counter -->
            <div class="text-xs font-semibold text-slate-500">
                Menampilkan <span id="results-count" class="font-bold text-slate-900">{{ $achievements->count() }}</span> data prestasi
            </div>
        </div>

    </div>

    <!-- Directory Cards Grid -->
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
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-white/90 text-slate-800 shadow-sm">
                        {{ $item->category->name }}
                    </span>
                </div>
                <div class="absolute bottom-2 left-3 right-3">
                    <span class="inline-block bg-slate-900/85 backdrop-blur-sm text-amber-300 font-bold text-xs px-2.5 py-1 rounded-md">
                        {{ $item->rank_grade }}
                    </span>
                </div>
            </div>

            <!-- Card Content -->
            <div class="p-5 flex-grow flex flex-col justify-between">
                <div>
                    <div class="text-xs text-slate-400 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ date('d M Y', strtotime($item->event_date)) }}</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug mb-3">
                        {{ $item->title }}
                    </h3>

                    <!-- Siswa Peserta -->
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

                    <p class="text-xs text-slate-500 line-clamp-1">
                        Penyelenggara: <span class="font-medium text-slate-700">{{ $item->organizer }}</span>
                    </p>
                </div>

                <!-- Button Detail Modal -->
                <div class="mt-4 pt-3 border-t border-slate-100">
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

    <!-- Empty State -->
    <div id="empty-state" class="hidden text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 my-8">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Tidak ada data prestasi yang cocok</h3>
        <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">
            Silakan sesuaikan kata kunci pencarian atau ganti pilihan filter tingkat dan kategori perlombaan.
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
