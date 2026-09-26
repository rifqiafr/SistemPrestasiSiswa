<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::withCount('achievements')->orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ], [
            'name.required' => 'Nama bidang kategori wajib diisi.',
            'name.unique' => 'Kategori ini sudah ada.',
        ]);

        $slug = Str::slug($validated['name']);

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'is_active' => true,
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori baru "'.$validated['name'].'" berhasil ditambahkan!');
    }

    /**
     * Toggle category active status.
     */
    public function toggle(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $newActive = ! $category->is_active;
        $category->update(['is_active' => $newActive]);

        $statusText = $newActive ? 'Diaktifkan' : 'Dinonaktifkan';

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori "'.$category->name.'" berhasil '.$statusText.'.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::withCount('achievements')->findOrFail($id);

        if ($category->achievements_count > 0) {
            return back()->with('error', 'Kategori "'.$category->name.'" tidak dapat dihapus karena masih digunakan oleh '.$category->achievements_count.' data prestasi.');
        }

        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
