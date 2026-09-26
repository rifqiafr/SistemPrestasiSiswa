<!-- 5. HALL OF FAME: JUARA UMUM & PRESTASI TERTINGGI -->
<section id="hall-of-fame" class="py-16 sm:py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3 border border-amber-400/30">
                    <span>Hall of Fame Siswa</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold font-display text-white tracking-tight">
                    Capaian Kejuaraan Bergengsi Terbaru
                </h2>
                <p class="text-slate-400 mt-2 max-w-xl text-sm sm:text-base">
                    Deretan medali dan penghargaan tertinggi yang dipersembahkan oleh para siswa berprestasi didampingi guru pembina.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="#direktori" class="inline-flex items-center gap-1.5 text-sm font-semibold text-amber-400 hover:text-amber-300 transition-colors">
                    <span>Lihat Semua Katalog Prestasi</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Grid Hall of Fame Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($hallOfFame as $hof)
            <div class="group relative bg-slate-800/90 rounded-3xl border border-slate-700 shadow-xl hover:border-amber-400/60 transition-all duration-300 overflow-hidden flex flex-col">
                
                <!-- Cover Image -->
                <div class="relative h-56 w-full overflow-hidden bg-slate-950">
                    <img 
                        src="{{ $hof->coverMedia?->file_url ?? 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=800&q=80' }}" 
                        alt="{{ $hof->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

                    <!-- Top Badges -->
                    <div class="absolute top-4 left-4 right-4 flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white shadow-md
                            @if($hof->competition_level === 'Internasional') bg-amber-500
                            @elseif($hof->competition_level === 'Nasional') bg-rose-500
                            @else bg-indigo-500 @endif">
                            ★ {{ $hof->competition_level }}
                        </span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 text-slate-900 shadow">
                            {{ $hof->category->name }}
                        </span>
                    </div>

                    <!-- Bottom Level/Rank Title -->
                    <div class="absolute bottom-3 left-4 right-4">
                        <span class="text-amber-300 font-bold text-sm tracking-wide block uppercase drop-shadow">
                            {{ $hof->rank_grade }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-amber-300 transition-colors line-clamp-2 leading-snug mb-3">
                            {{ $hof->title }}
                        </h3>

                        <!-- Siswa Peserta -->
                        <div class="space-y-1 mb-4">
                            <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Siswa Peraih Medali:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($hof->participants as $part)
                                <span class="inline-flex items-center text-xs font-semibold text-slate-200 bg-slate-700/80 px-2.5 py-1 rounded-lg">
                                    {{ $part->full_name }} ({{ $part->class_grade }})
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Penyelenggara & Pembina -->
                        <div class="text-xs text-slate-400 space-y-1 pt-3 border-t border-slate-700/60">
                            <p class="truncate">Penyelenggara: <strong class="text-slate-200">{{ $hof->organizer }}</strong></p>
                            @if($hof->mentor_name)
                            <p class="truncate">Pembimbing: <span class="text-slate-300">{{ $hof->mentor_name }}</span></p>
                            @endif
                        </div>
                    </div>

                    <!-- Card Action -->
                    <div class="pt-2">
                        <button 
                            type="button" 
                            onclick='openDetailModal(@json($hof))'
                            class="w-full py-2.5 px-4 bg-slate-700 hover:bg-amber-500 hover:text-slate-950 text-white font-semibold text-xs rounded-xl transition-all flex items-center justify-center gap-2 group-hover:bg-amber-500 group-hover:text-slate-950"
                        >
                            <span>Lihat Dokumentasi & Sertifikat</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
