<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index(Request $request): View
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Store a newly created announcement.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'badge' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Announcement::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'badge' => $validated['badge'],
            'description' => $validated['description'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Pengumuman resmi baru berhasil ditambahkan!');
    }

    /**
     * Update the specified announcement.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'badge' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $announcement->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'badge' => $validated['badge'],
            'description' => $validated['description'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Pengumuman "'.$announcement->title.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified announcement.
     */
    public function destroy(int $id): RedirectResponse
    {
        $announcement = Announcement::findOrFail($id);
        $title = $announcement->title;
        $announcement->delete();

        return redirect()->route('admin.announcement.index')
            ->with('success', 'Pengumuman "'.$title.'" berhasil dihapus.');
    }
}
