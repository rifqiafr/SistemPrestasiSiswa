<!-- 3. VISI, MISI & NILAI UNGGULAN KARAKTER -->
<section id="visi-misi" class="py-16 sm:py-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200 text-brand-700 text-xs font-bold uppercase tracking-wider mb-3">
                Fondasi Filosofis Sekolah
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-display text-slate-900 tracking-tight">
                Visi, Misi Strategis & Karakter Unggulan
            </h2>
            <p class="text-slate-600 mt-3 text-sm sm:text-base">
                Arah haluan institusi dalam menyelenggarakan pendidikan berstandar tinggi yang berakar pada kearifan dan berorientasi masa depan.
            </p>
        </div>

        <!-- Kartu Visi Utama -->
        <div class="mb-14 bg-gradient-to-tr from-brand-900 via-brand-800 to-slate-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl border border-brand-700/50 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 text-center max-w-4xl mx-auto">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-amber-300 bg-white/10 px-4 py-1.5 rounded-full mb-4">
                    Visi Sekolah
                </span>
                <h3 class="text-xl sm:text-3xl lg:text-4xl font-bold font-display leading-relaxed sm:leading-snug">
                    "{{ $settings['vision'] ?? 'Terwujudnya Generasi Unggul yang Beriman, Berbudi Pekerti Luhur, Berwawasan Global, serta Unggul dalam Penguasaan Sains dan Teknologi.' }}"
                </h3>
            </div>
        </div>

        <!-- Grid 4 Misi Strategis -->
        <div class="mb-16">
            <h3 class="text-lg font-bold font-display text-slate-900 mb-6 flex items-center gap-2">
                <span class="w-2.5 h-6 bg-brand-600 rounded-sm"></span>
                <span>Pilar Misi Strategis Sekolah</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-bold text-lg mb-4">
                        01
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2 font-display">Mutu Akademik & Riset</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $settings['mission_1'] ?? 'Menyelenggarakan pembelajaran saintifik dan proyek riset aplikatif untuk menghasilkan lulusan yang adaptif serta kompetitif secara akademik.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-lg mb-4">
                        02
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2 font-display">Karakter & Budi Pekerti</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $settings['mission_2'] ?? 'Menginternalisasikan nilai-nilai keagamaan, toleransi, kedisiplinan, dan etika kesantunan dalam seluruh ekosistem warga sekolah.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-lg mb-4">
                        03
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2 font-display">Talenta Seni & Olahraga</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $settings['mission_3'] ?? 'Mewadahi dan mengasah potensi minat bakat siswa di bidang seni budaya nusantara dan olahraga melalui kurasi kompetisi berjenjang.' }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-lg mb-4">
                        04
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2 font-display">Kemitraan & Jejaring Global</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $settings['mission_4'] ?? 'Membangun kolaborasi aktif bersama universitas terkemuka, lembaga riset nasional, dan institusi pendidikan internasional.' }}
                    </p>
                </div>

            </div>
        </div>

        <!-- Profil Singkat Sejarah & Pendidik -->
        <div id="profil-sejarah" class="mt-12 bg-brand-50/60 rounded-3xl p-8 sm:p-10 border border-brand-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-xs font-bold text-brand-700 uppercase tracking-wider block mb-1">Lintas Sejarah</span>
                    <h3 class="text-xl sm:text-2xl font-bold font-display text-slate-900 mb-3">
                        Dedikasi Mengabdi Sejak 1985
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        {{ $settings['history_summary'] ?? 'Berdiri sejak tahun 1985, SMA Negeri Unggulan telah membina lebih dari 35 angkatan alumni yang kini berkiprah sebagai akademisi, profesional industri, pejabat publik, dan pengusaha di berbagai belahan dunia.' }}
                    </p>
                    <div class="flex items-center gap-4 text-xs font-semibold text-brand-800">
                        <span>Koleksi 1.500+ Penghargaan</span>
                        <span>•</span>
                        <span>Jejaring 12.000+ Alumni</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-brand-200/80 shadow-sm space-y-3">
                    <h4 class="text-sm font-bold text-slate-900 font-display">Tenaga Pendidik & Pembina Talenta</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        {{ $settings['faculty_summary'] ?? 'Didukung oleh 68 tenaga pendidik profesional berkualifikasi magister (S2) dan doktoral (S3), bersertifikasi pendidik nasional serta aktif sebagai pembina olimpiade sains.' }}
                    </p>
                    <div class="pt-2 flex items-center gap-2">
                        <span class="px-2.5 py-1 bg-brand-100 text-brand-800 text-[11px] font-semibold rounded-lg">Kualifikasi S2: 45%</span>
                        <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[11px] font-semibold rounded-lg">Asesor Nasional: 8 Guru</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
