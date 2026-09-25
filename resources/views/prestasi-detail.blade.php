@extends('layouts.app')

@section('title', $achievement->title . ' - Prestasi SMA Negeri Unggulan')
@section('meta_description', Str::limit($achievement->description, 160))
@section('og_image', $achievement->coverMedia?->file_url ?? asset('build/assets/og-prestasi.jpg'))

@section('content')
<div class="py-10 lg:py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumb / Back button -->
    <div class="mb-8">
        <a href="{{ route('home') }}#direktori" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-600 hover:text-brand-700 bg-white border border-slate-200 px-4 py-2 rounded-xl shadow-sm hover:shadow transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Katalog Prestasi</span>
        </a>
    </div>

    <!-- Article Container -->
    <article class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        
        <!-- Header Banner Image -->
        <div class="relative h-80 sm:h-96 w-full bg-slate-900 overflow-hidden">
            <img 
                src="{{ $achievement->coverMedia?->file_url ?? 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1400&q=80' }}" 
                alt="{{ $achievement->title }}" 
                class="w-full h-full object-cover opacity-85"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

            <!-- Header Content Overlay -->
            <div class="absolute bottom-6 left-6 right-6 sm:bottom-10 sm:left-10 sm:right-10 text-white">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                        @if($achievement->competition_level === 'Internasional') bg-amber-500
                        @elseif($achievement->competition_level === 'Nasional') bg-rose-500
                        @elseif($achievement->competition_level === 'Provinsi') bg-indigo-500
                        @else bg-slate-600 @endif text-white shadow">
                        ★ {{ $achievement->competition_level }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-slate-800 backdrop-blur-sm shadow">
                        {{ $achievement->category->name }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-sm shadow">
                        ✓ Terverifikasi Resmi
                    </span>
                </div>

                <h1 class="text-2xl sm:text-4xl font-extrabold font-display leading-tight drop-shadow">
                    {{ $achievement->title }}
                </h1>
                <p class="text-gold-300 font-bold text-base sm:text-lg mt-2 drop-shadow">
                    {{ $achievement->rank_grade }}
                </p>
            </div>
        </div>

        <!-- Body Details -->
        <div class="p-6 sm:p-10 space-y-10">
            
            <!-- Quick Meta Table -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                <div>
                    <span class="text-xs uppercase font-semibold text-slate-400 block mb-1">Tanggal Kejuaraan</span>
                    <span class="text-sm font-bold text-slate-800">{{ $achievement->event_date->translatedFormat('d F Y') }}</span>
                </div>
                <div>
                    <span class="text-xs uppercase font-semibold text-slate-400 block mb-1">Penyelenggara</span>
                    <span class="text-sm font-bold text-slate-800">{{ $achievement->organizer }}</span>
                </div>
                <div>
                    <span class="text-xs uppercase font-semibold text-slate-400 block mb-1">Guru Pembina</span>
                    <span class="text-sm font-bold text-slate-800">{{ $achievement->mentor_name ?? 'Tim Kesiswaan Sekolah' }}</span>
                </div>
            </div>

            <!-- Participants -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display mb-4">Siswa Peraih Capaian</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($achievement->participants as $student)
                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-white border border-slate-200/80 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 font-extrabold flex items-center justify-center text-base border border-brand-100">
                            {{ substr($student->full_name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">{{ $student->full_name }}</h4>
                            <p class="text-xs text-slate-500">NISN: {{ $student->nisn }} &bull; Kelas: {{ $student->class_grade }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display mb-3">Deskripsi Capaian & Rekam Jejak</h3>
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm sm:text-base">
                    <p>{{ $achievement->description }}</p>
                </div>
            </div>

            <!-- Media & Certificate Gallery -->
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display mb-4">Dokumentasi & Berkas Sertifikat</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($achievement->media as $media)
                    <a href="{{ $media->file_url }}" target="_blank" class="group relative block aspect-video rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm">
                        <img src="{{ $media->file_url }}" alt="Dokumentasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">
                            Buka Berkas Penuh &nearr;
                        </div>
                        <span class="absolute bottom-2 left-2 bg-slate-950/70 backdrop-blur-sm text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded">
                            {{ $media->file_type }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Social Share Box -->
            <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h4 class="text-sm font-bold text-slate-900">Bagikan Prestasi Ini</h4>
                    <p class="text-xs text-slate-500">Apresiasi dan sebarkan inspirasi keunggulan siswa kepada khalayak.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode('Lihat capaian prestasi: ' . $achievement->title . ' - ' . url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition-colors">
                        WhatsApp
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($achievement->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-slate-900 hover:bg-black text-white transition-colors">
                        X (Twitter)
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                        Facebook
                    </a>
                </div>
            </div>

        </div>

    </article>

</div>
@endsection
