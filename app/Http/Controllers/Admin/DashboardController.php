<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Category;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the operator admin dashboard.
     */
    public function index(Request $request): View
    {
        // 1. Overall Metrics
        $totalAchievements = Achievement::count();
        $publishedCount = Achievement::where('status', 'published')->count();
        $draftCount = Achievement::where('status', 'draft')->count();
        $featuredCount = Achievement::where('is_featured', true)->count();
        $totalStudents = Student::count();
        $studentsWithAwards = Student::has('achievements')->count();

        // 2. Breakdown by Competition Level
        $levels = [
            'Internasional' => Achievement::where('competition_level', 'Internasional')->count(),
            'Nasional' => Achievement::where('competition_level', 'Nasional')->count(),
            'Provinsi' => Achievement::where('competition_level', 'Provinsi')->count(),
            'Kabupaten/Kota' => Achievement::where('competition_level', 'Kabupaten/Kota')->count(),
            'Sekolah' => Achievement::where('competition_level', 'Sekolah')->count(),
        ];

        // 3. Urgent Verification Queue (Drafts awaiting approval)
        $pendingAchievements = Achievement::where('status', 'draft')
            ->with(['category', 'participants', 'media', 'coverMedia', 'creator'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // 4. Recent Published Achievements
        $recentPublished = Achievement::where('status', 'published')
            ->with(['category', 'participants', 'coverMedia'])
            ->orderBy('event_date', 'desc')
            ->take(6)
            ->get();

        // 5. Top 5 Students with highest number of achievements
        $topStudents = Student::withCount('achievements')
            ->orderBy('achievements_count', 'desc')
            ->take(5)
            ->get();

        // 6. Category Distribution
        $categories = Category::withCount('achievements')
            ->orderBy('achievements_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalAchievements',
            'publishedCount',
            'draftCount',
            'featuredCount',
            'totalStudents',
            'studentsWithAwards',
            'levels',
            'pendingAchievements',
            'recentPublished',
            'topStudents',
            'categories'
        ));
    }
}
