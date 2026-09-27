<!-- 10. MODAL DETAIL PRESTASI (Rincian Siswa, Sertifikat, Sosial Share) -->
<dialog id="prestasi-modal" class="p-0 rounded-3xl max-w-2xl w-full backdrop:bg-slate-950/70 backdrop:backdrop-blur-sm shadow-2xl border border-slate-200/80 overflow-hidden focus:outline-none">
    <div class="bg-white flex flex-col max-h-[90vh]">
        
        <!-- Modal Header with Image -->
        <div class="relative h-64 sm:h-72 w-full bg-slate-950 overflow-hidden">
            <img id="modal-cover-img" src="" alt="Dokumentasi Lomba" class="w-full h-full object-cover opacity-85">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

            <!-- Close Button -->
            <button 
                type="button" 
                onclick="closeDetailModal()" 
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/60 text-white hover:bg-black/90 flex items-center justify-center backdrop-blur-md transition-colors focus:outline-none focus:ring-2 focus:ring-white"
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
                <p id="modal-rank" class="text-amber-300 font-bold text-sm mt-1"></p>
            </div>
        </div>

        <!-- Modal Scrollable Content -->
        <div class="p-6 sm:p-8 overflow-y-auto space-y-6 flex-grow">
            
            <!-- Quick Metadata -->
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
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Siswa Peraih Prestasi:</h4>
                <div id="modal-participants-list" class="grid grid-cols-1 sm:grid-cols-2 gap-2"></div>
            </div>

            <!-- Deskripsi Lengkap -->
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Capaian & Rekam Jejak:</h4>
                <p id="modal-description" class="text-sm text-slate-600 leading-relaxed"></p>
            </div>

            <!-- Dokumentasi & Berkas Sertifikat -->
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Dokumentasi & Sertifikat Resmi:</h4>
                <div id="modal-media-list" class="flex flex-wrap gap-3"></div>
            </div>

            <!-- Social Share Buttons -->
            <div class="pt-4 border-t border-slate-100">
                <span class="text-xs font-semibold text-slate-500 block mb-2">Bagikan Capaian Prestasi:</span>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="shareWhatsApp()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition-colors">
                        <span>WhatsApp</span>
                    </button>
                    <button type="button" onclick="shareTwitter()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 hover:bg-black text-white transition-colors">
                        <span>X (Twitter)</span>
                    </button>
                    <button type="button" onclick="shareFacebook()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                        <span>Facebook</span>
                    </button>
                    <button type="button" onclick="copyShareLink()" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors">
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

<!-- 11. MODAL BACA BERITA SEKOLAH -->
<dialog id="news-modal" class="p-0 rounded-3xl max-w-xl w-full backdrop:bg-slate-950/70 backdrop:backdrop-blur-sm shadow-2xl border border-slate-200/80 overflow-hidden focus:outline-none">
    <div class="bg-white flex flex-col max-h-[85vh]">
        <div class="relative h-56 w-full bg-slate-900">
            <img id="news-modal-img" src="" alt="Berita" class="w-full h-full object-cover">
            <button 
                type="button" 
                onclick="document.getElementById('news-modal').close()" 
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-black/60 text-white flex items-center justify-center"
            >
                ✕
            </button>
        </div>
        <div class="p-6 overflow-y-auto space-y-3">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span id="news-modal-cat" class="font-bold text-brand-600"></span>
                <span>•</span>
                <span id="news-modal-date"></span>
            </div>
            <h3 id="news-modal-title" class="text-xl font-bold font-display text-slate-900 leading-snug"></h3>
            <p id="news-modal-body" class="text-sm text-slate-600 leading-relaxed"></p>
        </div>
        <div class="p-4 bg-slate-50 border-t border-slate-100 text-right">
            <button type="button" onclick="document.getElementById('news-modal').close()" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl">
                Tutup
            </button>
        </div>
    </div>
</dialog>

<!-- 12. MODAL LIGHTBOX FASILITAS -->
<dialog id="facility-modal" class="p-0 rounded-3xl max-w-2xl w-full backdrop:bg-slate-950/80 backdrop:backdrop-blur-md shadow-2xl border border-slate-700 overflow-hidden focus:outline-none">
    <div class="bg-slate-900 text-white flex flex-col">
        <div class="relative h-80 w-full bg-black">
            <img id="facility-modal-img" src="" alt="Fasilitas" class="w-full h-full object-cover">
            <button 
                type="button" 
                onclick="document.getElementById('facility-modal').close()" 
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black/90 transition-colors"
            >
                ✕
            </button>
        </div>
        <div class="p-6 space-y-2">
            <span id="facility-modal-cat" class="text-xs font-bold text-amber-400 uppercase tracking-wider block"></span>
            <h3 id="facility-modal-name" class="text-xl font-bold font-display text-white"></h3>
            <p id="facility-modal-desc" class="text-sm text-slate-300 leading-relaxed"></p>
        </div>
    </div>
</dialog>

<!-- 13. MODAL PENCARIAN CEPAT PRESTASI (NAVBAR SEARCH) -->
<dialog id="nav-search-modal" class="p-0 rounded-3xl max-w-2xl w-full backdrop:bg-slate-950/70 backdrop:backdrop-blur-sm shadow-2xl border border-slate-200/90 overflow-hidden focus:outline-none">
    <div class="bg-white flex flex-col max-h-[85vh]">
        <!-- Search Input Bar -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center gap-3">
            <div class="text-brand-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input 
                type="text" 
                id="nav-modal-search-input" 
                placeholder="Cari event lomba, nama siswa, NISN, atau pembimbing..." 
                class="flex-1 bg-transparent text-sm sm:text-base text-slate-800 placeholder-slate-400 focus:outline-none"
                oninput="handleNavModalSearch(this.value)"
            >
            <button 
                type="button" 
                onclick="closeNavSearchModal()" 
                class="px-2.5 py-1 text-xs font-semibold text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors"
                title="Tutup (ESC)"
            >
                ESC
            </button>
        </div>

        <!-- Search Results List -->
        <div id="nav-modal-results" class="p-4 overflow-y-auto space-y-2 flex-grow max-h-96">
            <div class="text-center py-8 text-slate-400">
                <svg class="w-8 h-8 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <p class="text-xs">Ketik kata kunci untuk mencari data prestasi siswa...</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-5 py-3 bg-slate-50 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
            <span>Pencarian Cepat Data Prestasi</span>
            <a href="#direktori" onclick="closeNavSearchModal()" class="text-brand-600 hover:text-brand-700 font-semibold hover:underline">Ke Direktori Lengkap &rarr;</a>
        </div>
    </div>
</dialog>

