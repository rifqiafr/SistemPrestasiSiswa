@extends('admin.layout')

@section('title', 'Manajemen Pengumuman')
@section('page_title', 'Pengumuman Resmi')
@section('page_heading', 'Kelola Pengumuman Resmi Sekolah')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Pengumuman & Edaran Sekolah</h2>
            <p class="text-xs text-slate-500">Kelola informasi resmi, edaran seleksi, pembinaan prestasi, dan sosialisasi untuk siswa dan wali murid.</p>
        </div>
        <button 
            type="button" 
            onclick="openCreateAnnouncementModal()" 
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm self-start sm:self-auto cursor-pointer"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Pengumuman</span>
        </button>
    </div>

    <!-- Announcement Table -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Judul & Isi Pengumuman</th>
                        <th class="py-3.5 px-4">Kategori & Badge</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4">Tanggal Rilis</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($announcements as $index => $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-mono">
                                {{ $announcements->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4 max-w-md">
                                <div class="font-bold text-slate-900 text-xs sm:text-sm">
                                    {{ $item->title }}
                                </div>
                                <p class="text-xs text-slate-500 line-clamp-2 mt-1">
                                    {{ $item->description }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $item->badge === 'Penting' ? 'bg-rose-100 text-rose-800' : ($item->badge === 'Pembinaan' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800') }}">
                                        {{ $item->badge }}
                                    </span>
                                    <div class="text-[11px] text-slate-500 font-medium">
                                        {{ $item->category }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($item->is_active)
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
                            <td class="py-3.5 px-4 whitespace-nowrap text-xs text-slate-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <button 
                                        type="button" 
                                        onclick="openEditAnnouncementModal({{ json_encode($item) }})" 
                                        title="Edit Pengumuman" 
                                        class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.announcement.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Pengumuman" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
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
                                Belum ada pengumuman resmi. Klik "Tambah Pengumuman" untuk membuat baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($announcements->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Create / Edit Pengumuman -->
<div id="announcementModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 id="announcementModalTitle" class="text-base font-extrabold font-display text-slate-900">
                Tambah Pengumuman Baru
            </h3>
            <button type="button" onclick="closeAnnouncementModal()" class="p-1 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="announcementForm" action="{{ route('admin.announcement.store') }}" method="POST" class="p-5 space-y-4 text-xs">
            @csrf
            <div id="methodSpoof"></div>

            <div>
                <label for="announcement_title" class="block font-bold text-slate-700 mb-1">
                    Judul Pengumuman <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="announcement_title" 
                    name="title" 
                    required 
                    placeholder="Contoh: Seleksi Calon Peserta Olimpiade Sains Nasional 2026" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="announcement_category" class="block font-bold text-slate-700 mb-1">
                        Kategori <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="announcement_category" 
                        name="category" 
                        required 
                        placeholder="Contoh: Bimbingan Prestasi / Kesiswaan" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <div>
                    <label for="announcement_badge" class="block font-bold text-slate-700 mb-1">
                        Tingkat Kepentingan (Badge) <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="announcement_badge" 
                        name="badge" 
                        required 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 bg-white"
                    >
                        <option value="Penting">Penting (Merah)</option>
                        <option value="Pembinaan">Pembinaan (Kuning)</option>
                        <option value="Sosialisasi">Sosialisasi (Biru)</option>
                        <option value="Umum">Umum (Abu-abu)</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="announcement_description" class="block font-bold text-slate-700 mb-1">
                    Isi / Ringkasan Pengumuman <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    id="announcement_description" 
                    name="description" 
                    rows="4" 
                    required 
                    placeholder="Tuliskan isi pengumuman atau instruksi tindak lanjut bagi siswa dan wali murid..."
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 leading-relaxed"
                ></textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="announcement_is_active" 
                        name="is_active" 
                        value="1" 
                        checked 
                        class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500"
                    >
                    <span class="text-xs font-semibold text-slate-700">Tampilkan ke Landing Page (Publik)</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button 
                    type="button" 
                    onclick="closeAnnouncementModal()" 
                    class="px-4 py-2.5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    id="announcementSubmitBtn"
                    class="px-5 py-2.5 rounded-xl font-bold text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm"
                >
                    Simpan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateAnnouncementModal() {
    const modal = document.getElementById('announcementModal');
    const form = document.getElementById('announcementForm');
    const title = document.getElementById('announcementModalTitle');
    const methodSpoof = document.getElementById('methodSpoof');

    form.action = "{{ route('admin.announcement.store') }}";
    methodSpoof.innerHTML = '';
    title.innerText = 'Tambah Pengumuman Baru';
    
    document.getElementById('announcement_title').value = '';
    document.getElementById('announcement_category').value = '';
    document.getElementById('announcement_badge').value = 'Penting';
    document.getElementById('announcement_description').value = '';
    document.getElementById('announcement_is_active').checked = true;

    modal.classList.remove('hidden');
}

function openEditAnnouncementModal(data) {
    const modal = document.getElementById('announcementModal');
    const form = document.getElementById('announcementForm');
    const title = document.getElementById('announcementModalTitle');
    const methodSpoof = document.getElementById('methodSpoof');

    form.action = `/admin/pengumuman/${data.id}`;
    methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';
    title.innerText = 'Edit Pengumuman';

    document.getElementById('announcement_title').value = data.title;
    document.getElementById('announcement_category').value = data.category;
    document.getElementById('announcement_badge').value = data.badge;
    document.getElementById('announcement_description').value = data.description;
    document.getElementById('announcement_is_active').checked = !!data.is_active;

    modal.classList.remove('hidden');
}

function closeAnnouncementModal() {
    document.getElementById('announcementModal').classList.add('hidden');
}
</script>
@endsection
