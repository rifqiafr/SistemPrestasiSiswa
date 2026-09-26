<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isOperator() || $user->isSuperAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->isSiswa() || $user->student) {
                return redirect()->route('student.dashboard');
            }

            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle authentication attempt (supports both NISN and Email).
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'NISN atau Email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $loginInput = trim($credentials['login']);
        $password = $credentials['password'];
        $remember = $request->boolean('remember');

        $authenticated = false;

        // 1. Check if input is an email
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $authenticated = Auth::attempt([
                'email' => $loginInput,
                'password' => $password,
            ], $remember);
        } else {
            // 2. Check if input is a student's NISN
            $student = Student::where('nisn', $loginInput)->first();

            if ($student && $student->user_id) {
                $user = $student->user;
                if ($user && Hash::check($password, $user->password)) {
                    Auth::login($user, $remember);
                    $authenticated = true;
                }
            } elseif ($student && ! $student->user_id) {
                // If student exists in school database without a user account yet,
                // auto-activate with default password 'siswa123' or their NISN
                if ($password === 'siswa123' || $password === $student->nisn) {
                    $newUser = User::create([
                        'name' => $student->full_name,
                        'email' => strtolower(str_replace(' ', '.', $student->full_name)).'@siswa.prestasi.sch.id',
                        'password' => Hash::make($password),
                        'role' => 'siswa',
                        'last_login_at' => now(),
                    ]);
                    $student->update(['user_id' => $newUser->id]);
                    Auth::login($newUser, $remember);
                    $authenticated = true;
                }
            } else {
                // Fallback attempt with email
                $authenticated = Auth::attempt([
                    'email' => $loginInput,
                    'password' => $password,
                ], $remember);
            }
        }

        if ($authenticated) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();
            $user->update(['last_login_at' => now()]);

            if ($user->isOperator() || $user->isSuperAdmin()) {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang di Panel Operator, '.$user->name.'!');
            }

            if ($user->isSiswa() || $user->student) {
                return redirect()->intended(route('student.dashboard'))
                    ->with('success', 'Selamat datang di Dashboard Siswa, '.$user->name.'!');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, '.$user->name.'!');
        }

        return back()
            ->withInput($request->only('login', 'remember'))
            ->withErrors([
                'login' => 'NISN / Email atau Kata Sandi yang dimasukkan tidak cocok.',
            ]);
    }

    /**
     * Show registration form for students.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('student.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle student registration / account creation.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nisn' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'class_grade' => ['required', 'string', 'max:50'],
            'cohort_year' => ['required', 'integer', 'min:2020', 'max:2035'],
            'gender' => ['required', 'in:L,P'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        // Check if student with NISN already exists
        $existingStudent = Student::where('nisn', $validated['nisn'])->first();

        if ($existingStudent && $existingStudent->user_id) {
            return back()->withInput()->withErrors([
                'nisn' => 'NISN ini sudah memiliki akun terdaftar. Silakan langsung masuk.',
            ]);
        }

        // Create User account
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa',
            'last_login_at' => now(),
        ]);

        if ($existingStudent) {
            $existingStudent->update([
                'user_id' => $user->id,
                'full_name' => $validated['name'],
                'class_grade' => $validated['class_grade'],
                'cohort_year' => $validated['cohort_year'],
                'gender' => $validated['gender'],
            ]);
        } else {
            Student::create([
                'user_id' => $user->id,
                'nisn' => $validated['nisn'],
                'full_name' => $validated['name'],
                'class_grade' => $validated['class_grade'],
                'cohort_year' => $validated['cohort_year'],
                'gender' => $validated['gender'],
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.dashboard')
            ->with('success', 'Akun siswa berhasil dibuat! Selamat datang di Dashboard Prestasi Siswa.');
    }

    /**
     * Log user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
    }
}
