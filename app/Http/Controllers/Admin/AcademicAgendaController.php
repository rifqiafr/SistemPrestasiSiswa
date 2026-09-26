<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicAgenda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicAgendaController extends Controller
{
    /**
     * Display a listing of academic agendas.
     */
    public function index(): View
    {
        $agendas = AcademicAgenda::orderBy('event_date', 'asc')->paginate(10);

        return view('admin.agendas.index', compact('agendas'));
    }

    /**
     * Store a newly created agenda.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'time' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        AcademicAgenda::create([
            'title' => $validated['title'],
            'event_date' => $validated['event_date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'status' => $validated['status'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kalender akademik baru berhasil ditambahkan!');
    }

    /**
     * Update the specified agenda.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $agenda = AcademicAgenda::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'time' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $agenda->update([
            'title' => $validated['title'],
            'event_date' => $validated['event_date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'status' => $validated['status'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda "'.$agenda->title.'" berhasil diperbarui!');
    }

    /**
     * Remove the specified agenda.
     */
    public function destroy(int $id): RedirectResponse
    {
        $agenda = AcademicAgenda::findOrFail($id);
        $title = $agenda->title;
        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda "'.$title.'" berhasil dihapus.');
    }
}
