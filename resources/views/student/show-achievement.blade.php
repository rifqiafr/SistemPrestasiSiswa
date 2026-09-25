@extends('student.layout')

@section('title', $achievement->title . ' - Detail Capaian')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header & Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-1.5">
                <a href="{{ route('student.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard Siswa</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-800 font-semibold truncate max-w-xs">Detail Prestasi</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-bold font-display text-slate-900 leading-snug">
                {{ $achievement->title }}
            </h1>
        </div>

        <div class="flex items-center gap-2">
            @if($achievement->status === 'draft')
                <a href="{{ route('student.achievement.edit', $achievement->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-brand-50 hover:bg-brand-100 text-brand-700 text-xs font-bold rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Prestasi</span>
                </a>
            @else
                <a href="{{ route('prestasi.detail', $achievement->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold rounded-xl transition-colors">
                    <span>Lihat di Etalase Publik</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            @endif

            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold rounded-xl transition-colors shadow-xs">
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Status Banner -->
    <div class="rounded-2xl p-4 sm:p-5 border {{ $achievement->status === 'published' ? 'bg-emerald-50 border-emerald-200 text-emerald-900' : 'bg-amber-50 border-amber-200 text-amber-900' }} flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            @if($achievement->status === 'published')
                <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold">Status: Terverifikasi & Terbit di Website Resmi</h3>
                    <p class="text-xs text-emerald-700 mt-0.5">Prestasi ini telah diakui oleh tim kesiswaan dan tayang pada etalase keunggulan sekolah.</p>
                </div>
            @else
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold">Status: Menunggu Verifikasi Kesiswaan</h3>
                    <p class="text-xs text-amber-700 mt-0.5">Pengajuan Anda telah diterima sistem dan sedang dalam antrean verifikasi bukti piagam oleh staf kesiswaan.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Details Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xs space-y-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-6 border-b border-slate-100">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Peringkat / Juara</span>
                <p class="text-base font-extrabold text-slate-800 mt-1">{{ $achievement->rank_grade }}</p>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tingkat Kompetisi</span>
                <p class="text-base font-extrabold text-brand-600 mt-1">{{ $achievement->competition_level }}</p>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Bidang Kategori</span>
                <p class="text-base font-extrabold text-slate-800 mt-1">{{ $achievement->category->name ?? '-' }}</p>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tanggal Perolehan</span>
                <p class="text-base font-extrabold text-slate-800 mt-1">{{ \Carbon\Carbon::parse($achievement->event_date)->translatedFormat('d F Y') }}</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Instansi Penyelenggara</span>
                <p class="text-sm font-semibold text-slate-800 mt-1">{{ $achievement->organizer }}</p>
            </div>

            @if($achievement->mentor_name)
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Guru Pembina / Pembimbing</span>
                    <p class="text-sm font-semibold text-slate-800 mt-1">{{ $achievement->mentor_name }}</p>
                </div>
            @endif

            @if($achievement->description)
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Deskripsi / Cerita Lomba</span>
                    <p class="text-sm text-slate-600 mt-1 leading-relaxed whitespace-pre-line">{{ $achievement->description }}</p>
                </div>
            @endif

            <!-- Peserta / Tim -->
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Peserta / Anggota Tim</span>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach($achievement->participants as $p)
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-100 text-xs font-semibold text-slate-800 border border-slate-200">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            <span>{{ $p->full_name }} ({{ $p->nisn }} - {{ $p->class_grade }})</span>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Dokumen Media & Bukti -->
        <div class="pt-6 border-t border-slate-100 space-y-4">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-700">Bukti Lampiran & Sertifikat</h3>
            
            @if($achievement->media->isEmpty())
                <p class="text-xs text-slate-400 italic">Tidak ada foto atau sertifikat yang diunggah.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($achievement->media as $media)
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="flex items-center justify-between text-xs font-bold">
                                <span class="uppercase tracking-wider text-slate-600">
                                    {{ $media->file_type === 'certificate' ? 'Piagam / Sertifikat' : 'Foto Dokumentasi' }}
                                </span>
                                <a href="{{ $media->file_url }}" target="_blank" class="text-brand-600 hover:underline">
                                    Buka File Asli ↗
                                </a>
                            </div>

                            @if(Str::endsWith(strtolower($media->file_url), ['.jpg', '.jpeg', '.png', '.webp']))
                                <div class="rounded-xl overflow-hidden h-48 bg-black/5">
                                    <img src="{{ $media->file_url }}" alt="Dokumen Bukti" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-32 flex flex-col items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                                    <svg class="w-10 h-10 mb-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-xs font-semibold">Dokumen Piagam (PDF / Berkas)</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
