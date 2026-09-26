<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page with real-time stats, Hall of Fame, and directory.
     */
    public function index(Request $request)
    {
        // 1. Statistics Counters (Only Published)
        $totalPublished = Achievement::published()->count();
        $totalInternasional = Achievement::published()->where('competition_level', 'Internasional')->count();
        $totalNasional = Achievement::published()->where('competition_level', 'Nasional')->count();
        $totalProvinsi = Achievement::published()->where('competition_level', 'Provinsi')->count();
        $totalKota = Achievement::published()->whereIn('competition_level', ['Kabupaten/Kota', 'Kota', 'Kabupaten'])->count();

        // 2. Hall of Fame (Featured / Pinned achievements: 3 - 6 items)
        $hallOfFame = Achievement::published()
            ->featured()
            ->with(['category', 'participants', 'coverMedia', 'media'])
            ->orderBy('event_date', 'desc')
            ->take(6)
            ->get();

        // 3. Categories for Filter Bar
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        // 4. Available Years for Filter
        $availableYears = Achievement::published()
            ->selectRaw('DISTINCT strftime("%Y", event_date) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        // 5. Query for Directory
        $query = Achievement::published()->with(['category', 'participants', 'coverMedia', 'media']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%")
                    ->orWhere('rank_grade', 'like', "%{$search}%")
                    ->orWhereHas('participants', function ($sq) use ($search) {
                        $sq->where('full_name', 'like', "%{$search}%")
                            ->orWhere('nisn', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('level') && $request->input('level') !== 'all') {
            $query->where('competition_level', $request->input('level'));
        }

        if ($request->filled('year') && $request->input('year') !== 'all') {
            $query->whereRaw('strftime("%Y", event_date) = ?', [$request->input('year')]);
        }

        $achievements = $query->orderBy('event_date', 'desc')->get();

        // 6. Structured Content for School Profile, News, Announcements & Facilities
        $newsItems = [
            [
                'id' => 1,
                'title' => 'Siswa SMA Negeri Unggulan Raih Prestasi Gemilang di Ajang Olimpiade Sains Internasional',
                'category' => 'Prestasi & Riset',
                'date' => '24 September 2026',
                'excerpt' => 'Delegasi siswa SMA Negeri Unggulan kembali mengukir tinta emas dengan membawa pulang medali perak pada kompetisi biologi internasional tingkat dunia.',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
                'author' => 'Tim Humas & Kesiswaan',
            ],
            [
                'id' => 2,
                'title' => 'Kunjungan Edukasi dan Riset Kolaboratif Siswa ke Laboratorium Nano-Teknologi BRIN',
                'category' => 'Kegiatan Akademik',
                'date' => '18 September 2026',
                'excerpt' => 'Puluhan peneliti muda sekolah berkesempatan mendalami teknik karakterisasi material terbarukan bersama para peneliti senior nasional.',
                'image' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?auto=format&fit=crop&w=800&q=80',
                'author' => 'Koordinator Riset Sekolah',
            ],
            [
                'id' => 3,
                'title' => 'Gelar Karya P5 dan Expo Talenta Siswa 2026: Menampilkan 45 Produk Inovasi Mandiri',
                'category' => 'Pengembangan Karakter',
                'date' => '10 September 2026',
                'excerpt' => 'Ajang tahunan unjuk kreativitas siswa yang memadukan kearifan lokal, teknologi tepat guna, dan kewirausahaan generasi muda.',
                'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                'author' => 'Panitia P5 Sekolah',
            ],
        ];

        $announcements = [
            [
                'id' => 1,
                'title' => 'Verifikasi Berkas Calon Peserta Didik Baru (PPDB) Jalur Prestasi Khusus Tahun Ajaran 2027/2028',
                'category' => 'Informasi PPDB',
                'date' => '25 September 2026',
                'badge' => 'Penting',
                'description' => 'Bagi calon siswa pendaftar jalur prestasi kejuaraan akademik maupun non-akademik, verifikasi fisik sertifikat asli dilaksanakan di Gedung Serbaguna sekolah pukul 08.00 - 14.00 WIB.',
            ],
            [
                'id' => 2,
                'title' => 'Jadwal Pemusatan Latihan dan Pembinaan Intensif Menuju OSN Tingkat Provinsi Jawa Barat',
                'category' => 'Akademik',
                'date' => '20 September 2026',
                'badge' => 'Pembinaan',
                'description' => 'Seluruh siswa peraih medali tingkat kota/kabupaten diwajibkan mengikuti pelatihan intensif bersama tim dosen pembina perguruan tinggi mitra setiap hari Sabtu.',
            ],
            [
                'id' => 3,
                'title' => 'Sosialisasi Beasiswa Perguruan Tinggi Negeri dan Peluang Studi Lanjut ke Luar Negeri',
                'category' => 'Bimbingan Konseling',
                'date' => '15 September 2026',
                'badge' => 'Sosialisasi',
                'description' => 'Webinar interaktif bersama alumni dan perwakilan universitas mitra bagi siswa kelas XII beserta orang tua murid melalui tautan Zoom resmi sekolah.',
            ],
        ];

        $academicAgendas = [
            [
                'day' => '05',
                'month' => 'OKT',
                'year' => '2026',
                'title' => 'Penilaian Tengah Semester (PTS) Ganjil Tahun Ajaran 2026/2027',
                'time' => '07.30 - 13.00 WIB',
                'location' => 'Seluruh Ruang Kelas & Laboratorium CBT',
                'status' => 'Mendatang',
            ],
            [
                'day' => '18',
                'month' => 'OKT',
                'year' => '2026',
                'title' => 'Simulasi & Tryout Akbar OSN Tingkat Provinsi',
                'time' => '08.00 - 15.00 WIB',
                'location' => 'Laboratorium Komputer & Sains Terpadu',
                'status' => 'Mendatang',
            ],
            [
                'day' => '28',
                'month' => 'OKT',
                'year' => '2026',
                'title' => 'Peringatan Hari Sumpah Pemuda & Festival Budaya Nusantara',
                'time' => '07.00 - 14.30 WIB',
                'location' => 'Plaza Upacara & Amphitheater Sekolah',
                'status' => 'Mendatang',
            ],
            [
                'day' => '12',
                'month' => 'NOV',
                'year' => '2026',
                'title' => 'Pameran Karya Ilmiah Remaja & Robotika Tingkat Wilayah',
                'time' => '08.30 - 16.00 WIB',
                'location' => 'Auditorium Utama SMA Unggulan',
                'status' => 'Mendatang',
            ],
        ];

        $facilities = [
            [
                'name' => 'Laboratorium Sains Terpadu & Bioteknologi',
                'category' => 'laboratorium',
                'category_label' => 'Laboratorium & Riset',
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                'description' => 'Dilengkapi mikroskop digital resolusi tinggi, spektrofotometer, laminar air flow, dan peralatan uji biokimia modern untuk riset sains siswa.',
            ],
            [
                'name' => 'Laboratorium Komputer & AI Coding Studio',
                'category' => 'komputer',
                'category_label' => 'Teknologi & IT',
                'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=800&q=80',
                'description' => '80 unit PC workstation performa tinggi dengan jaringan serat optik gigabit untuk pembelajaran informatika, simulasi riset, dan ujian CBT.',
            ],
            [
                'name' => 'Perpustakaan Digital & Learning Commons',
                'category' => 'perpustakaan',
                'category_label' => 'Perpustakaan & Literasi',
                'image' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80',
                'description' => 'Koleksi 25.000+ eksemplar buku, repositori karya ilmiah siswa, akses jurnal ilmiah nasional/internasional, dan ruang diskusi terpadu.',
            ],
            [
                'name' => 'Gelanggang Olahraga Indoor & Lapangan Atletik',
                'category' => 'olahraga',
                'category_label' => 'Olahraga & Seni',
                'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80',
                'description' => 'Fasilitas lapangan basket berstandar nasional, lapangan bulutangkis vinyl indoor, lintasan lari tartan, dan pusat kebugaran siswa.',
            ],
            [
                'name' => 'Studio Musik & Ruang Apresiasi Budaya',
                'category' => 'seni',
                'category_label' => 'Olahraga & Seni',
                'image' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?auto=format&fit=crop&w=800&q=80',
                'description' => 'Studio akustik kedap suara dengan instrumen musik modern dan alat musik tradisional nusantara untuk pembinaan FLS2N dan seni kreasi.',
            ],
            [
                'name' => 'Auditorium Serbaguna Graha Cendekia',
                'category' => 'lingkungan',
                'category_label' => 'Lingkungan & Publik',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80',
                'description' => 'Gedung pertemuan berkapasitas 1.200 kursi dengan tata panggung audio-visual profesional untuk wisuda, seminar, dan perhelatan akbar sekolah.',
            ],
        ];

        // Return JSON if requested via AJAX/Fetch
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'achievements' => $achievements,
                'count' => $achievements->count(),
            ]);
        }

        return view('landing', compact(
            'totalPublished',
            'totalInternasional',
            'totalNasional',
            'totalProvinsi',
            'totalKota',
            'hallOfFame',
            'categories',
            'availableYears',
            'achievements',
            'newsItems',
            'announcements',
            'academicAgendas',
            'facilities'
        ));
    }

    /**
     * Display single achievement detail (with OpenGraph meta tags).
     */
    public function show($slug)
    {
        $achievement = Achievement::published()
            ->where('slug', $slug)
            ->with(['category', 'participants', 'media', 'creator'])
            ->firstOrFail();

        return view('prestasi-detail', compact('achievement'));
    }
}
