<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of students with search and stats.
     */
    public function index(Request $request): View
    {
        $query = Student::withCount('achievements')->with(['achievements.category']);

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('class_grade', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_grade') && $request->input('class_grade') !== 'all') {
            $query->where('class_grade', $request->input('class_grade'));
        }

        $totalStudents = Student::count();
        $activeStudentsWithAwards = Student::has('achievements')->count();
        $classGrades = Student::select('class_grade')->distinct()->orderBy('class_grade')->pluck('class_grade');

        $students = $query->orderBy('full_name')->paginate(15)->withQueryString();

        return view('admin.students.index', compact(
            'students',
            'totalStudents',
            'activeStudentsWithAwards',
            'classGrades'
        ));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn'],
            'full_name' => ['required', 'string', 'max:255'],
            'class_grade' => ['required', 'string', 'max:50'],
            'cohort_year' => ['required', 'integer', 'min:2020', 'max:2035'],
            'gender' => ['required', 'in:L,P'],
            'email' => ['nullable', 'email', 'unique:users,email'],
        ], [
            'nisn.required' => 'NISN siswa wajib diisi.',
            'nisn.unique' => 'NISN ini sudah terdaftar di sistem.',
            'full_name.required' => 'Nama lengkap siswa wajib diisi.',
            'class_grade.required' => 'Kelas / rombel wajib diisi.',
        ]);

        // Create student user if email provided
        $userId = null;
        if (! empty($validated['email'])) {
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]);
            $userId = $user->id;
        }

        Student::create([
            'user_id' => $userId,
            'nisn' => $validated['nisn'],
            'full_name' => $validated['full_name'],
            'class_grade' => $validated['class_grade'],
            'cohort_year' => $validated['cohort_year'],
            'gender' => $validated['gender'],
        ]);

        return redirect()->route('admin.student.index')
            ->with('success', 'Data siswa "'.$validated['full_name'].'" (NISN: '.$validated['nisn'].') berhasil ditambahkan!');
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn,'.$student->id],
            'full_name' => ['required', 'string', 'max:255'],
            'class_grade' => ['required', 'string', 'max:50'],
            'cohort_year' => ['required', 'integer', 'min:2020', 'max:2035'],
            'gender' => ['required', 'in:L,P'],
        ]);

        $student->update($validated);

        if ($student->user) {
            $student->user->update(['name' => $validated['full_name']]);
        }

        return redirect()->route('admin.student.index')
            ->with('success', 'Data siswa "'.$student->full_name.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = Student::findOrFail($id);
        $name = $student->full_name;
        $student->delete();

        return redirect()->route('admin.student.index')
            ->with('success', 'Data siswa "'.$name.'" berhasil dihapus.');
    }
}
