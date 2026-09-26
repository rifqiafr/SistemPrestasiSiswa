<?php

namespace App\Http\Controllers;

use App\Models\AcademicAgenda;
use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Facility;
use App\Models\News;
use App\Models\Setting;
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

        // 6. Dynamic Content from CMS Database
        $settings = Setting::pluck('value', 'key');
        $newsItems = News::published()->orderBy('published_at', 'desc')->take(6)->get();
        $announcements = Announcement::active()->orderBy('created_at', 'desc')->take(6)->get();
        $academicAgendas = AcademicAgenda::active()->orderBy('event_date', 'asc')->take(6)->get();
        $facilities = Facility::active()->orderBy('id', 'asc')->get();

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
            'settings',
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
