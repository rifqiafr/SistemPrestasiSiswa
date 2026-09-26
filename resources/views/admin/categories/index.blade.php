@extends('admin.layout')

@section('title', 'Kategori Prestasi')
@section('page_title', 'Kategori Prestasi')
@section('page_heading', 'Manajemen Kategori & Bidang Prestasi')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Bidang Kategori Prestasi</h2>
            <p class="text-xs text-slate-500">Kelola klasifikasi bidang lomba seperti Sains, Olahraga, Seni Budaya, Riset, dan Robotika.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Col 1: Form Tambah Kategori -->
        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs h-fit space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">
                Tambah Kategori Baru
            </h3>

            <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label for="cat_name" class="block font-bold text-slate-700 mb-1">
                        Nama Kategori <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="cat_name" 
                        name="name" 
                        required 
                        placeholder="Contoh: Robotika & Inovasi Teknologi" 
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                    <p class="text-[11px] text-slate-400 mt-1">Slug URL akan dibuat secara otomatis.</p>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm">
                    Simpan Kategori
                </button>
            </form>
        </div>

        <!-- Col 2 & 3: Tabel Kategori -->
        <div class="lg:col-span-2 rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3.5 px-4 w-12 text-center">No</th>
                            <th class="py-3.5 px-4">Nama Bidang Kategori</th>
                            <th class="py-3.5 px-4">Slug URL</th>
                            <th class="py-3.5 px-4 text-center">Total Prestasi</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($categories as $index => $cat)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-mono">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-slate-900 text-xs">
                                    {{ $cat->name }}
                                </td>
                                <td class="py-3.5 px-4 text-xs font-mono text-slate-500">
                                    {{ $cat->slug }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                        {{ $cat->achievements_count }} Prestasi
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <form action="{{ route('admin.category.toggle', $cat->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $cat->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }} transition-colors">
                                            {{ $cat->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                    @if($cat->achievements_count == 0)
                                        <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Kategori" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[11px] text-slate-300 italic" title="Sedang digunakan">Terkunci</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
