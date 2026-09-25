<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\AchievementMedia;
use App\Models\Category;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::create([
            'name' => 'Drs. H. Mulyadi, M.Pd (Kepala Sekolah)',
            'email' => 'admin@prestasi.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
            'last_login_at' => now(),
        ]);

        $operator = User::create([
            'name' => 'Kurniawan Pratama, S.Kom (Staf Kesiswaan)',
            'email' => 'kesiswaan@prestasi.sch.id',
            'password' => Hash::make('operator123'),
            'role' => 'operator',
            'last_login_at' => now()->subHours(2),
        ]);

        // 2. Categories
        $catAkademik = Category::create(['name' => 'Akademik', 'slug' => 'akademik', 'is_active' => true]);
        $catOlahraga = Category::create(['name' => 'Olahraga', 'slug' => 'olahraga', 'is_active' => true]);
        $catSeni = Category::create(['name' => 'Seni', 'slug' => 'seni', 'is_active' => true]);
        $catRiset = Category::create(['name' => 'Riset', 'slug' => 'riset', 'is_active' => true]);

        // 3. Students & Student User Accounts
        $studentData = [
            's1' => ['nisn' => '0071283910', 'full_name' => 'Sarah Azzahra', 'email' => 'sarah@siswa.prestasi.sch.id', 'class_grade' => 'XII MIPA 1', 'cohort_year' => 2026, 'gender' => 'P'],
            's2' => ['nisn' => '0082910291', 'full_name' => 'Muhammad Rizky Pratama', 'email' => 'rizky@siswa.prestasi.sch.id', 'class_grade' => 'XII MIPA 1', 'cohort_year' => 2026, 'gender' => 'L'],
            's3' => ['nisn' => '0082910294', 'full_name' => 'Annisa Putri Ramadhani', 'email' => 'annisa@siswa.prestasi.sch.id', 'class_grade' => 'XII MIPA 1', 'cohort_year' => 2026, 'gender' => 'P'],
            's4' => ['nisn' => '0081729384', 'full_name' => 'Farhan Kevin Sanjaya', 'email' => 'farhan@siswa.prestasi.sch.id', 'class_grade' => 'XI IPS 2', 'cohort_year' => 2027, 'gender' => 'L'],
            's5' => ['nisn' => '0091827364', 'full_name' => 'Nabila Syakira', 'email' => 'nabila@siswa.prestasi.sch.id', 'class_grade' => 'XI MIPA 3', 'cohort_year' => 2027, 'gender' => 'P'],
            's6' => ['nisn' => '0092837461', 'full_name' => 'Dimas Arya Pamungkas', 'email' => 'dimas@siswa.prestasi.sch.id', 'class_grade' => 'X-1', 'cohort_year' => 2028, 'gender' => 'L'],
            's7' => ['nisn' => '0083948572', 'full_name' => 'Clara Stefani Putri', 'email' => 'clara@siswa.prestasi.sch.id', 'class_grade' => 'XII MIPA 2', 'cohort_year' => 2026, 'gender' => 'P'],
            's8' => ['nisn' => '0073849102', 'full_name' => 'Rafi Ahmad Fauzan', 'email' => 'rafi@siswa.prestasi.sch.id', 'class_grade' => 'XI MIPA 2', 'cohort_year' => 2027, 'gender' => 'L'],
        ];

        $students = [];
        foreach ($studentData as $key => $data) {
            $studentUser = User::create([
                'name' => $data['full_name'],
                'email' => $data['email'],
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'last_login_at' => now()->subDays(1),
            ]);

            $students[$key] = Student::create([
                'user_id' => $studentUser->id,
                'nisn' => $data['nisn'],
                'full_name' => $data['full_name'],
                'class_grade' => $data['class_grade'],
                'cohort_year' => $data['cohort_year'],
                'gender' => $data['gender'],
            ]);
        }

        // 4. Achievements Data
        $items = [
            [
                'title' => 'Medali Perak International Biology Olympiad (IBO) 2026',
                'category_id' => $catAkademik->id,
                'rank_grade' => 'Medali Perak (Silver Medal)',
                'competition_level' => 'Internasional',
                'organizer' => 'IBO International Committee & UNESCO',
                'event_date' => '2026-07-14',
                'mentor_name' => 'Dr. Hendra Wijaya, M.Biotech',
                'description' => 'Kompetisi biologi tingkat dunia yang diikuti oleh 80 negara peserta di Astana, Kazakhstan. Siswa berhasil meraih medali perak pada kategori Praktikum Genetika Molekuler dan Ujian Teori Fisiologi Tumbuhan.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s1']->id],
                'photo' => 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Gold Medal World Young Inventor Exhibition (WYIE) 2026',
                'category_id' => $catRiset->id,
                'rank_grade' => 'Gold Medal & Special Award',
                'competition_level' => 'Internasional',
                'organizer' => 'MINDS (Malaysian Invention and Design Society)',
                'event_date' => '2026-05-22',
                'mentor_name' => 'Dra. Sri Wahyuni, M.Pd',
                'description' => 'Inovasi alat filtrasi air berbasis limbah tempurung kelapa dan nanopartikel kitosan terbukti mampu menjernihkan limbah mikroplastik skala rumah tangga secara hemat energi.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s2']->id, $students['s3']->id],
                'photo' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara 1 Lomba Karya Ilmiah Remaja (LKIR) Nasional 2026',
                'category_id' => $catRiset->id,
                'rank_grade' => 'Juara 1 Nasional (Medali Emas)',
                'competition_level' => 'Nasional',
                'organizer' => 'Badan Riset dan Inovasi Nasional (BRIN) & Kemdikbudristek',
                'event_date' => '2026-08-18',
                'mentor_name' => 'Drs. Bambang Suryono, M.Pd',
                'description' => 'Penelitian komparatif mengenai pemanfaatan mikroalga Spirulina sebagai bio-indikator pencemaran air sungai perkotaan yang berhasil memukau dewan juri ahli BRIN.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s2']->id, $students['s3']->id],
                'photo' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Medali Emas Olimpiade Sains Nasional (OSN) Fisika 2026',
                'category_id' => $catAkademik->id,
                'rank_grade' => 'Medali Emas (Peringkat 1 Nasional)',
                'competition_level' => 'Nasional',
                'organizer' => 'Pusat Prestasi Nasional (Puspresnas)',
                'event_date' => '2026-06-11',
                'mentor_name' => 'Agus Santoso, M.Sc',
                'description' => 'Menyelesaikan 5 paket soal teori mekanika kuantum dan eksperimen optik dengan perolehan skor akumulatif tertinggi se-Indonesia dari 150 finalis provinsi.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s7']->id],
                'photo' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara 1 FLS2N Menyanyi Solo Vokal Nasional 2026',
                'category_id' => $catSeni->id,
                'rank_grade' => 'Juara 1 Nasional',
                'competition_level' => 'Nasional',
                'organizer' => 'Balai Pengembangan Talenta Indonesia (BPTI)',
                'event_date' => '2026-08-25',
                'mentor_name' => 'Dewi Anggraeni, S.Sn',
                'description' => 'Membawakan lagu daerah dengan aransemen etnik kontemporer serta lagu pop kreasi baru yang memikat dewan juri vokal nasional di Jakarta.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s5']->id],
                'photo' => 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Medali Emas POPDA Bulutangkis Tunggal Putra 2026',
                'category_id' => $catOlahraga->id,
                'rank_grade' => 'Medali Emas',
                'competition_level' => 'Provinsi',
                'organizer' => 'Dinas Pemuda dan Olahraga Provinsi Jawa Barat',
                'event_date' => '2026-07-28',
                'mentor_name' => 'Budi Setiawan, S.Pd',
                'description' => 'Menang straight game di babak final dengan skor 21-16 dan 21-14 setelah menumbangkan 32 peserta dari 27 kontingen kabupaten/kota.',
                'is_featured' => true,
                'status' => 'published',
                'students' => [$students['s4']->id],
                'photo' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara Umum National English Debate Championship (NEDC) 2025',
                'category_id' => $catAkademik->id,
                'rank_grade' => 'Juara 1 & Best Speaker',
                'competition_level' => 'Nasional',
                'organizer' => 'Universitas Indonesia English Debating Society',
                'event_date' => '2025-11-15',
                'mentor_name' => 'Patricia Lumenta, M.Hum',
                'description' => 'Mendominasi 7 babak preliminary rounds dan menyabet penghargaan The Best Overall Speaker dengan motion ekonomi hijau dan transisi energi global.',
                'is_featured' => false,
                'status' => 'published',
                'students' => [$students['s8']->id, $students['s1']->id],
                'photo' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara 1 Festival Band Pelajar Hardiknas Provinsi 2025',
                'category_id' => $catSeni->id,
                'rank_grade' => 'Juara 1 Provinsi',
                'competition_level' => 'Provinsi',
                'organizer' => 'Dinas Pendidikan Jawa Barat',
                'event_date' => '2025-05-02',
                'mentor_name' => 'Eka Putra, S.Pd.Mus',
                'description' => 'Grup musik SMA Unggulan menampilkan harmonisasi lagu wajib nasional dan aransemen funk fusion original ciptaan para siswa.',
                'is_featured' => false,
                'status' => 'published',
                'students' => [$students['s4']->id, $students['s6']->id],
                'photo' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Medali Perak O2SN Renang Gaya Dada 100m Putra 2025',
                'category_id' => $catOlahraga->id,
                'rank_grade' => 'Medali Perak',
                'competition_level' => 'Provinsi',
                'organizer' => 'BPTI & Disdik Jabar',
                'event_date' => '2025-09-08',
                'mentor_name' => 'Yayan Ruhian, S.Pd',
                'description' => 'Mencatatkan rekor waktu 1 menit 04 detik pada babak final nomor 100m gaya dada putra di Gelanggang Renang UPI Bandung.',
                'is_featured' => false,
                'status' => 'published',
                'students' => [$students['s6']->id],
                'photo' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara 1 Lomba Robotik Line Follower Microcontroller 2025',
                'category_id' => $catRiset->id,
                'rank_grade' => 'Juara 1 & Best Design',
                'competition_level' => 'Provinsi',
                'organizer' => 'Himpunan Mahasiswa Elektro ITB',
                'event_date' => '2025-10-20',
                'mentor_name' => 'Kurniawan Pratama, S.Kom',
                'description' => 'Robot otonom rakitan ekstrakurikuler robotik berhasil menaklukkan sirkuit berliku dengan kecepatan rata-rata 3.2 meter per detik tanpa keluar lintasan.',
                'is_featured' => false,
                'status' => 'published',
                'students' => [$students['s8']->id, $students['s2']->id],
                'photo' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1607344645866-009c320c5ab8?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Juara 1 Lomba Cipta & Baca Puisi Tingkat Kota 2025',
                'category_id' => $catSeni->id,
                'rank_grade' => 'Juara 1 Kota',
                'competition_level' => 'Kabupaten/Kota',
                'organizer' => 'Dewan Kesenian Kota',
                'event_date' => '2025-04-18',
                'mentor_name' => 'Siti Aminah, M.Pd',
                'description' => 'Membacakan puisi karya orisinil bertajuk "Lembayung Khatulistiwa" dengan vokal artikulatif dan penjiwaan panggung yang mendalam.',
                'is_featured' => false,
                'status' => 'published',
                'students' => [$students['s5']->id],
                'photo' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Draft: Seleksi Calon Peserta Olimpiade Astronomi 2026',
                'category_id' => $catAkademik->id,
                'rank_grade' => 'Lolos Tahap 1',
                'competition_level' => 'Sekolah',
                'organizer' => 'Tim Pembina Olimpiade Sekolah',
                'event_date' => '2026-09-01',
                'mentor_name' => 'Agus Santoso, M.Sc',
                'description' => 'Arsip internal seleksi awal penjaringan bibit unggul astronomi untuk dipersiapkan menuju OSN tingkat kabupaten tahun mendatang.',
                'is_featured' => false,
                'status' => 'draft', // Draft internal
                'students' => [$students['s7']->id],
                'photo' => 'https://images.unsplash.com/photo-1506703719100-a0f3a48c0f86?auto=format&fit=crop&w=1200&q=80',
                'certificate' => 'https://images.unsplash.com/photo-1589330694653-ded6df03f754?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($items as $item) {
            $ach = Achievement::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']).'-'.rand(100, 999),
                'category_id' => $item['category_id'],
                'rank_grade' => $item['rank_grade'],
                'competition_level' => $item['competition_level'],
                'organizer' => $item['organizer'],
                'event_date' => $item['event_date'],
                'description' => $item['description'],
                'mentor_name' => $item['mentor_name'],
                'is_featured' => $item['is_featured'],
                'status' => $item['status'],
                'created_by' => $admin->id,
            ]);

            $ach->participants()->attach($item['students']);

            AchievementMedia::create([
                'achievement_id' => $ach->id,
                'file_url' => $item['photo'],
                'file_type' => 'photo',
                'is_cover' => true,
            ]);

            AchievementMedia::create([
                'achievement_id' => $ach->id,
                'file_url' => $item['certificate'],
                'file_type' => 'certificate',
                'is_cover' => false,
            ]);
        }
    }
}
