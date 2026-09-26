@extends('admin.layout')

@section('title', 'Manajemen Fasilitas Sekolah')
@section('page_title', 'Fasilitas Sekolah')
@section('page_heading', 'Kelola Galeri & Ruang Sarana Prasarana')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Galeri Fasilitas & Sarpras</h2>
            <p class="text-xs text-slate-500">Kelola foto, nama, kategori, dan deskripsi fasilitas penunjang prestasi yang tampil pada profil landing page.</p>
        </div>
        <button 
            type="button" 
            onclick="openCreateFacilityModal()" 
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm self-start sm:self-auto cursor-pointer"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Fasilitas</span>
        </button>
    </div>

    <!-- Facilities Grid / Table -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4 w-28">Foto</th>
                        <th class="py-3.5 px-4">Nama Sarana & Kategori</th>
                        <th class="py-3.5 px-4">Deskripsi</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($facilities as $index => $facility)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-mono">
                                {{ $facilities->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="w-20 h-14 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 shadow-2xs">
                                    <img 
                                        src="{{ $facility->image }}" 
                                        alt="{{ $facility->name }}" 
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 text-xs sm:text-sm">
                                    {{ $facility->name }}
                                </div>
                                <div class="inline-block mt-1 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">
                                    {{ $facility->category_label }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 max-w-sm text-xs text-slate-500">
                                <p class="line-clamp-2">{{ $facility->description }}</p>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($facility->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Non-Aktif</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        onclick="openEditFacilityModal({{ json_encode($facility) }})" 
                                        title="Edit Fasilitas" 
                                        class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.facility.destroy', $facility->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Fasilitas" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
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
                            <td colspan="6" class="py-12 text-center text-slate-500 text-xs">
                                Belum ada fasilitas terdaftar. Klik "Tambah Fasilitas" untuk memasukkan galeri sarana sekolah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($facilities->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $facilities->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Create / Edit Fasilitas -->
<div id="facilityModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 id="facilityModalTitle" class="text-base font-extrabold font-display text-slate-900">
                Tambah Fasilitas Sekolah
            </h3>
            <button type="button" onclick="closeFacilityModal()" class="p-1 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="facilityForm" action="{{ route('admin.facility.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4 text-xs">
            @csrf
            <div id="facilityMethodSpoof"></div>

            <div>
                <label for="facility_name" class="block font-bold text-slate-700 mb-1">
                    Nama Fasilitas / Ruang <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="facility_name" 
                    name="name" 
                    required 
                    placeholder="Contoh: Laboratorium Komputer AI & Multimedia" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="facility_category" class="block font-bold text-slate-700 mb-1">
                        Kode Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="facility_category" 
                        name="category" 
                        required 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 bg-white"
                        onchange="syncCategoryLabel(this.value)"
                    >
                        <option value="laboratorium">Laboratorium Sains</option>
                        <option value="komputer">Teknologi & IT Lab</option>
                        <option value="perpustakaan">Perpustakaan & Literasi</option>
                        <option value="olahraga">Olahraga & Seni</option>
                        <option value="general">Fasilitas Umum</option>
                    </select>
                </div>

                <div>
                    <label for="facility_category_label" class="block font-bold text-slate-700 mb-1">
                        Label Kategori (Tampil di Web) <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="facility_category_label" 
                        name="category_label" 
                        required 
                        placeholder="Contoh: Laboratorium Riset" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>
            </div>

            <div>
                <label for="facility_description" class="block font-bold text-slate-700 mb-1">
                    Deskripsi Sarana & Spesifikasi <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="facility_description" 
                    name="description" 
                    rows="3" 
                    required 
                    placeholder="Jelaskan fasilitas dan peralatan penunjang yang tersedia..."
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 leading-relaxed"
                ></textarea>
            </div>

            <div class="space-y-3 pt-1 border-t border-slate-100">
                <div>
                    <label for="facility_image" class="block font-bold text-slate-700 mb-1">
                        Unggah Foto Fasilitas (Opsional)
                    </label>
                    <input 
                        type="file" 
                        id="facility_image" 
                        name="image" 
                        accept="image/jpeg,image/png,image/webp" 
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer"
                    >
                    <p class="text-[11px] text-slate-400 mt-1">Maksimal 5MB (Format: JPG, PNG, WEBP).</p>
                </div>

                <div>
                    <label for="facility_image_url_fallback" class="block font-bold text-slate-700 mb-1">
                        Atau URL Foto Eksternal (Unsplash / CDN)
                    </label>
                    <input 
                        type="url" 
                        id="facility_image_url_fallback" 
                        name="image_url_fallback" 
                        placeholder="https://images.unsplash.com/..." 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 font-mono text-xs"
                    >
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="facility_is_active" 
                        name="is_active" 
                        value="1" 
                        checked 
                        class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500"
                    >
                    <span class="text-xs font-semibold text-slate-700">Tampilkan pada Galeri Landing Page</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button 
                    type="button" 
                    onclick="closeFacilityModal()" 
                    class="px-4 py-2.5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 rounded-xl font-bold text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm"
                >
                    Simpan Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function syncCategoryLabel(val) {
    const labels = {
        'laboratorium': 'Laboratorium Sains',
        'komputer': 'Teknologi & IT Lab',
        'perpustakaan': 'Perpustakaan & Literasi',
        'olahraga': 'Olahraga & Seni',
        'general': 'Fasilitas Umum'
    };
    if (labels[val]) {
        document.getElementById('facility_category_label').value = labels[val];
    }
}

function openCreateFacilityModal() {
    const modal = document.getElementById('facilityModal');
    const form = document.getElementById('facilityForm');
    const title = document.getElementById('facilityModalTitle');
    const methodSpoof = document.getElementById('facilityMethodSpoof');

    form.action = "{{ route('admin.facility.store') }}";
    methodSpoof.innerHTML = '';
    title.innerText = 'Tambah Fasilitas Sekolah Baru';
    
    document.getElementById('facility_name').value = '';
    document.getElementById('facility_category').value = 'laboratorium';
    document.getElementById('facility_category_label').value = 'Laboratorium Sains';
    document.getElementById('facility_description').value = '';
    document.getElementById('facility_image_url_fallback').value = '';
    document.getElementById('facility_is_active').checked = true;

    modal.classList.remove('hidden');
}

function openEditFacilityModal(data) {
    const modal = document.getElementById('facilityModal');
    const form = document.getElementById('facilityForm');
    const title = document.getElementById('facilityModalTitle');
    const methodSpoof = document.getElementById('facilityMethodSpoof');

    form.action = `/admin/fasilitas/${data.id}`;
    methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';
    title.innerText = 'Edit Fasilitas Sekolah';

    document.getElementById('facility_name').value = data.name;
    document.getElementById('facility_category').value = data.category;
    document.getElementById('facility_category_label').value = data.category_label;
    document.getElementById('facility_description').value = data.description;
    document.getElementById('facility_image_url_fallback').value = data.image_url || '';
    document.getElementById('facility_is_active').checked = !!data.is_active;

    modal.classList.remove('hidden');
}

function closeFacilityModal() {
    document.getElementById('facilityModal').classList.add('hidden');
}
</script>
@endsection
