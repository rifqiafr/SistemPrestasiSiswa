<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index(Request $request): View
    {
        $query = News::query();

        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $newsList = $query->orderBy('published_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.news.index', compact('newsList'));
    }

    /**
     * Show the form for creating a new news article.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news article.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'author' => ['nullable', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url_fallback' => ['nullable', 'url'],
        ]);

        $slug = Str::slug($validated['title']).'-'.Str::random(6);
        $imageUrl = $validated['image_url_fallback'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $imageUrl = asset('storage/'.$path);
        }

        $excerpt = ! empty($validated['excerpt'])
            ? $validated['excerpt']
            : Str::limit(strip_tags((string) ($validated['content'] ?? '')), 150);

        News::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'excerpt' => $excerpt ?: $validated['title'],
            'content' => $validated['content'] ?? null,
            'author' => $validated['author'] ?: 'Tim Humas Sekolah',
            'image_url' => $imageUrl ?: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80',
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $validated['published_at'] ?? now()->toDateString(),
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita kegiatan baru berhasil dipublikasikan!');
    }

    /**
     * Show the form for editing the news article.
     */
    public function edit(int $id): View
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified news article.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'author' => ['nullable', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url_fallback' => ['nullable', 'url'],
        ]);

        $imageUrl = $news->image_url;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $imageUrl = asset('storage/'.$path);
        } elseif (! empty($validated['image_url_fallback'])) {
            $imageUrl = $validated['image_url_fallback'];
        }

        $excerpt = ! empty($validated['excerpt'])
            ? $validated['excerpt']
            : ($news->excerpt ?: Str::limit(strip_tags((string) ($validated['content'] ?? '')), 150));

        $news->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'excerpt' => $excerpt ?: $validated['title'],
            'content' => $validated['content'] ?? null,
            'author' => $validated['author'] ?: 'Tim Humas Sekolah',
            'image_url' => $imageUrl,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $validated['published_at'] ?? $news->published_at,
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'Data berita "'.$news->title.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified news article.
     */
    public function destroy(int $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $title = $news->title;
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita "'.$title.'" berhasil dihapus.');
    }

    /**
     * Toggle news published status.
     */
    public function toggleStatus(int $id): RedirectResponse
    {
        $news = News::findOrFail($id);
        $news->update(['is_published' => ! $news->is_published]);

        $statusText = $news->is_published ? 'Diterbitkan ke Website' : 'Disimpan sebagai Draf';

        return back()->with('success', 'Status berita berhasil diubah: '.$statusText.'.');
    }
}
