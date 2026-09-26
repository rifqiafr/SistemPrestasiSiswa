<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Settings Table (For School Profile, Vision, Mission, Hero, Contacts)
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        // 2. News Table (Berita Kegiatan)
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Kegiatan Sekolah');
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_published')->default(true);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });

        // 3. Announcements Table (Pengumuman Resmi)
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Informasi PPDB');
            $table->string('badge')->default('Penting');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Academic Agendas Table (Kalender Akademik)
        Schema::create('academic_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('event_date');
            $table->string('time')->default('07.30 - 13.00 WIB');
            $table->string('location')->default('Auditorium / Ruang Kelas');
            $table->string('status')->default('Mendatang');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Facilities Table (Galeri Fasilitas Sekolah)
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('laboratorium');
            $table->string('category_label')->default('Laboratorium & Riset');
            $table->string('image_url');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed Initial Default Data
        $now = now();

        // 1. Initial Settings Data
        $initialSettings = [
            'school_name' => 'SMA NEGERI UNGGULAN',
            'school_tagline' => 'Portal Profil Resmi & Pusat Prestasi Siswa Berdaya Saing Global',
            'school_subtagline' => 'Mewujudkan ekosistem pendidikan berkarakter, unggul dalam sains, teknologi, seni, dan kepemimpinan berwawasan global.',
            'school_npsn' => '20104567',
            'school_accreditation' => 'A (Unggul 98.4)',
            'school_ptn_rate' => '92% Siswa Diterima PTN Favorit',
            'hero_cta_text' => 'Jelajahi Arsip Prestasi',
            'hero_cta_url' => '#direktori',
            'hero_contact_text' => 'Informasi PPDB 2026',
            'hero_contact_url' => '#kontak-ppdb',

            // Sambutan Kepala Sekolah
            'headmaster_name' => 'Drs. H. Mulyadi, M.Pd',
            'headmaster_title' => 'Kepala SMA Negeri Unggulan',
            'headmaster_nip' => '19680815 199403 1 004',
            'headmaster_photo' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=800&q=80',
            'headmaster_quote_title' => 'Membangun Karakter Luhur, Menempa Prestasi Dunia',
            'headmaster_quote' => 'Selamat datang di portal resmi SMA Negeri Unggulan. Kami meyakini bahwa setiap anak memiliki potensi istimewa yang patut dihargai dan difasilitasi. Melalui kurikulum terintegrasi, sarana riset mutakhir, serta pembinaan kompetisi intensif, kami berkomitmen mencetak generasi pembelajar sepanjang hayat yang unggul di panggung nasional maupun global.',

            // Visi & Misi
            'vision' => 'Menjadi pusat keunggulan pendidikan yang menghasilkan lulusan bertakwa, berkarakter luhur, berwawasan lingkungan, serta berdaya saing internasional.',
            'mission_1' => 'Menyelenggarakan proses pembelajaran berkualitas berbasis riset, sains mutakhir, dan teknologi digital terapan.',
            'mission_2' => 'Mengembangkan bakat, minat, dan potensi kepemimpinan siswa melalui pembinaan intensif pada bidang akademik dan non-akademik.',
            'mission_3' => 'Mewujudkan lingkungan sekolah yang asri, berbudaya mutu tinggi, aman, ramah anak, dan peduli kelestarian alam.',
            'mission_4' => 'Membangun kemitraan strategis dengan perguruan tinggi terkemuka, lembaga riset nasional, dan institusi pendidikan global.',

            // Sejarah & Tenaga Pendidik
            'history_summary' => 'Berdiri sejak tahun 1985, SMA Negeri Unggulan telah membina lebih dari 35 angkatan alumni yang kini berkiprah sebagai akademisi, profesional industri, pejabat publik, dan pengusaha di berbagai belahan dunia.',
            'faculty_summary' => 'Didukung oleh 68 tenaga pendidik profesional berkualifikasi magister (S2) dan doktoral (S3), bersertifikasi pendidik nasional serta aktif sebagai pembina olimpiade sains.',

            // Kontak & PPDB
            'contact_address' => 'Jl. Pendidikan Unggulan No. 45, Kompleks Prestasi Pelajar',
            'contact_city' => 'Jawa Barat, Indonesia (Kode Pos: 40123)',
            'contact_phone' => '(021) 7890-1234 / (021) 7890-5678',
            'contact_whatsapp' => '+62 812-3456-7890',
            'contact_email' => 'info@prestasi.sch.id / kesiswaan@prestasi.sch.id',
            'contact_hours' => 'Senin - Jumat: 07.00 - 16.00 WIB | Sabtu: 08.00 - 13.00 WIB',
            'ppdb_info_title' => 'Penerimaan Peserta Didik Baru (PPDB) 2027/2028',
            'ppdb_info_desc' => 'Pendaftaran jalur prestasi kejuaraan akademik dan non-akademik bebas biaya seleksi dengan kuota beasiswa pendidikan penuh bagi peraih medali tingkat nasional/internasional.',
            'ppdb_url' => 'https://ppdb.jabarprov.go.id',
        ];

        foreach ($initialSettings as $key => $val) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $val,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 2. Initial News Data
        $initialNews = [
            [
                'title' => 'Siswa SMA Negeri Unggulan Raih Prestasi Gemilang di Ajang Olimpiade Sains Internasional',
                'slug' => Str::slug('Siswa SMA Negeri Unggulan Raih Prestasi Gemilang di Ajang Olimpiade Sains Internasional'),
                'category' => 'Prestasi & Riset',
                'excerpt' => 'Delegasi siswa SMA Negeri Unggulan kembali mengukir tinta emas dengan membawa pulang medali perak pada kompetisi biologi internasional tingkat dunia di Kazakhstan.',
                'content' => 'Prestasi membanggakan kembali dipersembahkan oleh siswa-siswi SMA Negeri Unggulan di kancah internasional. Sarah Azzahra, siswi kelas XII MIPA 1, berhasil menyabet Medali Perak pada ajang International Biology Olympiad (IBO) 2026 yang berlangsung di Astana, Kazakhstan. Didampingi oleh tim guru pembina olimpiade, Sarah berhasil menyelesaikan serangkaian ujian praktikum bioteknologi molekuler dan teori biologi sel yang ketat melawan 80 negara perwakilan sedunia.',
                'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
                'author' => 'Tim Humas & Kesiswaan',
                'is_published' => true,
                'published_at' => '2026-09-24',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Kunjungan Edukasi dan Riset Kolaboratif Siswa ke Laboratorium Nano-Teknologi BRIN',
                'slug' => Str::slug('Kunjungan Edukasi dan Riset Kolaboratif Siswa ke Laboratorium Nano-Teknologi BRIN'),
                'category' => 'Kegiatan Akademik',
                'excerpt' => 'Puluhan peneliti muda sekolah berkesempatan mendalami teknik karakterisasi material terbarukan bersama para peneliti senior Badan Riset dan Inovasi Nasional.',
                'content' => 'Dalam rangka penguatan kurikulum berbasis riset, sebanyak 40 siswa kelas XI mengikuti kunjungan studi laboratorium ke Pusat Riset Fotonik dan Nanoteknologi BRIN. Siswa diajak mempraktikkan langsung preparasi material karbon dan nanopartikel untuk aplikasi penjernihan air ramah lingkungan.',
                'image_url' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?auto=format&fit=crop&w=800&q=80',
                'author' => 'Koordinator Riset Sekolah',
                'is_published' => true,
                'published_at' => '2026-09-18',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Gelar Karya P5 dan Expo Talenta Siswa 2026: Menampilkan 45 Produk Inovasi Mandiri',
                'slug' => Str::slug('Gelar Karya P5 dan Expo Talenta Siswa 2026 Menampilkan 45 Produk Inovasi Mandiri'),
                'category' => 'Pengembangan Karakter',
                'excerpt' => 'Ajang tahunan unjuk kreativitas siswa yang memadukan kearifan lokal, teknologi tepat guna, dan kewirausahaan generasi muda.',
                'content' => 'Gedung Graha Cendekia dipadati ratusan pengunjung yang antusias menyaksikan Pameran Inovasi dan Gelar Karya P5. Sebanyak 45 stan siswa menampilkan kreasi robotika ramah lingkungan, produk kuliner sehat berbasis pangan lokal, serta pertunjukan seni nusantara.',
                'image_url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                'author' => 'Panitia P5 Sekolah',
                'is_published' => true,
                'published_at' => '2026-09-10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('news')->insert($initialNews);

        // 3. Initial Announcements
        $initialAnnouncements = [
            [
                'title' => 'Verifikasi Berkas Calon Peserta Didik Baru (PPDB) Jalur Prestasi Khusus Tahun Ajaran 2027/2028',
                'category' => 'Informasi PPDB',
                'badge' => 'Penting',
                'description' => 'Bagi calon siswa pendaftar jalur prestasi kejuaraan akademik maupun non-akademik, verifikasi fisik sertifikat asli dilaksanakan di Gedung Serbaguna sekolah pukul 08.00 - 14.00 WIB.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Jadwal Pemusatan Latihan dan Pembinaan Intensif Menuju OSN Tingkat Provinsi Jawa Barat',
                'category' => 'Akademik',
                'badge' => 'Pembinaan',
                'description' => 'Seluruh siswa peraih medali tingkat kota/kabupaten diwajibkan mengikuti pelatihan intensif bersama tim dosen pembina perguruan tinggi mitra setiap hari Sabtu.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Sosialisasi Beasiswa Perguruan Tinggi Negeri dan Peluang Studi Lanjut ke Luar Negeri',
                'category' => 'Bimbingan Konseling',
                'badge' => 'Sosialisasi',
                'description' => 'Webinar interaktif bersama alumni dan perwakilan universitas mitra bagi siswa kelas XII beserta orang tua murid melalui tautan Zoom resmi sekolah.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('announcements')->insert($initialAnnouncements);

        // 4. Initial Academic Agendas
        $initialAgendas = [
            [
                'title' => 'Penilaian Tengah Semester (PTS) Ganjil Tahun Ajaran 2026/2027',
                'event_date' => '2026-10-05',
                'time' => '07.30 - 13.00 WIB',
                'location' => 'Seluruh Ruang Kelas & Laboratorium CBT',
                'status' => 'Mendatang',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Simulasi & Tryout Akbar OSN Tingkat Provinsi',
                'event_date' => '2026-10-18',
                'time' => '08.00 - 15.00 WIB',
                'location' => 'Laboratorium Komputer & Sains Terpadu',
                'status' => 'Mendatang',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Peringatan Hari Sumpah Pemuda & Festival Budaya Nusantara',
                'event_date' => '2026-10-28',
                'time' => '07.00 - 14.30 WIB',
                'location' => 'Plaza Upacara & Amphitheater Sekolah',
                'status' => 'Mendatang',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pameran Karya Ilmiah Remaja & Robotika Tingkat Wilayah',
                'event_date' => '2026-11-12',
                'time' => '08.30 - 16.00 WIB',
                'location' => 'Auditorium Utama SMA Unggulan',
                'status' => 'Mendatang',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('academic_agendas')->insert($initialAgendas);

        // 5. Initial Facilities Data
        $initialFacilities = [
            [
                'name' => 'Laboratorium Sains Terpadu & Bioteknologi',
                'category' => 'laboratorium',
                'category_label' => 'Laboratorium & Riset',
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                'description' => 'Dilengkapi mikroskop digital resolusi tinggi, spektrofotometer, laminar air flow, dan peralatan uji biokimia modern untuk riset sains siswa.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Laboratorium Komputer & AI Coding Studio',
                'category' => 'komputer',
                'category_label' => 'Teknologi & IT',
                'image_url' => 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=800&q=80',
                'description' => '80 unit PC workstation performa tinggi dengan jaringan serat optik gigabit untuk pembelajaran informatika, simulasi riset, dan ujian CBT.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Perpustakaan Digital & Learning Commons',
                'category' => 'perpustakaan',
                'category_label' => 'Perpustakaan & Literasi',
                'image_url' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=800&q=80',
                'description' => 'Koleksi 25.000+ eksemplar buku, repositori karya ilmiah siswa, akses jurnal ilmiah nasional/internasional, dan ruang diskusi terpadu.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Gelanggang Olahraga Indoor & Lapangan Atletik',
                'category' => 'olahraga',
                'category_label' => 'Olahraga & Seni',
                'image_url' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=800&q=80',
                'description' => 'Fasilitas lapangan basket berstandar nasional, lapangan bulutangkis vinyl indoor, lintasan lari tartan, dan pusat kebugaran siswa.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Studio Musik & Ruang Apresiasi Budaya',
                'category' => 'seni',
                'category_label' => 'Olahraga & Seni',
                'image_url' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?auto=format&fit=crop&w=800&q=80',
                'description' => 'Studio akustik kedap suara dengan instrumen musik modern dan alat musik tradisional nusantara untuk pembinaan FLS2N dan seni kreasi.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Auditorium Serbaguna Graha Cendekia',
                'category' => 'lingkungan',
                'category_label' => 'Lingkungan & Publik',
                'image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80',
                'description' => 'Gedung pertemuan berkapasitas 1.200 kursi dengan tata panggung audio-visual profesional untuk wisuda, seminar, dan perhelatan akbar sekolah.',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('facilities')->insert($initialFacilities);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('academic_agendas');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('news');
        Schema::dropIfExists('settings');
    }
};
