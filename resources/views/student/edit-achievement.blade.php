@extends('student.layout')

@section('title', 'Edit Pengajuan Prestasi - Dashboard Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-1.5">
                <a href="{{ route('student.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard Siswa</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-800 font-semibold truncate max-w-xs">Edit Prestasi</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-bold font-display text-slate-900">
                Edit Pengajuan Prestasi
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Perbarui data atau berkas dokumen piagam sebelum diverifikasi oleh tim kesiswaan.
            </p>
        </div>

        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-xs">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Batal & Kembali</span>
        </a>
    </div>

    <!-- Main Form -->
    <form action="{{ route('student.achievement.update', $achievement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- SECTION 1: INFORMASI KOMPETISI -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                    1
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Informasi Kejuaraan & Kompetisi</h2>
                    <p class="text-xs text-slate-500">Perbarui rincian capaian kejuaraan</p>
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
                    value="{{ old('title', $achievement->title) }}"
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
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $achievement->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
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
                        <option value="Sekolah" {{ old('competition_level', $achievement->competition_level) === 'Sekolah' ? 'selected' : '' }}>Tingkat Sekolah / Internal</option>
                        <option value="Kabupaten/Kota" {{ old('competition_level', $achievement->competition_level) === 'Kabupaten/Kota' ? 'selected' : '' }}>Tingkat Kabupaten / Kota</option>
                        <option value="Provinsi" {{ old('competition_level', $achievement->competition_level) === 'Provinsi' ? 'selected' : '' }}>Tingkat Provinsi</option>
                        <option value="Nasional" {{ old('competition_level', $achievement->competition_level) === 'Nasional' ? 'selected' : '' }}>Tingkat Nasional</option>
                        <option value="Internasional" {{ old('competition_level', $achievement->competition_level) === 'Internasional' ? 'selected' : '' }}>Tingkat Internasional</option>
                    </select>
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
                        value="{{ old('rank_grade', $achievement->rank_grade) }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
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
                        value="{{ old('organizer', $achievement->organizer) }}"
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
                        value="{{ old('event_date', optional($achievement->event_date)->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                    >
                </div>

                <!-- Guru Pembimbing -->
                <div>
                    <label for="mentor_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Guru Pembina / Pembimbing
                    </label>
                    <input 
                        type="text" 
                        id="mentor_name" 
                        name="mentor_name" 
                        value="{{ old('mentor_name', $achievement->mentor_name) }}"
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
                    class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800"
                >{{ old('description', $achievement->description) }}</textarea>
            </div>
        </div>

        <!-- SECTION 2: REKAN TIM -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-4">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                    2
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Anggota Tim / Beregu</h2>
                </div>
            </div>

            <div>
                <label for="teammate_ids" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Rekan Satu Tim (Tahan Ctrl untuk memilih lebih dari satu):
                </label>
                @php
                    $existingParticipantIds = $achievement->participants->pluck('id')->toArray();
                @endphp
                <select 
                    id="teammate_ids" 
                    name="teammate_ids[]" 
                    multiple 
                    class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-brand-500 transition-all text-slate-800 h-28"
                >
                    @foreach($otherStudents as $other)
                        <option value="{{ $other->id }}" {{ in_array($other->id, $existingParticipantIds) ? 'selected' : '' }}>
                            {{ $other->full_name }} ({{ $other->nisn }} - {{ $other->class_grade }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- SECTION 3: UNGGAH DOKUMEN BARU (OPSIONAL) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gold-50 text-gold-600 flex items-center justify-center font-bold">
                    3
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-display">Unggah Dokumen / Piagam Baru (Opsional)</h2>
                    <p class="text-xs text-slate-500">Pilih berkas baru jika ingin mengganti bukti sertifikat</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Foto Dokumentasi Baru -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Foto Dokumentasi Lomba Baru
                    </label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                </div>

                <!-- Piagam Baru -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        File Sertifikat / Piagam Baru
                    </label>
                    <input type="file" name="certificate" accept=".pdf,image/*" class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
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
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection
