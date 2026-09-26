@extends('admin.layout')

@section('title', 'Direktori Siswa')
@section('page_title', 'Direktori Siswa')
@section('page_heading', 'Manajemen Data Siswa Berprestasi')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Info -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-extrabold font-display text-slate-900">Direktori Siswa</h2>
            <p class="text-xs text-slate-500">Kelola basis data siswa dan pantau portofolio prestasi setiap peserta didik.</p>
        </div>

        <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-brand-600 hover:bg-brand-700 text-white shadow-md shadow-brand-500/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            <span>Daftarkan Siswa Baru</span>
        </button>
    </div>

    <!-- Stats Mini Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-medium">Total Siswa Terdaftar</span>
                <div class="text-2xl font-black font-display text-slate-900 mt-1">{{ $totalStudents }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold">
                👥
            </div>
        </div>

        <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-medium">Siswa Meraih Prestasi</span>
                <div class="text-2xl font-black font-display text-brand-600 mt-1">{{ $activeStudentsWithAwards }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                🏆
            </div>
        </div>

        <div class="p-4 rounded-xl bg-white border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-400 font-medium">Tingkat Partisipasi</span>
                <div class="text-2xl font-black font-display text-emerald-600 mt-1">
                    {{ $totalStudents > 0 ? round(($activeStudentsWithAwards / $totalStudents) * 100) : 0 }}%
                </div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                📈
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="rounded-2xl bg-white border border-slate-200 p-4 shadow-xs">
        <form action="{{ route('admin.student.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari berdasarkan nama siswa atau NISN..." 
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500"
                >
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <div class="flex items-center gap-2">
                <select name="class_grade" class="w-full py-2 px-3 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="all">Semua Rombel / Kelas</option>
                    @foreach($classGrades as $cls)
                        <option value="{{ $cls }}" {{ request('class_grade') === $cls ? 'selected' : '' }}>{{ $cls }}</option>
                    @endforeach
                </select>

                <button type="submit" class="py-2 px-4 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Students Table -->
    <div class="rounded-2xl bg-white border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">No</th>
                        <th class="py-3.5 px-4">Nama Siswa</th>
                        <th class="py-3.5 px-4">NISN</th>
                        <th class="py-3.5 px-4">Kelas & Angkatan</th>
                        <th class="py-3.5 px-4">Jenis Kelamin</th>
                        <th class="py-3.5 px-4 text-center">Total Raihan Prestasi</th>
                        <th class="py-3.5 px-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($students as $index => $std)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 text-center text-xs text-slate-400 font-mono">
                                {{ $students->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-900">{{ $std->full_name }}</div>
                                <div class="text-[11px] text-slate-400">
                                    {{ $std->user ? 'Akun login aktif' : 'Belum buat akun login' }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-xs font-mono font-medium text-slate-700">
                                {{ $std->nisn }}
                            </td>
                            <td class="py-3.5 px-4 text-xs">
                                <span class="font-semibold text-slate-800 block">{{ $std->class_grade }}</span>
                                <span class="text-[11px] text-slate-400">Angkatan {{ $std->cohort_year }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-600">
                                {{ $std->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $std->achievements_count > 0 ? 'bg-brand-50 text-brand-700 border border-brand-200/60' : 'bg-slate-100 text-slate-400' }}">
                                    <span>{{ $std->achievements_count }}</span>
                                    <span class="text-[10px] font-normal">Prestasi</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button 
                                        type="button" 
                                        onclick="editStudent({{ json_encode($std) }})"
                                        class="p-1.5 text-slate-400 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors"
                                        title="Edit Siswa"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>

                                    <form action="{{ route('admin.student.destroy', $std->id) }}" method="POST" onsubmit="return confirm('Hapus siswa {{ addslashes($std->full_name) }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Siswa" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
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
                            <td colspan="7" class="py-12 text-center text-slate-400 text-xs">
                                Tidak ada data siswa yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div class="p-4 border-t border-slate-200 bg-slate-50/50">
                {{ $students->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Tambah Siswa -->
<div id="modalTambahSiswa" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-bold text-slate-900">Tambah Siswa Baru</h3>
            <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.student.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">NISN Siswa <span class="text-rose-500">*</span></label>
                <input type="text" name="nisn" required placeholder="10 digit nomor NISN" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Siswa <span class="text-rose-500">*</span></label>
                <input type="text" name="full_name" required placeholder="Nama lengkap sesuai data Dapodik" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kelas / Rombel <span class="text-rose-500">*</span></label>
                    <input type="text" name="class_grade" required placeholder="Contoh: XII MIPA 1" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tahun Angkatan <span class="text-rose-500">*</span></label>
                    <input type="number" name="cohort_year" required value="2026" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Jenis Kelamin <span class="text-rose-500">*</span></label>
                <select name="gender" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    <option value="L">Laki-laki (L)</option>
                    <option value="P">Perempuan (P)</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Alamat Email (Opsional)</label>
                <input type="email" name="email" placeholder="siswa@sekolah.sch.id (otomatis buat akun login jika diisi)" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')" class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 font-bold">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-white bg-brand-600 hover:bg-brand-700 font-bold shadow-md shadow-brand-500/20">
                    Simpan Siswa
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div id="modalEditSiswa" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-base font-bold text-slate-900">Perbarui Data Siswa</h3>
            <button type="button" onclick="document.getElementById('modalEditSiswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="formEditSiswa" method="POST" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-bold text-slate-700 mb-1">NISN Siswa <span class="text-rose-500">*</span></label>
                <input type="text" id="edit_nisn" name="nisn" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Siswa <span class="text-rose-500">*</span></label>
                <input type="text" id="edit_full_name" name="full_name" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kelas / Rombel <span class="text-rose-500">*</span></label>
                    <input type="text" id="edit_class_grade" name="class_grade" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tahun Angkatan <span class="text-rose-500">*</span></label>
                    <input type="number" id="edit_cohort_year" name="cohort_year" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Jenis Kelamin <span class="text-rose-500">*</span></label>
                <select id="edit_gender" name="gender" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-brand-500">
                    <option value="L">Laki-laki (L)</option>
                    <option value="P">Perempuan (P)</option>
                </select>
            </div>

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modalEditSiswa').classList.add('hidden')" class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 font-bold">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-white bg-brand-600 hover:bg-brand-700 font-bold shadow-md shadow-brand-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function editStudent(std) {
        document.getElementById('formEditSiswa').action = '/admin/siswa/' + std.id;
        document.getElementById('edit_nisn').value = std.nisn;
        document.getElementById('edit_full_name').value = std.full_name;
        document.getElementById('edit_class_grade').value = std.class_grade;
        document.getElementById('edit_cohort_year').value = std.cohort_year;
        document.getElementById('edit_gender').value = std.gender;
        document.getElementById('modalEditSiswa').classList.remove('hidden');
    }
</script>
@endsection
