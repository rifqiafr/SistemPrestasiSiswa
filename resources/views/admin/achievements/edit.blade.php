@extends('admin.layout')

@section('title', 'Edit Data Prestasi')
@section('page_title', 'Edit Prestasi')
@section('page_heading', 'Perbarui Data & Verifikasi Prestasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Perbarui Arsip Prestasi</h2>
            <p class="text-xs text-slate-500">Edit detail kejuaraan, sesuaikan nama peserta, atau ganti dokumen pendukung.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.achievement.show', $achievement->id) }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 transition-colors">
                <span>Lihat Detail</span>
            </a>
            <a href="{{ route('admin.achievement.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Daftar</span>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.achievement.update', $achievement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Informasi Utama Kompetisi -->
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                <span>1. Informasi Kejuaraan & Prestasi</span>
            </h3>

            <!-- Judul Prestasi -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 mb-1">
                    Nama Kejuaraan / Judul Prestasi <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $achievement->title) }}" 
                    required
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Bidang Kategori -->
                <div>
                    <label for="category_id" class="block text-xs font-bold text-slate-700 mb-1">
                        Bidang Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select id="category_id" name="category_id" required class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $achievement->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tingkat Kompetisi -->
                <div>
                    <label for="competition_level" class="block text-xs font-bold text-slate-700 mb-1">
                        Tingkat Kompetisi <span class="text-rose-500">*</span>
                    </label>
                    <select id="competition_level" name="competition_level" required class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        @foreach(['Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Sekolah'] as $lvl)
                            <option value="{{ $lvl }}" {{ old('competition_level', $achievement->competition_level) === $lvl ? 'selected' : '' }}>
                                Tingkat {{ $lvl }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Capaian / Peringkat -->
                <div>
                    <label for="rank_grade" class="block text-xs font-bold text-slate-700 mb-1">
                        Peringkat / Capaian Medali <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="rank_grade" 
                        name="rank_grade" 
                        value="{{ old('rank_grade', $achievement->rank_grade) }}" 
                        required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <!-- Instansi Penyelenggara -->
                <div>
                    <label for="organizer" class="block text-xs font-bold text-slate-700 mb-1">
                        Instansi / Lembaga Penyelenggara <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="organizer" 
                        name="organizer" 
                        value="{{ old('organizer', $achievement->organizer) }}" 
                        required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Tanggal Perolehan -->
                <div>
                    <label for="event_date" class="block text-xs font-bold text-slate-700 mb-1">
                        Tanggal Perolehan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="event_date" 
                        name="event_date" 
                        value="{{ old('event_date', $achievement->event_date) }}" 
                        required
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <!-- Guru Pembimbing / Pelatih -->
                <div>
                    <label for="mentor_name" class="block text-xs font-bold text-slate-700 mb-1">
                        Guru Pembimbing / Pembina
                    </label>
                    <input 
                        type="text" 
                        id="mentor_name" 
                        name="mentor_name" 
                        value="{{ old('mentor_name', $achievement->mentor_name) }}" 
                        class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 mb-1">
                    Deskripsi Ringkas / Cerita Keberhasilan
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >{{ old('description', $achievement->description) }}</textarea>
            </div>
        </div>

        <!-- Card 2: Peserta Siswa -->
        @php
            $attachedIds = $achievement->participants->pluck('id')->toArray();
        @endphp
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span>2. Siswa Peserta Kejuaraan <span class="text-rose-500">*</span></span>
                </div>
                <span class="text-xs font-normal text-slate-400">Centang siswa yang berpartisipasi</span>
            </h3>

            <div class="space-y-2">
                <input 
                    type="text" 
                    id="studentFilterInput" 
                    placeholder="Filter nama siswa..." 
                    onkeyup="filterStudentList()"
                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >

                <div id="studentListContainer" class="max-h-56 overflow-y-auto rounded-xl border border-slate-200 p-3 space-y-2 bg-slate-50/50">
                    @foreach($students as $std)
                        <label class="student-item flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100 hover:border-brand-300 cursor-pointer transition-colors text-xs">
                            <div class="flex items-center gap-3">
                                <input 
                                    type="checkbox" 
                                    name="student_ids[]" 
                                    value="{{ $std->id }}" 
                                    {{ (is_array(old('student_ids')) && in_array($std->id, old('student_ids'))) || (!old('student_ids') && in_array($std->id, $attachedIds)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500"
                                >
                                <div>
                                    <div class="font-bold text-slate-800 student-name">{{ $std->full_name }}</div>
                                    <div class="text-[11px] text-slate-400 student-meta">NISN: {{ $std->nisn }} • Kelas: {{ $std->class_grade }}</div>
                                </div>
                            </div>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 font-mono text-slate-500">
                                Angkatan {{ $std->cohort_year }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Card 3: Bukti & Dokumen Media -->
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                <span>3. Dokumen Foto & Sertifikat</span>
            </h3>

            @php
                $photoMedia = $achievement->media->firstWhere('file_type', 'photo');
                $certMedia = $achievement->media->firstWhere('file_type', 'certificate');
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Foto Dokumentasi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Foto Dokumentasi
                    </label>
                    @if($photoMedia)
                        <div class="mb-3 relative rounded-xl overflow-hidden border border-slate-200 max-h-40 bg-slate-100">
                            <img src="{{ $photoMedia->file_url }}" alt="Foto Lama" class="w-full h-36 object-cover">
                            <span class="absolute bottom-2 left-2 px-2 py-0.5 rounded bg-black/70 text-white text-[10px] font-semibold">Foto Saat Ini</span>
                        </div>
                    @endif
                    <div class="p-4 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50/50 text-center">
                        <label for="photo" class="cursor-pointer font-bold text-xs text-brand-600 hover:text-brand-700">
                            <span>Ganti / Unggah Foto Baru</span>
                            <input id="photo" name="photo" type="file" accept="image/*" class="sr-only">
                        </label>
                        <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>
                </div>

                <!-- Sertifikat Bukti -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Pindaian Sertifikat Penghargaan
                    </label>
                    @if($certMedia)
                        <div class="mb-3 p-3 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2 truncate">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="font-semibold text-slate-700 truncate">Sertifikat terlampir</span>
                            </div>
                            <a href="{{ $certMedia->file_url }}" target="_blank" class="text-brand-600 font-bold hover:underline flex-shrink-0 text-xs">Lihat</a>
                        </div>
                    @endif
                    <div class="p-4 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50/50 text-center">
                        <label for="certificate" class="cursor-pointer font-bold text-xs text-brand-600 hover:text-brand-700">
                            <span>Ganti / Unggah Sertifikat Baru</span>
                            <input id="certificate" name="certificate" type="file" accept=".pdf,image/*" class="sr-only">
                        </label>
                        <p class="text-[10px] text-slate-400 mt-1">PDF atau Gambar (Maks. 10 MB)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Pengaturan Publikasi -->
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                <span>4. Pengaturan Publikasi & Status</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 mb-1">
                        Status Publikasi <span class="text-rose-500">*</span>
                    </label>
                    <select id="status" name="status" required class="w-full px-3 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="published" {{ old('status', $achievement->status) === 'published' ? 'selected' : '' }}>
                            🟢 Terpublikasi (Aktif di Website)
                        </option>
                        <option value="draft" {{ old('status', $achievement->status) === 'draft' ? 'selected' : '' }}>
                            🟡 Draf (Menunggu Verifikasi)
                        </option>
                    </select>
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="is_featured" 
                            value="1" 
                            {{ old('is_featured', $achievement->is_featured) ? 'checked' : '' }}
                            class="w-5 h-5 text-amber-500 rounded border-slate-300 focus:ring-amber-400"
                        >
                        <div>
                            <div class="text-xs font-bold text-slate-800">
                                ⭐ Sorotan Hall of Fame (Unggulan)
                            </div>
                            <div class="text-[11px] text-slate-400">
                                Tampilkan prestasi ini di section Hall of Fame beranda sekolah.
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.achievement.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-brand-600 hover:bg-brand-700 text-white shadow-lg shadow-brand-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>

</div>

<script>
    function filterStudentList() {
        const query = document.getElementById('studentFilterInput').value.toLowerCase();
        const items = document.querySelectorAll('.student-item');

        items.forEach(item => {
            const name = item.querySelector('.student-name').textContent.toLowerCase();
            const meta = item.querySelector('.student-meta').textContent.toLowerCase();
            if (name.includes(query) || meta.includes(query)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endsection
