<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolProfileController extends Controller
{
    /**
     * Display the school profile and landing page settings editor.
     */
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.profile.index', compact('settings'));
    }

    /**
     * Update school profile settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', 'headmaster_photo_file']);

        // Handle headmaster photo upload if provided
        if ($request->hasFile('headmaster_photo_file')) {
            $photoPath = $request->file('headmaster_photo_file')->store('settings', 'public');
            $data['headmaster_photo'] = asset('storage/'.$photoPath);
        }

        if ($request->has('settings') && is_array($request->input('settings'))) {
            foreach ($request->input('settings') as $k => $v) {
                $data[$k] = $v;
            }
            unset($data['settings']);
        }

        foreach ($data as $key => $value) {
            if (is_scalar($value) || is_null($value)) {
                Setting::set($key, (string) ($value ?? ''));
            }
        }

        return redirect()->route('admin.profile.index')
            ->with('success', 'Pengaturan profil sekolah, visi misi, sambutan, dan informasi landing page berhasil diperbarui!');
    }
}
