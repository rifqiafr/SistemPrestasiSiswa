<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Category;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $operatorUser;

    protected User $studentUser;

    protected Student $student;

    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->operatorUser = User::create([
            'name' => 'Kurniawan Pratama, S.Kom',
            'email' => 'operator@prestasi.sch.id',
            'password' => Hash::make('operator123'),
            'role' => 'operator',
        ]);

        $this->studentUser = User::create([
            'name' => 'Ahmad Siswa',
            'email' => 'ahmad@siswa.prestasi.sch.id',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        $this->student = Student::create([
            'user_id' => $this->studentUser->id,
            'nisn' => '0091122334',
            'full_name' => 'Ahmad Siswa',
            'class_grade' => 'X MIPA 1',
            'cohort_year' => 2026,
            'gender' => 'L',
        ]);

        $this->category = Category::create([
            'name' => 'Sains & Robotika',
            'slug' => 'sains-robotika',
            'is_active' => true,
        ]);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_student_cannot_access_operator_dashboard(): void
    {
        $response = $this->actingAs($this->studentUser)->get(route('admin.dashboard'));
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error');
    }

    public function test_operator_can_access_dashboard_and_views(): void
    {
        $response = $this->actingAs($this->operatorUser)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard Operator');
        $response->assertSee('Kurniawan Pratama');
    }

    public function test_operator_can_view_achievements_list(): void
    {
        $achievement = Achievement::create([
            'title' => 'Juara 1 Lomba Coding Nasional',
            'slug' => 'juara-1-lomba-coding-nasional-101',
            'category_id' => $this->category->id,
            'rank_grade' => 'Juara 1',
            'competition_level' => 'Nasional',
            'organizer' => 'Universitas Indonesia',
            'event_date' => '2026-08-10',
            'status' => 'published',
            'created_by' => $this->operatorUser->id,
        ]);
        $achievement->participants()->attach($this->student->id);

        $response = $this->actingAs($this->operatorUser)->get(route('admin.achievement.index'));
        $response->assertStatus(200);
        $response->assertSee('Juara 1 Lomba Coding Nasional');
        $response->assertSee('Ahmad Siswa');
    }

    public function test_operator_can_toggle_achievement_status(): void
    {
        $achievement = Achievement::create([
            'title' => 'Proposal Riset Siswa Draft',
            'slug' => 'proposal-riset-draft-102',
            'category_id' => $this->category->id,
            'rank_grade' => 'Lolos Tahap 1',
            'competition_level' => 'Provinsi',
            'organizer' => 'Dinas Pendidikan',
            'event_date' => '2026-09-01',
            'status' => 'draft',
            'created_by' => $this->studentUser->id,
        ]);

        $response = $this->actingAs($this->operatorUser)
            ->patch(route('admin.achievement.toggle-status', $achievement->id));

        $response->assertRedirect();
        $this->assertEquals('published', $achievement->fresh()->status);
    }

    public function test_operator_can_store_new_achievement(): void
    {
        $payload = [
            'title' => 'Medali Perunggu OSN Astronomi 2026',
            'category_id' => $this->category->id,
            'rank_grade' => 'Medali Perunggu',
            'competition_level' => 'Nasional',
            'organizer' => 'Puspresnas',
            'event_date' => '2026-08-15',
            'mentor_name' => 'Dra. Nurhayati',
            'description' => 'Berhasil menyelesaikan tes astronomi komputasional.',
            'status' => 'published',
            'is_featured' => '1',
            'student_ids' => [$this->student->id],
        ];

        $response = $this->actingAs($this->operatorUser)
            ->post(route('admin.achievement.store'), $payload);

        $response->assertRedirect(route('admin.achievement.index'));
        $this->assertDatabaseHas('achievements', [
            'title' => 'Medali Perunggu OSN Astronomi 2026',
            'status' => 'published',
            'is_featured' => true,
        ]);
    }

    public function test_operator_can_access_student_directory_and_category_pages(): void
    {
        $resStudent = $this->actingAs($this->operatorUser)->get(route('admin.student.index'));
        $resStudent->assertStatus(200);
        $resStudent->assertSee('Ahmad Siswa');

        $resCat = $this->actingAs($this->operatorUser)->get(route('admin.category.index'));
        $resCat->assertStatus(200);
        $resCat->assertSee('Sains & Robotika');

        $resReport = $this->actingAs($this->operatorUser)->get(route('admin.report.index'));
        $resReport->assertStatus(200);
        $resReport->assertSee('BUKTI DOKUMEN REKAPITULASI PRESTASI SISWA');
    }

    public function test_operator_can_view_and_update_school_profile(): void
    {
        $response = $this->actingAs($this->operatorUser)->get(route('admin.profile.index'));
        $response->assertStatus(200);
        $response->assertSee('Profil & Visi Misi');

        $updateResponse = $this->actingAs($this->operatorUser)->post(route('admin.profile.update'), [
            'settings' => [
                'school_name' => 'SMA Negeri Unggulan 1 Garuda',
                'vision' => 'Menjadi pusat keunggulan sains global.',
                'mission' => "1. Menumbuhkan integritas riset.\n2. Mengembangkan karakter juara.",
                'headmaster_name' => 'Dr. H. Bambang Sudarsono, M.Pd.',
            ],
        ]);

        $updateResponse->assertRedirect(route('admin.profile.index'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('settings', [
            'key' => 'school_name',
            'value' => 'SMA Negeri Unggulan 1 Garuda',
        ]);
        $this->assertDatabaseHas('settings', [
            'key' => 'vision',
            'value' => 'Menjadi pusat keunggulan sains global.',
        ]);
    }

    public function test_operator_can_manage_news(): void
    {
        $indexRes = $this->actingAs($this->operatorUser)->get(route('admin.news.index'));
        $indexRes->assertStatus(200);

        $storeRes = $this->actingAs($this->operatorUser)->post(route('admin.news.store'), [
            'title' => 'Siswa Raih Juara Kompetisi Sains Internasional',
            'category' => 'Prestasi',
            'content' => 'Prestasi membanggakan kembali diukir delegasi sekolah di tingkat internasional.',
            'author' => 'Tim Humas',
            'is_published' => '1',
        ]);

        $storeRes->assertRedirect(route('admin.news.index'));
        $this->assertDatabaseHas('news', [
            'title' => 'Siswa Raih Juara Kompetisi Sains Internasional',
            'category' => 'Prestasi',
            'is_published' => true,
        ]);
    }

    public function test_operator_can_manage_announcements(): void
    {
        $indexRes = $this->actingAs($this->operatorUser)->get(route('admin.announcement.index'));
        $indexRes->assertStatus(200);

        $storeRes = $this->actingAs($this->operatorUser)->post(route('admin.announcement.store'), [
            'title' => 'Pendaftaran Seleksi Calon Peserta Olimpiade Sains 2026',
            'category' => 'Kesiswaan',
            'badge' => 'Penting',
            'description' => 'Seluruh siswa kelas X dan XI dipersilakan mendaftar secara daring.',
            'is_active' => '1',
        ]);

        $storeRes->assertRedirect(route('admin.announcement.index'));
        $this->assertDatabaseHas('announcements', [
            'title' => 'Pendaftaran Seleksi Calon Peserta Olimpiade Sains 2026',
            'badge' => 'Penting',
        ]);
    }

    public function test_operator_can_manage_academic_agendas(): void
    {
        $indexRes = $this->actingAs($this->operatorUser)->get(route('admin.agenda.index'));
        $indexRes->assertStatus(200);

        $storeRes = $this->actingAs($this->operatorUser)->post(route('admin.agenda.store'), [
            'title' => 'Simulasi Akbar Try Out OSN Tingkat Provinsi',
            'event_date' => '2026-10-15',
            'time' => '08.00 - 14.00 WIB',
            'location' => 'Laboratorium Komputer',
            'status' => 'Mendatang',
            'is_active' => '1',
        ]);

        $storeRes->assertRedirect(route('admin.agenda.index'));
        $this->assertDatabaseHas('academic_agendas', [
            'title' => 'Simulasi Akbar Try Out OSN Tingkat Provinsi',
            'location' => 'Laboratorium Komputer',
        ]);
    }

    public function test_operator_can_manage_facilities(): void
    {
        $indexRes = $this->actingAs($this->operatorUser)->get(route('admin.facility.index'));
        $indexRes->assertStatus(200);

        $storeRes = $this->actingAs($this->operatorUser)->post(route('admin.facility.store'), [
            'name' => 'Studio Robotika dan IoT Eksperimental',
            'category' => 'laboratorium',
            'category_label' => 'Laboratorium Sains',
            'description' => 'Fasilitas pembuatan mikrokontroler dan drone cerdas.',
            'image_url_fallback' => 'https://images.unsplash.com/photo-1581093458791-9f3c3900df4b',
            'is_active' => '1',
        ]);

        $storeRes->assertRedirect(route('admin.facility.index'));
        $this->assertDatabaseHas('facilities', [
            'name' => 'Studio Robotika dan IoT Eksperimental',
            'category' => 'laboratorium',
        ]);
    }
}
