<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display accreditation report generator for school operator.
     */
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $query = Achievement::with(['category', 'participants', 'creator']);

        if ($request->filled('year') && $request->input('year') !== 'all') {
            $year = (int) $request->input('year');
            $query->whereYear('event_date', $year);
        }

        if ($request->filled('level') && $request->input('level') !== 'all') {
            $query->where('competition_level', $request->input('level'));
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        } else {
            // Default only published for official reports unless specifically chosen
            $query->where('status', 'published');
        }

        $achievements = $query->orderBy('event_date', 'desc')->get();

        // Statistical summary for the report header
        $totalCount = $achievements->count();
        $internasionalCount = $achievements->where('competition_level', 'Internasional')->count();
        $nasionalCount = $achievements->where('competition_level', 'Nasional')->count();
        $provinsiCount = $achievements->where('competition_level', 'Provinsi')->count();
        $kotaCount = $achievements->where('competition_level', 'Kabupaten/Kota')->count();
        $sekolahCount = $achievements->where('competition_level', 'Sekolah')->count();

        // Extract available years from achievements table
        $availableYears = Achievement::selectRaw('strftime("%Y", event_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter();

        return view('admin.reports.index', compact(
            'achievements',
            'categories',
            'availableYears',
            'totalCount',
            'internasionalCount',
            'nasionalCount',
            'provinsiCount',
            'kotaCount',
            'sekolahCount'
        ));
    }
}
