<!-- 4. SOROTAN PRESTASI SISWA & COUNTER STATISTIK DINAMIS -->
<section id="statistik" class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gold-100 text-gold-900 text-xs font-bold uppercase tracking-wider mb-3">
                Rekapitulasi Capaian Medali & Trofi
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
                Statistik Perolehan Prestasi Terverifikasi
            </h2>
            <p class="text-slate-600 mt-2 text-sm sm:text-base">
                Rekam jejak resmi capaian prestasi siswa yang telah terkurasi dan siap menjadi rujukan pelaporan akreditasi sekolah.
            </p>
        </div>

        <!-- 5 Dynamic Counters (Total, Internasional, Nasional, Provinsi, Kota) -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6 mb-16">
            
            <!-- Card 1: Total Capaian -->
            <div class="col-span-2 sm:col-span-1 rounded-2xl p-6 bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Prestasi</span>
                    <div class="w-8 h-8 rounded-lg bg-brand-500/10 text-brand-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalPublished }}">0</span>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Arsip</span>
                </div>
                <p class="text-xs text-slate-500 mt-2">Seluruh medali terbit</p>
            </div>

            <!-- Card 2: Internasional -->
            <div class="rounded-2xl p-6 bg-amber-50/60 border border-amber-200/80 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Internasional</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-700 flex items-center justify-center font-bold">
                        ★
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-extrabold text-amber-700 font-display counter-ticker" data-target="{{ $totalInternasional }}">0</span>
                    <span class="text-[11px] font-semibold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full">Global</span>
                </div>
                <p class="text-xs text-slate-500 mt-2">Olimpiade dunia</p>
            </div>

            <!-- Card 3: Nasional -->
            <div class="rounded-2xl p-6 bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Nasional</span>
                    <div class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalNasional }}">0</span>
                    <span class="text-[11px] font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">Puspresnas</span>
                </div>
                <p class="text-xs text-slate-500 mt-2">OSN, FLS2N, BRIN</p>
            </div>

            <!-- Card 4: Provinsi -->
            <div class="rounded-2xl p-6 bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Provinsi</span>
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalProvinsi }}">0</span>
                    <span class="text-[11px] font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">Jabar</span>
                </div>
                <p class="text-xs text-slate-500 mt-2">O2SN, POPDA</p>
            </div>

            <!-- Card 5: Kota / Kabupaten -->
            <div class="rounded-2xl p-6 bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Kota / Kab</span>
                    <div class="w-8 h-8 rounded-lg bg-teal-500/10 text-teal-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-display counter-ticker" data-target="{{ $totalKota }}">0</span>
                    <span class="text-[11px] font-semibold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">Wilayah</span>
                </div>
                <p class="text-xs text-slate-500 mt-2">Kejuaraan daerah</p>
            </div>

        </div>

    </div>
</section>
