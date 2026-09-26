@extends('admin.layout')

@section('title', 'Laporan Akreditasi Prestasi')
@section('page_title', 'Laporan Akreditasi')
@section('page_heading', 'Rekapitulasi Prestasi Siswa untuk Borang Akreditasi')

@push('styles')
<style>
@media print {
    /* Sembunyikan elemen navigasi dan kontrol saat dicetak */
    aside, header, footer, .no-print {
        display: none !important;
    }
    body, html {
        background: #ffffff !important;
        color: #000000 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .min-h-full, .lg\:pl-72, main {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .print-only {
        display: block !important;
    }
    .print-shadow-none {
        box-shadow: none !important;
        border: 1px solid #000000 !important;
    }
    table {
        border-collapse: collapse !important;
        width: 100% !important;
    }
    th, td {
        border: 1px solid #333333 !important;
        padding: 6px 8px !important;
        font-size: 10pt !important;
    }
    thead {
        background-color: #f0f0f0 !important;
    }
}
.print-only {
    display: none;
}
</style>
@endpush

@section('content')
<div class="space-y-6">

    <!-- Top Action & Filter Controls (Hidden in Print) -->
    <div class="no-print space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-extrabold font-display text-slate-900">Rekapitulasi Laporan Akreditasi</h2>
                <p class="text-xs text-slate-500">Filter dan cetak arsip prestasi berstandar instrumen Akreditasi Sekolah (BAN-S/M).</p>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-slate-900 hover:bg-slate-800 text-white shadow-md transition-all">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak / Unduh PDF</span>
                </button>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="rounded-2xl bg-white border border-slate-200 p-4 shadow-xs">
            <form action="{{ route('admin.report.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <!-- Year -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Tahun Perolehan</label>
                    <select name="year" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                        <option value="all">Semua Tahun</option>
                        @foreach($availableYears as $yr)
                            <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Level -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Tingkat Kejuaraan</label>
                    <select name="level" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                        <option value="all">Semua Tingkat</option>
                        @foreach(['Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Sekolah'] as $lvl)
                            <option value="{{ $lvl }}" {{ request('level') === $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Kategori Bidang</label>
                    <select name="category" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                        <option value="all">Semua Bidang</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full py-2 px-4 rounded-xl text-xs font-bold text-white bg-brand-600 hover:bg-brand-700 transition-colors">
                        Tampilkan Rekap
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Metric Pills -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
            <div class="p-3 rounded-xl bg-white border border-slate-200 text-center">
                <span class="text-[10px] text-slate-400 font-bold uppercase">Total Terdata</span>
                <div class="text-xl font-black text-slate-900 mt-0.5">{{ $totalCount }}</div>
            </div>
            <div class="p-3 rounded-xl bg-white border border-slate-200 text-center">
                <span class="text-[10px] text-purple-600 font-bold uppercase">Internasional</span>
                <div class="text-xl font-black text-purple-700 mt-0.5">{{ $internasionalCount }}</div>
            </div>
            <div class="p-3 rounded-xl bg-white border border-slate-200 text-center">
                <span class="text-[10px] text-red-600 font-bold uppercase">Nasional</span>
                <div class="text-xl font-black text-red-700 mt-0.5">{{ $nasionalCount }}</div>
            </div>
            <div class="p-3 rounded-xl bg-white border border-slate-200 text-center">
                <span class="text-[10px] text-blue-600 font-bold uppercase">Provinsi</span>
                <div class="text-xl font-black text-blue-700 mt-0.5">{{ $provinsiCount }}</div>
            </div>
            <div class="p-3 rounded-xl bg-white border border-slate-200 text-center">
                <span class="text-[10px] text-emerald-600 font-bold uppercase">Kab/Kota</span>
                <div class="text-xl font-black text-emerald-700 mt-0.5">{{ $kotaCount }}</div>
            </div>
        </div>
    </div>

    <!-- Official Report Paper Container -->
    <div class="rounded-2xl bg-white border border-slate-200 p-6 sm:p-10 shadow-sm print-shadow-none">

        <!-- Kop Surat Resmi (Print Header) -->
        <div class="border-b-4 border-double border-slate-900 pb-4 mb-6 text-center">
            <h4 class="text-xs sm:text-sm font-bold tracking-wider text-slate-800 uppercase">
                Pemerintah Provinsi Jawa Barat • Dinas Pendidikan
            </h4>
            <h3 class="text-base sm:text-xl font-black font-display tracking-tight text-slate-950 uppercase mt-0.5">
                SMA NEGERI UNGGULAN
            </h3>
            <p class="text-[11px] text-slate-600">
                Jl. Pendidikan Unggulan No. 45, Kompleks Prestasi Pelajar • Telp: (021) 7890-1234 • NPSN: 20104567
            </p>
            <p class="text-[10px] font-mono text-slate-500">
                Laman: https://prestasisekolah.sch.id • Surel: kesiswaan@prestasi.sch.id
            </p>
        </div>

        <!-- Judul Laporan -->
        <div class="text-center mb-6">
            <h4 class="text-sm sm:text-base font-extrabold uppercase text-slate-900 tracking-wide underline underline-offset-4">
                BUKTI DOKUMEN REKAPITULASI PRESTASI SISWA
            </h4>
            <p class="text-xs text-slate-500 mt-1">
                Kebutuhan Pelaporan Akreditasi Sekolah & Transparansi Publik (Koleksi Arsip Resmi)
            </p>
        </div>

        <!-- Tabel Rekapitulasi Akreditasi -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border border-slate-300">
                <thead class="bg-slate-100 text-slate-800 font-bold border-b border-slate-300">
                    <tr>
                        <th class="py-2 px-3 border border-slate-300 text-center w-8">No</th>
                        <th class="py-2 px-3 border border-slate-300">Nama Kejuaraan / Lomba</th>
                        <th class="py-2 px-3 border border-slate-300">Bidang</th>
                        <th class="py-2 px-3 border border-slate-300">Tingkat</th>
                        <th class="py-2 px-3 border border-slate-300">Peringkat / Capaian</th>
                        <th class="py-2 px-3 border border-slate-300">Nama Siswa & NISN</th>
                        <th class="py-2 px-3 border border-slate-300">Penyelenggara</th>
                        <th class="py-2 px-3 border border-slate-300">Tanggal</th>
                        <th class="py-2 px-3 border border-slate-300">Pembimbing</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($achievements as $index => $item)
                        <tr>
                            <td class="py-2 px-2 border border-slate-300 text-center font-mono text-[11px]">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-2 px-3 border border-slate-300 font-bold text-slate-900">
                                {{ $item->title }}
                            </td>
                            <td class="py-2 px-2 border border-slate-300 text-[11px] text-slate-700">
                                {{ $item->category->name ?? '-' }}
                            </td>
                            <td class="py-2 px-2 border border-slate-300 font-semibold text-slate-800 text-[11px] whitespace-nowrap">
                                {{ $item->competition_level }}
                            </td>
                            <td class="py-2 px-2 border border-slate-300 font-bold text-brand-800 text-[11px] whitespace-nowrap">
                                {{ $item->rank_grade }}
                            </td>
                            <td class="py-2 px-3 border border-slate-300 text-[11px]">
                                @foreach($item->participants as $p)
                                    <div><strong>{{ $p->full_name }}</strong> ({{ $p->class_grade }})</div>
                                @endforeach
                            </td>
                            <td class="py-2 px-2 border border-slate-300 text-[11px] text-slate-600">
                                {{ $item->organizer }}
                            </td>
                            <td class="py-2 px-2 border border-slate-300 text-[11px] whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d/m/Y') }}
                            </td>
                            <td class="py-2 px-2 border border-slate-300 text-[11px] text-slate-600">
                                {{ $item->mentor_name ?: '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-8 text-center text-slate-400 text-xs">
                                Tidak ada arsip prestasi yang sesuai dengan kriteria filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Lembar Pengesahan & Tanda Tangan -->
        <div class="mt-12 pt-6 grid grid-cols-2 gap-8 text-center text-xs">
            <div>
                <p class="text-slate-500">Mengetahui,</p>
                <p class="font-bold text-slate-900 mt-0.5">Kepala SMA Negeri Unggulan</p>
                <div class="h-20"></div>
                <p class="font-bold text-slate-900 underline">Drs. H. Mulyadi, M.Pd</p>
                <p class="text-[11px] text-slate-500 font-mono">NIP. 19680815 199403 1 004</p>
            </div>

            <div>
                <p class="text-slate-500">Dibuat di Kota, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold text-slate-900 mt-0.5">Staf Kesiswaan & Operator Sekolah</p>
                <div class="h-20"></div>
                <p class="font-bold text-slate-900 underline">{{ Auth::user()->name }}</p>
                <p class="text-[11px] text-slate-500 font-mono">NIP / NUPTK. 19890422 201902 1 008</p>
            </div>
        </div>

    </div>

</div>
@endsection
