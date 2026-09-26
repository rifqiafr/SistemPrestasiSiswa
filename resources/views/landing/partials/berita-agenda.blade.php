<!-- 7. BERITA KEGIATAN, PENGUMUMAN RESMI & KALENDER AKADEMIK -->
<section id="berita-agenda" class="py-16 sm:py-24 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
                Warta & Publikasi Sekolah
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
                Berita, Pengumuman & Agenda Akademik
            </h2>
            <p class="text-slate-600 mt-2 text-sm sm:text-base">
                Informasi resmi terkini seputar aktivitas warga sekolah, instruksi pembinaan, serta agenda kalender kegiatan belajar.
            </p>
        </div>

        <!-- Tab Switcher (Berita vs Pengumuman) -->
        <div class="flex items-center justify-center mb-10">
            <div class="inline-flex p-1.5 rounded-2xl bg-slate-200/80 border border-slate-300/80 shadow-inner">
                <button 
                    type="button" 
                    id="tab-btn-berita" 
                    onclick="switchNewsTab('berita')"
                    class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-900 shadow-sm"
                >
                    Berita Kegiatan Sekolah
                </button>
                <button 
                    type="button" 
                    id="tab-btn-pengumuman" 
                    onclick="switchNewsTab('pengumuman')"
                    class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all text-slate-600 hover:text-slate-900"
                >
                    Pengumuman Resmi
                </button>
            </div>
        </div>

        <!-- Panel 1: Cuplikan Berita Kegiatan -->
        <div id="panel-berita" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($newsItems as $news)
            <article class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
                <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                    <img 
                        src="{{ $news['image'] }}" 
                        alt="{{ $news['title'] }}" 
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-brand-600 text-white shadow">
                            {{ $news['category'] }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                            <span>{{ $news['date'] }}</span>
                            <span>•</span>
                            <span>{{ $news['author'] }}</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug line-clamp-2 hover:text-brand-600 transition-colors">
                            {{ $news['title'] }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed line-clamp-3">
                            {{ $news['excerpt'] }}
                        </p>
                    </div>
                    <button 
                        type="button" 
                        onclick='openNewsModal(@json($news))' 
                        class="text-xs font-bold text-brand-600 hover:text-brand-800 inline-flex items-center gap-1.5 self-start pt-2"
                    >
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Panel 2: Cuplikan Pengumuman Resmi (Hidden by default) -->
        <div id="panel-pengumuman" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            @foreach($announcements as $ann)
            <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold 
                            @if($ann['badge'] === 'Penting') bg-rose-100 text-rose-700
                            @elseif($ann['badge'] === 'Pembinaan') bg-amber-100 text-amber-700
                            @else bg-brand-100 text-brand-700 @endif">
                            {{ $ann['badge'] }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $ann['date'] }}</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 leading-snug">
                        {{ $ann['title'] }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $ann['description'] }}
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 text-xs text-slate-400">
                    Kategori: <strong class="text-slate-700">{{ $ann['category'] }}</strong>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Kalender & Agenda Kegiatan Terdekat -->
        <div id="kalender-akademik" class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-6 border-b border-slate-100 gap-4">
                <div>
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-wider block mb-1">Jadwal Mendatang</span>
                    <h3 class="text-2xl font-bold font-display text-slate-900">Agenda Akademik & Kegiatan Siswa</h3>
                </div>
                <a href="#kontak-ppdb" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                    <span>Konfirmasi Jadwal Humas</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($academicAgendas as $agenda)
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-brand-600 text-white flex flex-col items-center justify-center shrink-0 shadow-sm">
                        <span class="text-base font-extrabold leading-none">{{ $agenda['day'] }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider mt-0.5">{{ $agenda['month'] }}</span>
                    </div>
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                {{ $agenda['status'] }}
                            </span>
                            <span class="text-xs text-slate-400">{{ $agenda['time'] }}</span>
                        </div>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">
                            {{ $agenda['title'] }}
                        </h4>
                        <p class="text-xs text-slate-500">
                            Lokasi: {{ $agenda['location'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
