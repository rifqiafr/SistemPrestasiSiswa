<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    /**
     * Display a listing of facilities.
     */
    public function index(): View
    {
        $facilities = Facility::orderBy('id', 'asc')->paginate(10);

        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Store a newly created facility.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:50'],
            'category_label' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url_fallback' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imageUrl = $validated['image_url_fallback'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('facilities', 'public');
            $imageUrl = asset('storage/'.$path);
        }

        Facility::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'category_label' => $validated['category_label'],
            'description' => $validated['description'],
            'image_url' => $imageUrl ?: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas baru berhasil ditambahkan ke galeri!');
    }

    /**
     * Update the specified facility.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $facility = Facility::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:50'],
            'category_label' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url_fallback' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imageUrl = $facility->image_url;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('facilities', 'public');
            $imageUrl = asset('storage/'.$path);
        } elseif (! empty($validated['image_url_fallback'])) {
            $imageUrl = $validated['image_url_fallback'];
        }

        $facility->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'category_label' => $validated['category_label'],
            'description' => $validated['description'],
            'image_url' => $imageUrl,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas "'.$facility->name.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified facility.
     */
    public function destroy(int $id): RedirectResponse
    {
        $facility = Facility::findOrFail($id);
        $name = $facility->name;
        $facility->delete();

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas "'.$name.'" berhasil dihapus dari galeri.');
    }
}
