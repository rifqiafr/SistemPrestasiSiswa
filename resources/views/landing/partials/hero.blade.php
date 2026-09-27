<!-- 1. HERO SECTION (SINGLE BANNER) -->
<section id="hero" class="relative bg-slate-950 text-white overflow-hidden">
    <!-- Subtle Glow Accent -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 hero-glow pointer-events-none opacity-40"></div>

    <!-- Background Image with Gradient Overlays -->
    <div class="absolute inset-0">
        <img 
            src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1920&q=80" 
            alt="Siswa Berprestasi SMA Negeri Unggulan" 
            class="w-full h-full object-cover object-center opacity-30 scale-105"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/60"></div>
    </div>

    <!-- Hero Content Container -->
    <div class="relative min-h-[580px] sm:min-h-[640px] lg:min-h-[700px] flex items-center">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
            <div class="max-w-2xl lg:max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-500/20 border border-brand-400/30 text-brand-300 text-xs font-semibold uppercase tracking-wider mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Pusat Prestasi & Capaian Siswa</span>
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold font-display tracking-tight leading-tight text-white mb-6">
                    <span class="bg-gradient-to-r from-brand-300 via-sky-200 to-amber-300 bg-clip-text text-transparent">
                        {{ $settings['school_name'] ?? 'SMA NEGERI UNGGULAN' }}
                    </span>
                </h1>
                <p class="text-base sm:text-lg lg:text-xl text-slate-300 leading-relaxed mb-8 max-w-2xl font-normal">
                    {{ $settings['school_subtagline'] ?? $settings['hero_subtagline'] ?? ('Selamat datang di portal resmi ' . ($settings['school_name'] ?? 'SMA Negeri Unggulan') . '. Wadah kurasi terpusat rekam jejak prestasi siswa, profil komitmen mutu pendidikan, dan transparansi akreditasi sekolah.') }}
                </p>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="#sambutan" class="inline-flex items-center gap-3 px-8 py-3.5 rounded-full bg-gradient-to-r from-brand-600 via-brand-500 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-semibold text-sm tracking-wide shadow-xl shadow-brand-600/30 hover:shadow-2xl hover:shadow-brand-500/40 border border-white/20 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-brand-400 focus:ring-offset-2 focus:ring-offset-slate-950 group">
                        <span>Get Started</span>
                        <span class="w-6 h-6 rounded-full bg-white/20 group-hover:bg-white/30 flex items-center justify-center transition-all duration-300">
                            <svg class="w-3.5 h-3.5 text-white group-hover:translate-y-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>
