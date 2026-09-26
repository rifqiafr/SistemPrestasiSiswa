@extends('admin.layout')

@section('title', 'Kelola Prestasi Siswa')
@section('page_title', 'Kelola Prestasi')
@section('page_heading', 'Manajemen & Verifikasi Prestasi Siswa')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Filter Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Katalog Arsip Prestasi</h2>
            <p class="text-xs text-slate-500">Kelola kurasi, status publikasi, dan verifikasi sertifikat kejuaraan siswa.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.achievement.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-brand-600 hover:bg-brand-700 text-white shadow-md shadow-brand-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Prestasi Baru</span>
            </a>
        </div>
    </div>

    <!-- Quick Status Tabs -->
    <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3">
        <a href="{{ route('admin.achievement.index') }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ !request()->filled('status') && !request()->filled('featured') ? 'bg-slate-900 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <span>Semua Prestasi</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ !request()->filled('status') && !request()->filled('featured') ? 'bg-slate-700 text-white' : 'bg-slate-200 text-slate-700' }}">{{ $countAll }}</span>
        </a>

        <a href="{{ route('admin.achievement.index', ['status' => 'draft']) }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('status') === 'draft' ? 'bg-amber-500 text-slate-950 font-bold shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <span class="w-2 h-2 rounded-full bg-amber-400 {{ $countDraft > 0 ? 'animate-pulse' : '' }}"></span>
            <span>Menunggu Verifikasi</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ request('status') === 'draft' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800' }}">{{ $countDraft }}</span>
        </a>

        <a href="{{ route('admin.achievement.index', ['status' => 'published']) }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('status') === 'published' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <span>Diterbitkan ke Web</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ request('status') === 'published' ? 'bg-emerald-700 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $countPublished }}</span>
        </a>

        <a href="{{ route('admin.achievement.index', ['featured' => '1']) }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ request('featured') === '1' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
            <span>⭐ Sorotan Unggulan</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ request('featured') === '1' ? 'bg-indigo-700 text-white' : 'bg-indigo-100 text-indigo-800' }}">{{ $countFeatured }}</span>
        </a>
    </div>

    <!-- Filter & Search Bar Form -->
    <div class="rounded-2xl bg-white border border-slate-200 p-4 shadow-xs">
        <form action="{{ route('admin.achievement.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            @if(request('featured'))
                <input type="hidden" name="featured" value="{{ request('featured') }}">
            @endif

            <!-- Search Field -->
            <div class="lg:col-span-2 relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari judul lomba, siswa, atau penyelenggara..." 
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                >
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <!-- Level Dropdown -->
            <div>
                <select name="level" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="all">Semua Tingkat</option>
                    @foreach(['Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Sekolah'] as $lvl)
                        <option value="{{ $lvl }}" {{ request('level') === $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Dropdown -->
            <div>
                <select name="category" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2">
                <button type="submit" class="w-full py-2 px-4 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 transition-colors">
                    Terapkan
                </button>
                @if(request()->anyFilled(['search', 'level', 'category', 'status', 'featured']))
                    <a href="{{ route('admin.achievement.index') }}" title="Reset Filter" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 border border-slate-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Main Table Card -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Prestasi & Penyelenggara</th>
                        <th class="py-3.5 px-4">Peserta Siswa</th>
                        <th class="py-3.5 px-4">Tingkat & Kategori</th>
                        <th class="py-3.5 px-4">Tanggal Perolehan</th>
                        <th class="py-3.5 px-4 text-center">Status Publikasi</th>
                        <th class="py-3.5 px-4 text-center">Hall of Fame</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($achievements as $index => $item)
                        <tr class="hover:bg-slate-50/60 transition-colors {{ $item->status === 'draft' ? 'bg-amber-50/20' : '' }}">
                            <td class="py-4 px-4 text-center text-xs text-slate-400 font-mono">
                                {{ $achievements->firstItem() + $index }}
                            </td>
                            <td class="py-4 px-4 max-w-xs">
                                <div class="font-bold text-slate-900 line-clamp-1">
                                    {{ $item->title }}
                                </div>
                                <div class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <span class="font-semibold text-brand-700 bg-brand-50 px-1.5 py-0.2 rounded-sm border border-brand-200/50">
                                        {{ $item->rank_grade }}
                                    </span>
                                    <span>•</span>
                                    <span class="truncate">{{ $item->organizer }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-xs font-semibold text-slate-800 line-clamp-1">
                                    {{ $item->participants->pluck('full_name')->join(', ') ?: '-' }}
                                </div>
                                <div class="text-[11px] text-slate-400">
                                    {{ $item->participants->pluck('class_grade')->filter()->unique()->join(', ') }}
                                </div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $item->competition_level === 'Internasional' ? 'bg-purple-100 text-purple-700' : ($item->competition_level === 'Nasional' ? 'bg-red-100 text-red-700' : ($item->competition_level === 'Provinsi' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700')) }}">
                                    {{ $item->competition_level }}
                                </span>
                                <div class="text-[11px] text-slate-400 mt-1">
                                    {{ $item->category->name ?? '-' }}
                                </div>
                            </td>
                            <td class="py-4 px-4 text-xs text-slate-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.achievement.toggle-status', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($item->status === 'published')
                                        <button type="submit" title="Klik untuk ubah jadi Draf" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition-colors">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>Tayang</span>
                                        </button>
                                    @else
                                        <button type="submit" title="Klik untuk Verifikasi & Terbitkan" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 hover:bg-emerald-600 hover:text-white transition-all shadow-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span>Verifikasi</span>
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.achievement.toggle-featured', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $item->is_featured ? 'Hapus dari Sorotan' : 'Jadikan Sorotan Hall of Fame' }}" class="p-1 rounded-lg transition-colors {{ $item->is_featured ? 'text-amber-500 hover:text-amber-600 bg-amber-50' : 'text-slate-300 hover:text-amber-400' }}">
                                        <svg class="w-5 h-5 {{ $item->is_featured ? 'fill-amber-400' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.achievement.show', $item->id) }}" class="p-1.5 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors" title="Lihat Rincian & Sertifikat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.achievement.edit', $item->id) }}" class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors" title="Edit Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.achievement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi \'{{ addslashes($item->title) }}\'? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Prestasi" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-slate-500">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Tidak ada data prestasi yang cocok</h4>
                                <p class="text-xs text-slate-400 mt-1">Coba ubah kata kunci pencarian atau reset filter yang sedang aktif.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($achievements->hasPages())
            <div class="p-4 border-t border-slate-200 bg-slate-50/50">
                {{ $achievements->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
