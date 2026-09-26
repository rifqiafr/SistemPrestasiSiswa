@extends('admin.layout')

@section('title', 'Edit Berita: ' . $news->title)
@section('page_title', 'Edit Berita')
@section('page_heading', 'Perbarui Berita Kegiatan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Edit Berita Kegiatan</h2>
            <p class="text-xs text-slate-500">Perbarui rilis warta kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-100 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-xs space-y-5">
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 mb-1">
                    Judul Berita <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $news->title) }}" 
                    required 
                    class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="category" class="block text-xs font-bold text-slate-700 mb-1">
                        Kategori Berita <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="category" 
                        name="category" 
                        value="{{ old('category', $news->category) }}" 
                        required 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <div>
                    <label for="author" class="block text-xs font-bold text-slate-700 mb-1">
                        Penulis / Sumber Berita
                    </label>
                    <input 
                        type="text" 
                        id="author" 
                        name="author" 
                        value="{{ old('author', $news->author) }}" 
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <div>
                    <label for="published_at" class="block text-xs font-bold text-slate-700 mb-1">
                        Tanggal Publikasi <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="published_at" 
                        name="published_at" 
                        value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d') : date('Y-m-d')) }}" 
                        required
                        class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                    >
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-xs font-bold text-slate-700 mb-1">
                    Ringkasan Cuplikan (Excerpt) <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="excerpt" 
                    name="excerpt" 
                    rows="2" 
                    required 
                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                >{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-xs font-bold text-slate-700 mb-1">
                    Isi Lengkap Berita (Opsional)
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="6" 
                    class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500"
                >{{ old('content', $news->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Ganti Foto Sampul</label>
                    @if($news->image_url)
                        <div class="mb-2 w-32 h-20 rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                            <img src="{{ $news->image_url }}" alt="Sampul Lama" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                </div>

                <div>
                    <label for="image_url_fallback" class="block text-xs font-bold text-slate-700 mb-1">Atau Perbarui URL Gambar</label>
                    <input type="url" id="image_url_fallback" name="image_url_fallback" value="{{ old('image_url_fallback', $news->image_url) }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex items-center">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }} class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500">
                    <span class="text-xs font-bold text-slate-800">Status tayang di website publik</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.news.index') }}" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-brand-600 hover:bg-brand-700 text-white shadow-md shadow-brand-500/20 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection
