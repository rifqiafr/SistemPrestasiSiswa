@extends('admin.layout')

@section('title', 'Detail Prestasi: ' . $achievement->title)
@section('page_title', 'Rincian Prestasi')
@section('page_heading', 'Detail & Dokumen Prestasi Siswa')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Action Nav -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $achievement->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                    {{ $achievement->status === 'published' ? '🟢 Terpublikasi' : '🟡 Menunggu Verifikasi (Draf)' }}
                </span>
                @if($achievement->is_featured)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                        ⭐ Hall of Fame
                    </span>
                @endif
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold font-display text-slate-900 mt-1">
                {{ $achievement->title }}
            </h2>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <!-- Toggle Status Button -->
            <form action="{{ route('admin.achievement.toggle-status', $achievement->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-3.5 py-2 rounded-xl text-xs font-bold {{ $achievement->status === 'published' ? 'bg-amber-100 text-amber-900 hover:bg-amber-200' : 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm' }} transition-colors">
                    {{ $achievement->status === 'published' ? 'Ubah ke Draf' : '✓ Verifikasi & Terbitkan' }}
                </button>
            </form>

            <a href="{{ route('admin.achievement.edit', $achievement->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                <span>Edit</span>
            </a>

            @if($achievement->status === 'published')
                <a href="{{ route('prestasi.detail', $achievement->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-brand-600 bg-brand-50 border border-brand-200 hover:bg-brand-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Halaman Publik</span>
                </a>
            @endif

            <a href="{{ route('admin.achievement.index') }}" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 transition-colors" title="Kembali ke Daftar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Col 1 & 2: Detailed Specs -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Metadata Card -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-2">
                    Informasi Kompetisi
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 block">Capaian / Peringkat</span>
                        <span class="font-bold text-brand-700 text-sm block mt-0.5">{{ $achievement->rank_grade }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block">Tingkat Wilayah</span>
                        <span class="font-semibold text-slate-800 text-sm block mt-0.5">Tingkat {{ $achievement->competition_level }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block">Bidang Kategori</span>
                        <span class="font-semibold text-slate-800 block mt-0.5">{{ $achievement->category->name ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block">Tanggal Perolehan</span>
                        <span class="font-semibold text-slate-800 block mt-0.5">
                            {{ \Carbon\Carbon::parse($achievement->event_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <div>
                        <span class="text-slate-400 block">Instansi Penyelenggara</span>
                        <span class="font-semibold text-slate-800 block mt-0.5">{{ $achievement->organizer }}</span>
                    </div>

                    <div>
                        <span class="text-slate-400 block">Guru Pembimbing</span>
                        <span class="font-semibold text-slate-800 block mt-0.5">{{ $achievement->mentor_name ?: 'Tidak dicantumkan' }}</span>
                    </div>
                </div>

                @if($achievement->description)
                    <div class="pt-3 border-t border-slate-100 text-xs">
                        <span class="text-slate-400 block mb-1">Deskripsi & Cerita Prestasi</span>
                        <p class="text-slate-700 leading-relaxed bg-slate-50 p-3 rounded-xl border border-slate-100">
                            {{ $achievement->description }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Participants Card -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Siswa Peraih Prestasi ({{ $achievement->participants->count() }} Orang)
                    </h3>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($achievement->participants as $std)
                        <div class="py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($std->full_name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">{{ $std->full_name }}</div>
                                    <div class="text-[11px] text-slate-400">
                                        NISN: {{ $std->nisn }} • Kelas: {{ $std->class_grade }}
                                    </div>
                                </div>
                            </div>
                            <span class="text-[11px] px-2.5 py-0.5 rounded-full bg-slate-100 font-mono text-slate-600">
                                Angkatan {{ $std->cohort_year }}
                            </span>
                        </div>
                    @empty
                        <div class="py-4 text-xs text-slate-400 text-center">Belum ada siswa yang ditautkan ke prestasi ini.</div>
                    @endforelse
                </div>
            </div>

            <!-- Documentation Photo Preview -->
            @php
                $photoMedia = $achievement->media->firstWhere('file_type', 'photo');
            @endphp
            @if($photoMedia)
                <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Dokumentasi Kegiatan
                    </h3>
                    <div class="rounded-xl overflow-hidden border border-slate-200 max-h-96 bg-slate-100">
                        <img src="{{ $photoMedia->file_url }}" alt="{{ $achievement->title }}" class="w-full h-auto object-cover">
                    </div>
                </div>
            @endif
        </div>

        <!-- Col 3: Certificate Preview & Verification Actions -->
        <div class="space-y-6">
            <!-- Certificate Card -->
            @php
                $certMedia = $achievement->media->firstWhere('file_type', 'certificate');
            @endphp
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        Sertifikat / Piagam
                    </h3>
                    @if($certMedia)
                        <a href="{{ $certMedia->file_url }}" target="_blank" class="text-xs font-bold text-brand-600 hover:underline">
                            Buka Ukuran Penuh
                        </a>
                    @endif
                </div>

                @if($certMedia)
                    @if(Str::endsWith(strtolower($certMedia->file_url), ['.pdf']))
                        <div class="p-6 rounded-xl border border-slate-200 bg-slate-50 text-center space-y-3">
                            <svg class="w-12 h-12 text-rose-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <div class="text-xs font-bold text-slate-800">Dokumen Sertifikat PDF</div>
                            <a href="{{ $certMedia->file_url }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 transition-colors">
                                <span>Lihat File PDF</span>
                            </a>
                        </div>
                    @else
                        <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                            <img src="{{ $certMedia->file_url }}" alt="Sertifikat" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @endif
                @else
                    <div class="py-8 text-center text-xs text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        Belum ada dokumen sertifikat yang diunggah.
                    </div>
                @endif
            </div>

            <!-- Operator Verification Log -->
            <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-3 text-xs">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-2">
                    Informasi Sistem
                </h3>
                <div class="space-y-2 text-slate-600">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Penginput:</span>
                        <span class="font-semibold text-slate-800">{{ $achievement->creator->name ?? 'Siswa / Sistem' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Dibuat Pada:</span>
                        <span>{{ $achievement->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Terakhir Diubah:</span>
                        <span>{{ $achievement->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Slug URL:</span>
                        <span class="font-mono text-[11px] text-slate-500 truncate max-w-[150px]">{{ $achievement->slug }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
