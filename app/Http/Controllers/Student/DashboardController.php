<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\AchievementMedia;
use App\Models\Category;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Get or ensure the student profile for current authenticated user.
     */
    protected function getCurrentStudent(): Student
    {
        $user = Auth::user();

        if ($user->student) {
            return $user->student;
        }

        // If user doesn't have an attached student record yet, find by name or create
        $student = Student::where('full_name', $user->name)->first();

        if (! $student) {
            $student = Student::create([
                'user_id' => $user->id,
                'nisn' => 'NISN-'.str_pad((string) $user->id, 8, '0', STR_PAD_LEFT),
                'full_name' => $user->name,
                'class_grade' => 'X MIPA 1',
                'cohort_year' => (int) date('Y'),
                'gender' => 'L',
            ]);
        } else {
            $student->update(['user_id' => $user->id]);
        }

        return $student;
    }

    /**
     * Display student dashboard with statistics and achievement records.
     */
    public function index(Request $request): View
    {
        $student = $this->getCurrentStudent();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        // 1. Statistics
        $totalAchievements = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->count();

        $publishedCount = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->where('status', 'published')->count();

        $draftCount = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->where('status', 'draft')->count();

        $internasionalCount = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->where('competition_level', 'Internasional')->count();

        $nasionalCount = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->where('competition_level', 'Nasional')->count();

        // 2. Query Achievements
        $query = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->with(['category', 'coverMedia', 'media', 'participants']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%")
                    ->orWhere('rank_grade', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category_id', $request->input('category'));
        }

        $achievements = $query->orderBy('event_date', 'desc')->paginate(10)->withQueryString();

        return view('student.dashboard', compact(
            'student',
            'categories',
            'totalAchievements',
            'publishedCount',
            'draftCount',
            'internasionalCount',
            'nasionalCount',
            'achievements'
        ));
    }

    /**
     * Show form to create new achievement.
     */
    public function create(): View
    {
        $student = $this->getCurrentStudent();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $otherStudents = Student::where('id', '!=', $student->id)->orderBy('full_name')->get();

        return view('student.create-achievement', compact('student', 'categories', 'otherStudents'));
    }

    /**
     * Store new student achievement.
     */
    public function store(Request $request): RedirectResponse
    {
        $student = $this->getCurrentStudent();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'rank_grade' => ['required', 'string', 'max:100'],
            'competition_level' => ['required', 'in:Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional'],
            'organizer' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:10240'],
            'teammate_ids' => ['nullable', 'array'],
            'teammate_ids.*' => ['exists:students,id'],
        ], [
            'title.required' => 'Judul prestasi / kejuaraan wajib diisi.',
            'category_id.required' => 'Kategori bidang wajib dipilih.',
            'rank_grade.required' => 'Peringkat atau capaian kejuaraan wajib diisi.',
            'competition_level.required' => 'Tingkat kompetisi wajib dipilih.',
            'organizer.required' => 'Nama instansi/penyelenggara wajib diisi.',
            'event_date.required' => 'Tanggal perolehan atau kompetisi wajib diisi.',
            'photo.image' => 'File foto dokumentasi harus berupa gambar (JPG, PNG, WebP).',
            'photo.max' => 'Ukuran foto maksimal 5 MB.',
            'certificate.max' => 'Ukuran file sertifikat maksimal 10 MB.',
        ]);

        // Generate clean unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug.'-'.Str::random(6);

        $achievement = Achievement::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'rank_grade' => $validated['rank_grade'],
            'competition_level' => $validated['competition_level'],
            'organizer' => $validated['organizer'],
            'event_date' => $validated['event_date'],
            'mentor_name' => $validated['mentor_name'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_featured' => false,
            'status' => 'draft', // Submitted by student, awaits operator verification
            'created_by' => Auth::id(),
        ]);

        // Attach student
        $participants = [$student->id];
        if (! empty($validated['teammate_ids'])) {
            $participants = array_unique(array_merge($participants, $validated['teammate_ids']));
        }
        $achievement->participants()->sync($participants);

        // Upload photo
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('achievements/photos', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$photoPath),
                'file_type' => 'photo',
                'is_cover' => true,
            ]);
        }

        // Upload certificate
        if ($request->hasFile('certificate')) {
            $certFile = $request->file('certificate');
            $certPath = $certFile->store('achievements/certificates', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$certPath),
                'file_type' => 'certificate',
                'is_cover' => ! $request->hasFile('photo'),
            ]);
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Prestasi "'.$achievement->title.'" berhasil diajukan! Data tersimpan dengan status Menunggu Verifikasi Kesiswaan.');
    }

    /**
     * Show single achievement details for student.
     */
    public function show(int $id): View
    {
        $student = $this->getCurrentStudent();

        $achievement = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->with(['category', 'media', 'participants', 'creator'])->findOrFail($id);

        return view('student.show-achievement', compact('student', 'achievement'));
    }

    /**
     * Show form to edit draft achievement.
     */
    public function edit(int $id): View|RedirectResponse
    {
        $student = $this->getCurrentStudent();

        $achievement = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->with(['category', 'media', 'participants'])->findOrFail($id);

        if ($achievement->status === 'published') {
            return redirect()->route('student.dashboard')
                ->with('error', 'Prestasi yang sudah terverifikasi & terbit tidak dapat diubah langsung. Hubungi tim kesiswaan jika terdapat pembaruan data.');
        }

        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $otherStudents = Student::where('id', '!=', $student->id)->orderBy('full_name')->get();

        return view('student.edit-achievement', compact('student', 'achievement', 'categories', 'otherStudents'));
    }

    /**
     * Update draft achievement.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $student = $this->getCurrentStudent();

        $achievement = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->findOrFail($id);

        if ($achievement->status === 'published') {
            return redirect()->route('student.dashboard')
                ->with('error', 'Prestasi yang sudah terbit tidak dapat diubah.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'rank_grade' => ['required', 'string', 'max:100'],
            'competition_level' => ['required', 'in:Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional'],
            'organizer' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:10240'],
            'teammate_ids' => ['nullable', 'array'],
            'teammate_ids.*' => ['exists:students,id'],
        ]);

        $achievement->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'rank_grade' => $validated['rank_grade'],
            'competition_level' => $validated['competition_level'],
            'organizer' => $validated['organizer'],
            'event_date' => $validated['event_date'],
            'mentor_name' => $validated['mentor_name'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        $participants = [$student->id];
        if (! empty($validated['teammate_ids'])) {
            $participants = array_unique(array_merge($participants, $validated['teammate_ids']));
        }
        $achievement->participants()->sync($participants);

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('achievements/photos', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$photoPath),
                'file_type' => 'photo',
                'is_cover' => true,
            ]);
        }

        if ($request->hasFile('certificate')) {
            $certFile = $request->file('certificate');
            $certPath = $certFile->store('achievements/certificates', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$certPath),
                'file_type' => 'certificate',
                'is_cover' => false,
            ]);
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Data prestasi "'.$achievement->title.'" berhasil diperbarui.');
    }

    /**
     * Delete a draft achievement.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = $this->getCurrentStudent();

        $achievement = Achievement::whereHas('participants', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->findOrFail($id);

        if ($achievement->status === 'published') {
            return redirect()->route('student.dashboard')
                ->with('error', 'Prestasi yang sudah terbit tidak dapat dihapus oleh siswa. Hubungi tim kesiswaan.');
        }

        $title = $achievement->title;
        $achievement->delete();

        return redirect()->route('student.dashboard')
            ->with('success', 'Pengajuan prestasi "'.$title.'" telah dihapus.');
    }
}
