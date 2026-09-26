<!-- 8. GALERI LINGKUNGAN & FASILITAS SEKOLAH -->
<section id="fasilitas" class="py-16 sm:py-24 bg-white border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
                Fasilitas Berstandar Unggul
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
                Galeri Lingkungan & Sarana Pembelajaran
            </h2>
            <p class="text-slate-600 mt-2 text-sm sm:text-base">
                Dukungan sarana prasarana modern untuk kenyamanan eksplorasi sains, teknologi, kebugaran raga, dan kreasi seni budaya siswa.
            </p>
        </div>

        <!-- Tab Filter Kategori Fasilitas -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            <button type="button" onclick="filterFacilities('all', this)" class="facility-tab active px-4 py-2 rounded-xl text-xs font-semibold bg-brand-600 text-white shadow-sm transition-all">
                Semua Sarana
            </button>
            <button type="button" onclick="filterFacilities('laboratorium', this)" class="facility-tab px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all">
                Laboratorium Sains
            </button>
            <button type="button" onclick="filterFacilities('komputer', this)" class="facility-tab px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all">
                Teknologi & IT Lab
            </button>
            <button type="button" onclick="filterFacilities('perpustakaan', this)" class="facility-tab px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all">
                Perpustakaan & Literasi
            </button>
            <button type="button" onclick="filterFacilities('olahraga', this)" class="facility-tab px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all">
                Olahraga & Seni
            </button>
        </div>

        <!-- Grid Foto Fasilitas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="facilities-grid">
            @foreach($facilities as $fac)
            <div class="facility-item group relative rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 bg-slate-900 cursor-pointer"
                 data-category="{{ $fac['category'] }}"
                 onclick='openFacilityModal(@json($fac))'>
                <div class="h-64 w-full overflow-hidden">
                    <img 
                        src="{{ $fac['image'] }}" 
                        alt="{{ $fac['name'] }}" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                        loading="lazy"
                    >
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent flex flex-col justify-end p-6 text-white">
                    <span class="text-[11px] font-bold text-amber-300 uppercase tracking-wider mb-1">
                        {{ $fac['category_label'] }}
                    </span>
                    <h3 class="text-base sm:text-lg font-bold font-display leading-snug text-white group-hover:text-brand-300 transition-colors">
                        {{ $fac['name'] }}
                    </h3>
                    <p class="text-xs text-slate-300 mt-2 line-clamp-2 leading-relaxed">
                        {{ $fac['description'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
