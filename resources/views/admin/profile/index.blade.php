@extends('admin.layout')

@section('title', 'Kelola Profil & Konten Landing Page')
@section('page_title', 'Profil & Visi Misi')
@section('page_heading', 'Pengaturan Konten Web & Profil Sekolah')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Kelola Konten Landing Page</h2>
            <p class="text-xs text-slate-500">Sesuaikan visi misi, sambutan kepala sekolah, kontak resmi, dan informasi identitas sekolah.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-brand-600 bg-brand-50 border border-brand-200 hover:bg-brand-100 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            <span>Pratinjau di Landing Page</span>
        </a>
    </div>

    <!-- Tab Buttons -->
    <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3">
        <button type="button" onclick="switchProfileTab('visi-misi')" id="tab-btn-visi-misi" class="profile-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-900 text-white shadow-xs">
            Visi, Misi & Sejarah
        </button>
        <button type="button" onclick="switchProfileTab('sambutan')" id="tab-btn-sambutan" class="profile-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
            Sambutan Kepala Sekolah
        </button>
        <button type="button" onclick="switchProfileTab('hero')" id="tab-btn-hero" class="profile-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
            Identitas & Hero Tagline
        </button>
        <button type="button" onclick="switchProfileTab('kontak')" id="tab-btn-kontak" class="profile-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-white text-slate-600 hover:bg-slate-100 border border-slate-200">
            Kontak & Informasi PPDB
        </button>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- TAB 1: VISI, MISI & SEJARAH -->
        <div id="tab-panel-visi-misi" class="profile-tab-panel space-y-6">
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span>Visi & Misi Strategis Sekolah</span>
                </h3>

                <div>
                    <label for="vision" class="block text-xs font-bold text-slate-700 mb-1">
                        Rumusan Visi Utama Sekolah <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        id="vision" 
                        name="vision" 
                        rows="3" 
                        required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                    >{{ old('vision', $settings['vision'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="mission_1" class="block text-xs font-bold text-slate-700 mb-1">Pilar Misi 01 (Akademik & Riset)</label>
                        <textarea id="mission_1" name="mission_1" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('mission_1', $settings['mission_1'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="mission_2" class="block text-xs font-bold text-slate-700 mb-1">Pilar Misi 02 (Karakter & Budi Pekerti)</label>
                        <textarea id="mission_2" name="mission_2" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('mission_2', $settings['mission_2'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="mission_3" class="block text-xs font-bold text-slate-700 mb-1">Pilar Misi 03 (Talenta Seni & Olahraga)</label>
                        <textarea id="mission_3" name="mission_3" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('mission_3', $settings['mission_3'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="mission_4" class="block text-xs font-bold text-slate-700 mb-1">Pilar Misi 04 (Kemitraan & Jejaring Global)</label>
                        <textarea id="mission_4" name="mission_4" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('mission_4', $settings['mission_4'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                    <div>
                        <label for="history_summary" class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Lintas Sejarah Sekolah</label>
                        <textarea id="history_summary" name="history_summary" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('history_summary', $settings['history_summary'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="faculty_summary" class="block text-xs font-bold text-slate-700 mb-1">Keterangan Tenaga Pendidik & Pembina</label>
                        <textarea id="faculty_summary" name="faculty_summary" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('faculty_summary', $settings['faculty_summary'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: SAMBUTAN KEPALA SEKOLAH -->
        <div id="tab-panel-sambutan" class="profile-tab-panel hidden space-y-6">
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span>Sambutan & Profil Pimpinan Sekolah</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="headmaster_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar</label>
                        <input type="text" id="headmaster_name" name="headmaster_name" value="{{ old('headmaster_name', $settings['headmaster_name'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="headmaster_title" class="block text-xs font-bold text-slate-700 mb-1">Jabatan</label>
                        <input type="text" id="headmaster_title" name="headmaster_title" value="{{ old('headmaster_title', $settings['headmaster_title'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="headmaster_nip" class="block text-xs font-bold text-slate-700 mb-1">NIP / Pangkat Golongan</label>
                        <input type="text" id="headmaster_nip" name="headmaster_nip" value="{{ old('headmaster_nip', $settings['headmaster_nip'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Foto Resmi Kepala Sekolah</label>
                        @if(!empty($settings['headmaster_photo']))
                            <div class="mb-2 w-28 h-36 rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                                <img src="{{ $settings['headmaster_photo'] }}" alt="Foto Kepala Sekolah" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="headmaster_photo_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                        <input type="hidden" name="headmaster_photo" value="{{ $settings['headmaster_photo'] ?? '' }}">
                    </div>

                    <div>
                        <label for="headmaster_quote_title" class="block text-xs font-bold text-slate-700 mb-1">Judul Kutipan Sambutan</label>
                        <input type="text" id="headmaster_quote_title" name="headmaster_quote_title" value="{{ old('headmaster_quote_title', $settings['headmaster_quote_title'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div>
                    <label for="headmaster_quote" class="block text-xs font-bold text-slate-700 mb-1">Isi Pesan / Kutipan Sambutan</label>
                    <textarea id="headmaster_quote" name="headmaster_quote" rows="4" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('headmaster_quote', $settings['headmaster_quote'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                    <div>
                        <label for="school_accreditation" class="block text-xs font-bold text-slate-700 mb-1">Status Akreditasi Sekolah</label>
                        <input type="text" id="school_accreditation" name="school_accreditation" value="{{ old('school_accreditation', $settings['school_accreditation'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="school_ptn_rate" class="block text-xs font-bold text-slate-700 mb-1">Keterangan Rasio Kelulusan PTN</label>
                        <input type="text" id="school_ptn_rate" name="school_ptn_rate" value="{{ old('school_ptn_rate', $settings['school_ptn_rate'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: IDENTITAS & HERO TAGLINE -->
        <div id="tab-panel-hero" class="profile-tab-panel hidden space-y-6">
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span>Identitas Brand & Banner Utama (Hero)</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="school_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Resmi Sekolah</label>
                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $settings['school_name'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="school_npsn" class="block text-xs font-bold text-slate-700 mb-1">Nomor Pokok Sekolah Nasional (NPSN)</label>
                        <input type="text" id="school_npsn" name="school_npsn" value="{{ old('school_npsn', $settings['school_npsn'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div>
                    <label for="school_tagline" class="block text-xs font-bold text-slate-700 mb-1">Tagline Utama Sekolah</label>
                    <input type="text" id="school_tagline" name="school_tagline" value="{{ old('school_tagline', $settings['school_tagline'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>

                <div>
                    <label for="school_subtagline" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Tagline / Sub-heading Hero</label>
                    <textarea id="school_subtagline" name="school_subtagline" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('school_subtagline', $settings['school_subtagline'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- TAB 4: KONTAK & INFORMASI PPDB -->
        <div id="tab-panel-kontak" class="profile-tab-panel hidden space-y-6">
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span>Alamat, Kontak Layanan & PPDB</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="contact_address" class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap Kampus</label>
                        <input type="text" id="contact_address" name="contact_address" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="contact_city" class="block text-xs font-bold text-slate-700 mb-1">Kota / Provinsi & Kode Pos</label>
                        <input type="text" id="contact_city" name="contact_city" value="{{ old('contact_city', $settings['contact_city'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="contact_phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Kantor</label>
                        <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="contact_whatsapp" class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Hotline PPDB</label>
                        <input type="text" id="contact_whatsapp" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="contact_email" class="block text-xs font-bold text-slate-700 mb-1">Alamat Email Resmi</label>
                        <input type="text" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div>
                    <label for="contact_hours" class="block text-xs font-bold text-slate-700 mb-1">Jam Operasional Layanan</label>
                    <input type="text" id="contact_hours" name="contact_hours" value="{{ old('contact_hours', $settings['contact_hours'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                    <div>
                        <label for="ppdb_info_title" class="block text-xs font-bold text-slate-700 mb-1">Judul Banner PPDB</label>
                        <input type="text" id="ppdb_info_title" name="ppdb_info_title" value="{{ old('ppdb_info_title', $settings['ppdb_info_title'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>

                    <div>
                        <label for="ppdb_url" class="block text-xs font-bold text-slate-700 mb-1">Tautan Web Pendaftaran PPDB</label>
                        <input type="text" id="ppdb_url" name="ppdb_url" value="{{ old('ppdb_url', $settings['ppdb_url'] ?? '') }}" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    </div>
                </div>

                <div>
                    <label for="ppdb_info_desc" class="block text-xs font-bold text-slate-700 mb-1">Deskripsi / Ketentuan Jalur Prestasi PPDB</label>
                    <textarea id="ppdb_info_desc" name="ppdb_info_desc" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">{{ old('ppdb_info_desc', $settings['ppdb_info_desc'] ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-brand-600 hover:bg-brand-700 text-white shadow-lg shadow-brand-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Simpan Seluruh Pengaturan Profil</span>
            </button>
        </div>
    </form>

</div>

<script>
    function switchProfileTab(tabId) {
        document.querySelectorAll('.profile-tab-panel').forEach(panel => panel.classList.add('hidden'));
        document.querySelectorAll('.profile-tab-btn').forEach(btn => {
            btn.classList.remove('bg-slate-900', 'text-white', 'shadow-xs');
            btn.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
        });

        const activePanel = document.getElementById('tab-panel-' + tabId);
        const activeBtn = document.getElementById('tab-btn-' + tabId);

        if (activePanel && activeBtn) {
            activePanel.classList.remove('hidden');
            activeBtn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            activeBtn.classList.add('bg-slate-900', 'text-white', 'shadow-xs');
        }
    }
</script>
@endsection
