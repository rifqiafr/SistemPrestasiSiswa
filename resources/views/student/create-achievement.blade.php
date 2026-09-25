@extends('student.layout')

@section('title', 'Input Prestasi Baru - Dashboard Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-1.5">
                <a href="{{ route('student.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard Siswa</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-800 font-semibold">Input Prestasi</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-bold font-display text-slate-900">
                Formulir Pengajuan Prestasi Siswa
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Laporkan capaian kejuaraan atau kompetisi yang berhasil Anda raih untuk diverifikasi oleh tim kesiswaan.
            </p>
        </div>

        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-xs">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <!-- Main Form -->
    <form action="{{ route('student.achievement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- SECTION 1: INFORMASI KOMPETISI -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                    1
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Informasi Kejuaraan & Kompetisi</h2>
                    <p class="text-xs text-slate-500">Nama ajang, kategori bidang, dan tingkat kejuaraan</p>
                </div>
            </div>

            <!-- Judul Prestasi -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Judul Prestasi / Nama Ajang Lomba <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    required 
                    value="{{ old('title') }}"
                    placeholder="Contoh: Juara 1 Olimpiade Sains Nasional (OSN) Bidang Informatika 2026"
                    class="w-full px-4 py-3 text-sm bg-slate-50 border @error('title') border-rose-300 ring-1 ring-rose-300 @else border-slate-200 @enderror rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                >
                @error('title')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Kategori Bidang -->
                <div>
                    <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Kategori Bidang <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="category_id" 
                        name="category_id" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                        <option value="">-- Pilih Bidang Prestasi --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tingkat Kompetisi -->
                <div>
                    <label for="competition_level" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tingkat Kompetisi <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="competition_level" 
                        name="competition_level" 
                        required 
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="Sekolah" {{ old('competition_level') === 'Sekolah' ? 'selected' : '' }}>Tingkat Sekolah / Internal</option>
                        <option value="Kabupaten/Kota" {{ old('competition_level') === 'Kabupaten/Kota' ? 'selected' : '' }}>Tingkat Kabupaten / Kota</option>
                        <option value="Provinsi" {{ old('competition_level') === 'Provinsi' ? 'selected' : '' }}>Tingkat Provinsi</option>
                        <option value="Nasional" {{ old('competition_level') === 'Nasional' ? 'selected' : '' }}>Tingkat Nasional</option>
                        <option value="Internasional" {{ old('competition_level') === 'Internasional' ? 'selected' : '' }}>Tingkat Internasional</option>
                    </select>
                    @error('competition_level')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Capaian / Peringkat -->
                <div>
                    <label for="rank_grade" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Peringkat / Capaian Juara <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="rank_grade" 
                        name="rank_grade" 
                        required 
                        value="{{ old('rank_grade') }}"
                        placeholder="Contoh: Juara 1, Medali Emas, Finalis, dsb."
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                    <div class="flex flex-wrap gap-1.5 mt-2">
                        <button type="button" onclick="setRank('Juara 1')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-brand-50 text-slate-600 hover:text-brand-600 rounded-md">Juara 1</button>
                        <button type="button" onclick="setRank('Juara 2')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-brand-50 text-slate-600 hover:text-brand-600 rounded-md">Juara 2</button>
                        <button type="button" onclick="setRank('Juara 3')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-brand-50 text-slate-600 hover:text-brand-600 rounded-md">Juara 3</button>
                        <button type="button" onclick="setRank('Medali Emas')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-gold-50 text-slate-600 hover:text-gold-700 rounded-md">Medali Emas</button>
                        <button type="button" onclick="setRank('Medali Perak')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-md">Medali Perak</button>
                        <button type="button" onclick="setRank('Juara Harapan 1')" class="text-[11px] px-2 py-0.5 bg-slate-100 hover:bg-brand-50 text-slate-600 hover:text-brand-600 rounded-md">Harapan 1</button>
                    </div>
                </div>

                <!-- Penyelenggara -->
                <div>
                    <label for="organizer" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Instansi / Lembaga Penyelenggara <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="organizer" 
                        name="organizer" 
                        required 
                        value="{{ old('organizer') }}"
                        placeholder="Contoh: Kemendikbudristek & Puspresnas"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Tanggal Lomba -->
                <div>
                    <label for="event_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tanggal Perolehan / Pelaksanaan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="event_date" 
                        name="event_date" 
                        required 
                        value="{{ old('event_date', date('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>

                <!-- Guru Pembimbing -->
                <div>
                    <label for="mentor_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Guru Pembina / Pembimbing (Opsional)
                    </label>
                    <input 
                        type="text" 
                        id="mentor_name" 
                        name="mentor_name" 
                        value="{{ old('mentor_name') }}"
                        placeholder="Contoh: Dra. Sri Wahyuni, M.Pd"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Deskripsi Ringkas / Cerita Kejuaraan
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3"
                    placeholder="Ceritakan gambaran lomba, inovasi atau karya yang dipresentasikan, jumlah peserta atau negara lawan..."
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                >{{ old('description') }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Deskripsi ini akan ditampilkan pada halaman detail prestasi publik.</p>
            </div>
        </div>

        <!-- SECTION 2: REKAN TIM (OPSIONAL) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-4">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                    2
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Keikutsertaan Tim / Beregu</h2>
                    <p class="text-xs text-slate-500">Jika lomba beregu atau kelompok, pilih rekan satu tim Anda</p>
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-xs text-slate-600 font-medium">
                    Peserta Utama: <strong class="text-slate-900">{{ $student->full_name }}</strong> ({{ $student->nisn }} - {{ $student->class_grade }})
                </p>

                <div>
                    <label for="teammate_ids" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tambah Rekan Satu Tim (Opsional, tahan Ctrl untuk memilih lebih dari satu):
                    </label>
                    <select 
                        id="teammate_ids" 
                        name="teammate_ids[]" 
                        multiple 
                        class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800 h-28"
                    >
                        @foreach($otherStudents as $other)
                            <option value="{{ $other->id }}">
                                {{ $other->full_name }} ({{ $other->nisn }} - {{ $other->class_grade }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Jika lomba individu/perorangan, kosongkan bagian ini.</p>
                </div>
            </div>
        </div>

        <!-- SECTION 3: UNGGAH BUKTI SERTIFIKAT & FOTO -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gold-50 text-gold-600 flex items-center justify-center font-bold">
                    3
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Unggah Dokumen Piagam & Foto Kegiatan</h2>
                    <p class="text-xs text-slate-500">Bukti otentik keabsahan sertifikat dan foto dokumentasi piala</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Foto Dokumentasi -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Foto Penyerahan Piala / Dokumentasi Lomba
                    </label>
                    <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-brand-500 transition-colors bg-slate-50/50 relative">
                        <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs font-semibold text-slate-700">Pilih berkas foto gambar</p>
                        <p class="text-[11px] text-slate-400 mt-1">JPG, PNG, atau WebP (Maks. 5 MB)</p>
                        <input 
                            type="file" 
                            id="photo" 
                            name="photo" 
                            accept="image/*"
                            onchange="previewImage(this, 'photo-preview')"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        >
                    </div>
                    <div id="photo-preview-box" class="hidden mt-3 p-2 bg-slate-50 rounded-xl border border-slate-200">
                        <img id="photo-preview" src="#" alt="Preview Foto" class="max-h-36 rounded-lg mx-auto object-cover">
                    </div>
                    @error('photo')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Piagam / Sertifikat -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        File Sertifikat / Piagam Penghargaan
                    </label>
                    <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center hover:border-brand-500 transition-colors bg-slate-50/50 relative">
                        <svg class="w-10 h-10 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-xs font-semibold text-slate-700">Pilih berkas piagam / sertifikat</p>
                        <p class="text-[11px] text-slate-400 mt-1">PDF, JPG, atau PNG (Maks. 10 MB)</p>
                        <input 
                            type="file" 
                            id="certificate" 
                            name="certificate" 
                            accept=".pdf,image/*"
                            onchange="showFileName(this, 'cert-name')"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        >
                    </div>
                    <p id="cert-name" class="hidden text-xs text-brand-700 font-semibold mt-2.5 p-2 bg-brand-50 rounded-lg border border-brand-200 truncate"></p>
                    @error('certificate')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="p-4 bg-brand-50/60 rounded-2xl border border-brand-100 text-xs text-brand-900 flex items-start gap-3">
                <svg class="w-5 h-5 text-brand-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <strong>Pemberitahuan Sistem:</strong> Pengajuan yang Anda kirim akan disimpan dengan status <em>Menunggu Verifikasi</em>. Tim Kesiswaan akan memeriksa keaslian data sebelum dipublikasikan ke Etalase Prestasi Publik.
                </div>
            </div>
        </div>

        <!-- SUBMIT BUTTONS -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-2">
            <a href="{{ route('student.dashboard') }}" class="w-full sm:w-auto px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors text-center shadow-xs">
                Batalkan
            </a>
            <button 
                type="submit" 
                class="w-full sm:w-auto px-8 py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm rounded-xl transition-all shadow-md shadow-brand-500/20 flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Kirim Pengajuan Prestasi</span>
            </button>
        </div>

    </form>

</div>

<script>
    function setRank(val) {
        document.getElementById('rank_grade').value = val;
    }

    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                document.getElementById('photo-preview-box').classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showFileName(input, nameId) {
        if (input.files && input.files[0]) {
            const nameEl = document.getElementById(nameId);
            nameEl.textContent = 'Berkas dipilih: ' + input.files[0].name;
            nameEl.classList.remove('hidden');
        }
    }
</script>
@endsection
