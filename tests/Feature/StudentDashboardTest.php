<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $studentUser;

    protected Student $student;

    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->studentUser = User::create([
            'name' => 'Sarah Azzahra',
            'email' => 'sarah@siswa.prestasi.sch.id',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        $this->student = Student::create([
            'user_id' => $this->studentUser->id,
            'nisn' => '0071283910',
            'full_name' => 'Sarah Azzahra',
            'class_grade' => 'XII MIPA 1',
            'cohort_year' => 2026,
            'gender' => 'P',
        ]);

        $this->category = Category::create([
            'name' => 'Akademik',
            'slug' => 'akademik',
            'is_active' => true,
        ]);
    }

    public function test_guest_is_redirected_from_student_dashboard(): void
    {
        $response = $this->get(route('student.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_student_can_login_using_nisn_and_redirects_to_dashboard(): void
    {
        $response = $this->post(route('login.attempt'), [
            'login' => '0071283910',
            'password' => 'siswa123',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($this->studentUser);
    }

    public function test_student_can_login_using_email(): void
    {
        $response = $this->post(route('login.attempt'), [
            'login' => 'sarah@siswa.prestasi.sch.id',
            'password' => 'siswa123',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($this->studentUser);
    }

    public function test_student_dashboard_renders_successfully(): void
    {
        $response = $this->actingAs($this->studentUser)->get(route('student.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Sarah Azzahra');
        $response->assertSee('0071283910');
        $response->assertSee('XII MIPA 1');
        $response->assertSee('+ Input Prestasi Baru');
    }

    public function test_student_can_submit_new_achievement(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->studentUser)->post(route('student.achievement.store'), [
            'title' => 'Juara 1 Lomba Biologi Tingkat Provinsi 2026',
            'category_id' => $this->category->id,
            'rank_grade' => 'Juara 1',
            'competition_level' => 'Provinsi',
            'organizer' => 'Dinas Pendidikan Jawa Barat',
            'event_date' => '2026-06-15',
            'mentor_name' => 'Dr. Hendra Wijaya',
            'description' => 'Kompetisi olimpiade biologi terapan tingkat provinsi.',
            'photo' => UploadedFile::fake()->create('trophy.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('achievements', [
            'title' => 'Juara 1 Lomba Biologi Tingkat Provinsi 2026',
            'rank_grade' => 'Juara 1',
            'competition_level' => 'Provinsi',
            'status' => 'draft',
            'created_by' => $this->studentUser->id,
        ]);
    }

    public function test_student_registration_works(): void
    {
        $response = $this->post(route('register.attempt'), [
            'nisn' => '0099887766',
            'name' => 'Budi Santoso',
            'email' => 'budi@siswa.prestasi.sch.id',
            'class_grade' => 'X-2',
            'cohort_year' => 2026,
            'gender' => 'L',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertDatabaseHas('users', ['email' => 'budi@siswa.prestasi.sch.id', 'role' => 'siswa']);
        $this->assertDatabaseHas('students', ['nisn' => '0099887766', 'full_name' => 'Budi Santoso']);
    }
}
