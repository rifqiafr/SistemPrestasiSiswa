@extends('admin.layout')

@section('title', 'Manajemen Agenda Akademik')
@section('page_title', 'Agenda Akademik')
@section('page_heading', 'Kelola Kalender & Jadwal Kegiatan Sekolah')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Jadwal & Agenda Kegiatan</h2>
            <p class="text-xs text-slate-500">Kelola timeline seleksi kompetisi, pembinaan rutin, ujian prestasi, dan kegiatan penting sekolah.</p>
        </div>
        <button 
            type="button" 
            onclick="openCreateAgendaModal()" 
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm self-start sm:self-auto cursor-pointer"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Agenda Baru</span>
        </button>
    </div>

    <!-- Agenda Table -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Tanggal Pelaksanaan</th>
                        <th class="py-3.5 px-4">Nama Agenda Kegiatan</th>
                        <th class="py-3.5 px-4">Waktu & Tempat</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center">Publikasi</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($agendas as $index => $agenda)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-mono">
                                {{ $agendas->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <div class="w-10 h-10 rounded-xl bg-brand-50 border border-brand-100 flex flex-col items-center justify-center text-brand-700">
                                        <span class="text-sm font-extrabold leading-none font-display">{{ $agenda->event_date->format('d') }}</span>
                                        <span class="text-[9px] uppercase font-bold tracking-tight">{{ $agenda->event_date->format('M') }}</span>
                                    </div>
                                    <div class="text-xs font-semibold text-slate-700">
                                        {{ $agenda->event_date->format('Y') }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900 text-xs sm:text-sm">
                                    {{ $agenda->title }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-xs">
                                <div class="text-slate-800 font-medium flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $agenda->time }}</span>
                                </div>
                                <div class="text-slate-500 mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $agenda->location }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $agenda->status === 'Mendatang' ? 'bg-indigo-100 text-indigo-800' : ($agenda->status === 'Berlangsung' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600') }}">
                                    {{ $agenda->status }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($agenda->is_active)
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
                                        onclick="openEditAgendaModal({{ json_encode($agenda) }})" 
                                        title="Edit Agenda" 
                                        class="p-1.5 text-slate-500 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda kegiatan ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Agenda" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
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
                            <td colspan="7" class="py-12 text-center text-slate-500 text-xs">
                                Belum ada agenda kalender akademik. Klik "Tambah Agenda Baru" untuk menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($agendas->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Create / Edit Agenda -->
<div id="agendaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 id="agendaModalTitle" class="text-base font-extrabold font-display text-slate-900">
                Tambah Agenda Akademik
            </h3>
            <button type="button" onclick="closeAgendaModal()" class="p-1 text-slate-400 hover:text-slate-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="agendaForm" action="{{ route('admin.agenda.store') }}" method="POST" class="p-5 space-y-4 text-xs">
            @csrf
            <div id="agendaMethodSpoof"></div>

            <div>
                <label for="agenda_title" class="block font-bold text-slate-700 mb-1">
                    Nama Agenda / Kegiatan <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="agenda_title" 
                    name="title" 
                    required 
                    placeholder="Contoh: Seleksi Internal Olimpiade Sains Nasional (OSN)" 
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="agenda_event_date" class="block font-bold text-slate-700 mb-1">
                        Tanggal Kegiatan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="agenda_event_date" 
                        name="event_date" 
                        required 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 bg-white"
                    >
                </div>

                <div>
                    <label for="agenda_time" class="block font-bold text-slate-700 mb-1">
                        Waktu Kegiatan <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="agenda_time" 
                        name="time" 
                        required 
                        placeholder="Contoh: 08.00 - 15.00 WIB" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="agenda_location" class="block font-bold text-slate-700 mb-1">
                        Lokasi / Ruang <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="agenda_location" 
                        name="location" 
                        required 
                        placeholder="Contoh: Aula Graha Prestasi" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                    >
                </div>

                <div>
                    <label for="agenda_status" class="block font-bold text-slate-700 mb-1">
                        Status Agenda <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        id="agenda_status" 
                        name="status" 
                        required 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 bg-white"
                    >
                        <option value="Mendatang">Mendatang</option>
                        <option value="Berlangsung">Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="agenda_is_active" 
                        name="is_active" 
                        value="1" 
                        checked 
                        class="w-4 h-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500"
                    >
                    <span class="text-xs font-semibold text-slate-700">Tampilkan ke Kalender Landing Page</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button 
                    type="button" 
                    onclick="closeAgendaModal()" 
                    class="px-4 py-2.5 rounded-xl border border-slate-200 font-bold text-slate-600 hover:bg-slate-50 transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 rounded-xl font-bold text-white bg-brand-600 hover:bg-brand-700 transition-colors shadow-sm"
                >
                    Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateAgendaModal() {
    const modal = document.getElementById('agendaModal');
    const form = document.getElementById('agendaForm');
    const title = document.getElementById('agendaModalTitle');
    const methodSpoof = document.getElementById('agendaMethodSpoof');

    form.action = "{{ route('admin.agenda.store') }}";
    methodSpoof.innerHTML = '';
    title.innerText = 'Tambah Agenda Akademik Baru';
    
    document.getElementById('agenda_title').value = '';
    document.getElementById('agenda_event_date').value = '';
    document.getElementById('agenda_time').value = '08.00 - 15.00 WIB';
    document.getElementById('agenda_location').value = '';
    document.getElementById('agenda_status').value = 'Mendatang';
    document.getElementById('agenda_is_active').checked = true;

    modal.classList.remove('hidden');
}

function openEditAgendaModal(data) {
    const modal = document.getElementById('agendaModal');
    const form = document.getElementById('agendaForm');
    const title = document.getElementById('agendaModalTitle');
    const methodSpoof = document.getElementById('agendaMethodSpoof');

    form.action = `/admin/agenda/${data.id}`;
    methodSpoof.innerHTML = '<input type="hidden" name="_method" value="PUT">';
    title.innerText = 'Edit Agenda Akademik';

    document.getElementById('agenda_title').value = data.title;
    // Format date string YYYY-MM-DD
    const dateVal = data.event_date ? data.event_date.substring(0, 10) : '';
    document.getElementById('agenda_event_date').value = dateVal;
    document.getElementById('agenda_time').value = data.time;
    document.getElementById('agenda_location').value = data.location;
    document.getElementById('agenda_status').value = data.status;
    document.getElementById('agenda_is_active').checked = !!data.is_active;

    modal.classList.remove('hidden');
}

function closeAgendaModal() {
    document.getElementById('agendaModal').classList.add('hidden');
}
</script>
@endsection
