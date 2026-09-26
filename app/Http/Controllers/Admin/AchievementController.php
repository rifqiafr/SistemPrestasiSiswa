<?php

namespace App\Http\Controllers\Admin;

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

class AchievementController extends Controller
{
    /**
     * Display a listing of achievements with advanced filtering.
     */
    public function index(Request $request): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        // Counts for quick tab filters
        $countAll = Achievement::count();
        $countDraft = Achievement::where('status', 'draft')->count();
        $countPublished = Achievement::where('status', 'published')->count();
        $countFeatured = Achievement::where('is_featured', true)->count();

        $query = Achievement::with(['category', 'coverMedia', 'media', 'participants', 'creator']);

        // 1. Search Query (Title, Organizer, Rank, or Participant Name)
        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%")
                    ->orWhere('rank_grade', 'like', "%{$search}%")
                    ->orWhere('mentor_name', 'like', "%{$search}%")
                    ->orWhereHas('participants', function ($sq) use ($search) {
                        $sq->where('full_name', 'like', "%{$search}%")
                            ->orWhere('nisn', 'like', "%{$search}%");
                    });
            });
        }

        // 2. Status Filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        // 3. Level Filter
        if ($request->filled('level') && $request->input('level') !== 'all') {
            $query->where('competition_level', $request->input('level'));
        }

        // 4. Category Filter
        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category_id', $request->input('category'));
        }

        // 5. Featured Filter
        if ($request->filled('featured') && $request->input('featured') === '1') {
            $query->where('is_featured', true);
        }

        $achievements = $query->orderBy('event_date', 'desc')->paginate(15)->withQueryString();

        return view('admin.achievements.index', compact(
            'achievements',
            'categories',
            'countAll',
            'countDraft',
            'countPublished',
            'countFeatured'
        ));
    }

    /**
     * Show the form for creating a new achievement.
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $students = Student::orderBy('full_name')->get();

        return view('admin.achievements.create', compact('categories', 'students'));
    }

    /**
     * Store a newly created achievement in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'rank_grade' => ['required', 'string', 'max:100'],
            'competition_level' => ['required', 'in:Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional'],
            'organizer' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published'],
            'student_ids' => ['required', 'array', 'min:1'],
            'student_ids.*' => ['exists:students,id'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,webp,pdf', 'max:10240'],
        ], [
            'title.required' => 'Judul prestasi / nama kejuaraan wajib diisi.',
            'category_id.required' => 'Silakan pilih bidang kategori prestasi.',
            'rank_grade.required' => 'Peringkat atau capaian (e.g. Juara 1, Medali Emas) wajib diisi.',
            'competition_level.required' => 'Tingkat kompetisi wajib dipilih.',
            'organizer.required' => 'Nama instansi penyelenggara wajib diisi.',
            'event_date.required' => 'Tanggal perolehan atau kompetisi wajib diisi.',
            'student_ids.required' => 'Wajib memilih minimal satu siswa peserta berprestasi.',
            'photo.image' => 'File foto dokumentasi harus berupa gambar.',
            'photo.max' => 'Ukuran foto dokumentasi maksimal 5 MB.',
            'certificate.max' => 'Ukuran file sertifikat maksimal 10 MB.',
        ]);

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
            'is_featured' => $request->boolean('is_featured'),
            'status' => $validated['status'],
            'created_by' => Auth::id(),
        ]);

        $achievement->participants()->sync($validated['student_ids']);

        // Upload Photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('achievements/photos', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$photoPath),
                'file_type' => 'photo',
                'is_cover' => true,
            ]);
        }

        // Upload Certificate
        if ($request->hasFile('certificate')) {
            $certPath = $request->file('certificate')->store('achievements/certificates', 'public');
            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$certPath),
                'file_type' => 'certificate',
                'is_cover' => ! $request->hasFile('photo'),
            ]);
        }

        return redirect()->route('admin.achievement.index')
            ->with('success', 'Prestasi "'.$achievement->title.'" berhasil ditambahkan dengan status: '.strtoupper($achievement->status).'!');
    }

    /**
     * Display the specified achievement details.
     */
    public function show(int $id): View
    {
        $achievement = Achievement::with(['category', 'media', 'participants', 'creator'])->findOrFail($id);

        return view('admin.achievements.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified achievement.
     */
    public function edit(int $id): View
    {
        $achievement = Achievement::with(['category', 'media', 'participants'])->findOrFail($id);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $students = Student::orderBy('full_name')->get();

        return view('admin.achievements.edit', compact('achievement', 'categories', 'students'));
    }

    /**
     * Update the specified achievement in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'rank_grade' => ['required', 'string', 'max:100'],
            'competition_level' => ['required', 'in:Sekolah,Kabupaten/Kota,Provinsi,Nasional,Internasional'],
            'organizer' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'mentor_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published'],
            'student_ids' => ['required', 'array', 'min:1'],
            'student_ids.*' => ['exists:students,id'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'certificate' => ['nullable', 'file', 'mimes:jpeg,png,jpg,webp,pdf', 'max:10240'],
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
            'is_featured' => $request->boolean('is_featured'),
            'status' => $validated['status'],
        ]);

        $achievement->participants()->sync($validated['student_ids']);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('achievements/photos', 'public');

            // Remove existing photo if any
            $achievement->media()->where('file_type', 'photo')->delete();

            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$photoPath),
                'file_type' => 'photo',
                'is_cover' => true,
            ]);
        }

        if ($request->hasFile('certificate')) {
            $certPath = $request->file('certificate')->store('achievements/certificates', 'public');

            // Remove existing certificate if any
            $achievement->media()->where('file_type', 'certificate')->delete();

            AchievementMedia::create([
                'achievement_id' => $achievement->id,
                'file_url' => asset('storage/'.$certPath),
                'file_type' => 'certificate',
                'is_cover' => ! $achievement->media()->where('file_type', 'photo')->exists(),
            ]);
        }

        return redirect()->route('admin.achievement.index')
            ->with('success', 'Data prestasi "'.$achievement->title.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified achievement from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $achievement = Achievement::findOrFail($id);
        $title = $achievement->title;
        $achievement->delete();

        return redirect()->route('admin.achievement.index')
            ->with('success', 'Prestasi "'.$title.'" berhasil dihapus dari sistem.');
    }

    /**
     * Toggle status between draft and published.
     */
    public function toggleStatus(int $id): RedirectResponse
    {
        $achievement = Achievement::findOrFail($id);
        $newStatus = $achievement->status === 'published' ? 'draft' : 'published';
        $achievement->update(['status' => $newStatus]);

        $statusText = $newStatus === 'published' ? 'Terverifikasi & Diterbitkan ke Website Publik' : 'Diubah menjadi Draf (Menunggu Verifikasi)';

        return back()->with('success', 'Status prestasi "'.$achievement->title.'" berhasil diubah: '.$statusText.'.');
    }

    /**
     * Toggle featured (Hall of Fame) flag.
     */
    public function toggleFeatured(int $id): RedirectResponse
    {
        $achievement = Achievement::findOrFail($id);
        $newFeatured = ! $achievement->is_featured;
        $achievement->update(['is_featured' => $newFeatured]);

        $featuredText = $newFeatured ? 'Ditampilkan di Sorotan Hall of Fame' : 'Dihapus dari Sorotan Hall of Fame';

        return back()->with('success', 'Status sorotan prestasi "'.$achievement->title.'" berhasil diubah: '.$featuredText.'.');
    }
}
