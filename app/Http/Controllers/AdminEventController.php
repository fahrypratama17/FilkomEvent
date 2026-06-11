<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventGoal;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $hasCategoriesTable = Schema::hasTable('categories');

        $categories = $hasCategoriesTable
            ? Category::orderBy('category_name')->get()
            : collect();

        if (! Schema::hasTable('events')) {
            $events = new LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('Admin.events-management', compact('events', 'categories'));
        }

        $query = Event::query()
            ->when($hasCategoriesTable, fn ($query) => $query->with('category'))
            ->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('event_status')) {
            $query->where('event_status', $request->event_status);
        }

        $events = $query->paginate(10)->withQueryString();

        if (! $hasCategoriesTable) {
            $events->getCollection()->each(
                fn (Event $event) => $event->setRelation('category', null)
            );
        }

        if ($request->ajax()) {
            return response()->view('partials.events-management-results', [
                'events' => $events,
            ]);
        }

        return view('Admin.events-management', [
            'events' => $events,
            'categories' => $categories,
            'menuItems' => $this->getMenu(),
            'settingItems' => $this->getSetting(),
        ]);
    }

  private function getMenu(): array
  {
    return [
      [
        'label' => 'Dashboard',
        'route' => 'admin.dashboard',
        'icon' => 'House'
      ],
      [
        'label' => 'Manajemen Event',
        'route' => 'admin.events.index',
        'icon' => 'Calendar'
      ],
      [
        'label' => 'Tambah Event',
        'route' => 'admin.events.create',
        'icon' => 'CalendarPlus'
      ]
    ];
  }

  private function getSetting(): array
  {
    return [];
  }

    public function create()
    {
        $categories = Schema::hasTable('categories')
            ? Category::orderBy('category_name')->get()
            : collect();

      return view('Admin.form-upload-admin', [
        'categories' => $categories,
        'event' => null,
        'speakerNames' => [''],
        'speakerTitles' => [''],
        'speakerOrganizations' => [''],
        'eventGoals' => [''],
        'menuItems' => $this->getMenu(),
        'settingItems' => $this->getSetting(),
      ]);
    }

    public function edit(Event $event)
    {
        $categories = Schema::hasTable('categories')
            ? Category::orderBy('category_name')->get()
            : collect();

        $event->load(['speakers', 'goals']);

        $speakerNames = $event->speakers->pluck('name')->all();
        $speakerTitles = $event->speakers->pluck('title')->all();
        $speakerOrganizations = $event->speakers->pluck('organization')->all();
        $eventGoals = $event->goals->pluck('description')->all();

        return view('Admin.form-upload-admin', [
            'categories' => $categories,
            'event' => $event,
            'speakerNames' => $speakerNames ?: [''],
            'speakerTitles' => $speakerTitles ?: [''],
            'speakerOrganizations' => $speakerOrganizations ?: [''],
            'eventGoals' => $eventGoals ?: [''],
            'menuItems' => $this->getMenu(),
            'settingItems' => $this->getSetting(),
        ]);
    }

    public function store(Request $request)
    {
        if (! Schema::hasTable('events')) {
            return back()
                ->withInput()
                ->with('error', 'Tabel events belum tersedia. Jalankan migration terlebih dahulu.');
        }

        $categoryRules = ['required', 'integer'];

        if (Schema::hasTable('categories')) {
            $categoryRules[] = 'exists:categories,category_id';
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'event_start' => ['required', 'date'],
            'event_end' => ['required', 'date', 'after_or_equal:event_start'],
            'location' => ['required', 'string', 'max:150'],
            'quota' => ['required', 'integer', 'min:1'],
            'event_status' => ['required', 'in:berlangsung,akan_datang,selesai,dibatalkan'],
            'registration_status' => ['required', 'in:terdaftar,lunas,batal'],
            'is_paid' => ['required', 'boolean'],
            'price' => ['required_if:is_paid,1', 'nullable', 'numeric', 'min:0'],
            'category_id' => $categoryRules,
            'organizer' => ['required', 'string', 'max:150'],
            'contact_email' => ['required', 'email', 'max:100'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_url' => ['required', 'image', 'max:2048'],
            'speaker_names' => ['array'],
            'speaker_names.*' => ['nullable', 'string', 'max:100'],
            'speaker_titles' => ['array'],
            'speaker_titles.*' => ['nullable', 'string', 'max:100'],
            'speaker_organizations' => ['array'],
            'speaker_organizations.*' => ['nullable', 'string', 'max:150'],
            'event_goals' => ['array'],
            'event_goals.*' => ['nullable', 'string'],
        ]);

        $speakerNames = $request->input('speaker_names', []);
        $speakerTitles = $request->input('speaker_titles', []);
        $speakerOrganizations = $request->input('speaker_organizations', []);

        $speakerRows = [];
        $maxSpeakers = max(count($speakerNames), count($speakerTitles), count($speakerOrganizations));

        for ($i = 0; $i < $maxSpeakers; $i++) {
            $name = trim($speakerNames[$i] ?? '');
            $title = trim($speakerTitles[$i] ?? '');
            $organization = trim($speakerOrganizations[$i] ?? '');

            if ($name === '' && $title === '' && $organization === '') {
                continue;
            }

            if ($name === '' || $title === '' || $organization === '') {
                return back()
                    ->withInput()
                    ->withErrors(['speakers' => 'Lengkapi data pembicara (nama, jabatan, organisasi).']);
            }

            $speakerRows[] = [
                'name' => $name,
                'title' => $title,
                'organization' => $organization,
            ];
        }

        $goals = collect($request->input('event_goals', []))
            ->map(fn ($goal) => trim((string) $goal))
            ->filter()
            ->values()
            ->all();

        $imagePath = null;

        try {
            DB::beginTransaction();

            $imagePath = $request->file('image_url')->store('events', 'public');

            $event = Event::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'short_description' => $validated['short_description'],
                'event_start' => $validated['event_start'],
                'event_end' => $validated['event_end'],
                'location' => $validated['location'],
                'quota' => $validated['quota'],
                'quota_filled' => 0,
                'event_status' => $validated['event_status'],
                'registration_status' => $validated['registration_status'],
                'price' => $request->boolean('is_paid') ? ($validated['price'] ?? 0) : 0,
                'is_paid' => $request->boolean('is_paid'),
                'category_id' => $validated['category_id'],
                'created_by' => auth()->id(),
                'image_url' => 'storage/' . $imagePath,
                'organizer' => $validated['organizer'],
                'contact_email' => $validated['contact_email'],
                'contact_phone' => $validated['contact_phone'],
            ]);

            if ($speakerRows) {
                $speakerIds = collect($speakerRows)
                    ->map(fn ($row) => Speaker::create($row)->speaker_id)
                    ->all();

                $event->speakers()->attach($speakerIds);
            }

            if ($goals) {
                $event->goals()->createMany(
                    array_map(fn ($goal) => ['description' => $goal], $goals)
                );
            }

            DB::commit();

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'Event Berhasil Ditambahkan ke Database');
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Event Gagal Ditambahkan ke Database');
        }
    }

    public function update(Request $request, Event $event)
    {
        if (! Schema::hasTable('events')) {
            return back()
                ->withInput()
                ->with('error', 'Tabel events belum tersedia. Jalankan migration terlebih dahulu.');
        }

        $categoryRules = ['required', 'integer'];

        if (Schema::hasTable('categories')) {
            $categoryRules[] = 'exists:categories,category_id';
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'event_start' => ['required', 'date'],
            'event_end' => ['required', 'date', 'after_or_equal:event_start'],
            'location' => ['required', 'string', 'max:150'],
            'quota' => ['required', 'integer', 'min:1'],
            'event_status' => ['required', 'in:berlangsung,akan_datang,selesai,dibatalkan'],
            'registration_status' => ['required', 'in:terdaftar,lunas,batal'],
            'is_paid' => ['required', 'boolean'],
            'price' => ['required_if:is_paid,1', 'nullable', 'numeric', 'min:0'],
            'category_id' => $categoryRules,
            'organizer' => ['required', 'string', 'max:150'],
            'contact_email' => ['required', 'email', 'max:100'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_url' => ['nullable', 'image', 'max:2048'],
            'speaker_names' => ['array'],
            'speaker_names.*' => ['nullable', 'string', 'max:100'],
            'speaker_titles' => ['array'],
            'speaker_titles.*' => ['nullable', 'string', 'max:100'],
            'speaker_organizations' => ['array'],
            'speaker_organizations.*' => ['nullable', 'string', 'max:150'],
            'event_goals' => ['array'],
            'event_goals.*' => ['nullable', 'string'],
        ]);

        $speakerNames = $request->input('speaker_names', []);
        $speakerTitles = $request->input('speaker_titles', []);
        $speakerOrganizations = $request->input('speaker_organizations', []);

        $speakerRows = [];
        $maxSpeakers = max(count($speakerNames), count($speakerTitles), count($speakerOrganizations));

        for ($i = 0; $i < $maxSpeakers; $i++) {
            $name = trim($speakerNames[$i] ?? '');
            $title = trim($speakerTitles[$i] ?? '');
            $organization = trim($speakerOrganizations[$i] ?? '');

            if ($name === '' && $title === '' && $organization === '') {
                continue;
            }

            if ($name === '' || $title === '' || $organization === '') {
                return back()
                    ->withInput()
                    ->withErrors(['speakers' => 'Lengkapi data pembicara (nama, jabatan, organisasi).']);
            }

            $speakerRows[] = [
                'name' => $name,
                'title' => $title,
                'organization' => $organization,
            ];
        }

        $goals = collect($request->input('event_goals', []))
            ->map(fn ($goal) => trim((string) $goal))
            ->filter()
            ->values()
            ->all();

        $newImagePath = null;
        $oldImagePath = $event->image_url;
        $event->load('speakers');

        try {
            DB::beginTransaction();

            if ($request->hasFile('image_url')) {
                $newImagePath = $request->file('image_url')->store('events', 'public');
            }

            $event->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'short_description' => $validated['short_description'],
                'event_start' => $validated['event_start'],
                'event_end' => $validated['event_end'],
                'location' => $validated['location'],
                'quota' => $validated['quota'],
                'event_status' => $validated['event_status'],
                'registration_status' => $validated['registration_status'],
                'price' => $request->boolean('is_paid') ? ($validated['price'] ?? 0) : 0,
                'is_paid' => $request->boolean('is_paid'),
                'category_id' => $validated['category_id'],
                'image_url' => $newImagePath ? 'storage/' . $newImagePath : $event->image_url,
                'organizer' => $validated['organizer'],
                'contact_email' => $validated['contact_email'],
                'contact_phone' => $validated['contact_phone'],
            ]);

            if ($newImagePath && $oldImagePath && str_starts_with($oldImagePath, 'storage/events/')) {
                $oldPath = str_replace('storage/', '', $oldImagePath);
                Storage::disk('public')->delete($oldPath);
            }

            $existingSpeakerIds = $event->speakers->pluck('speaker_id')->all();
            $event->speakers()->detach();

            if ($existingSpeakerIds) {
                Speaker::whereIn('speaker_id', $existingSpeakerIds)->delete();
            }

            if ($speakerRows) {
                $speakerIds = collect($speakerRows)
                    ->map(fn ($row) => Speaker::create($row)->speaker_id)
                    ->all();

                $event->speakers()->attach($speakerIds);
            }

            $event->goals()->delete();

            if ($goals) {
                $event->goals()->createMany(
                    array_map(fn ($goal) => ['description' => $goal], $goals)
                );
            }

            DB::commit();

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'Event Berhasil Diperbarui');
        } catch (
            \Throwable $e
        ) {
            DB::rollBack();

            if ($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Event Gagal Diperbarui');
        }
    }

    public function destroy(Event $event)
    {
        try {
            if ($event->image_url && str_starts_with($event->image_url, 'storage/events/')) {
                $filePath = str_replace('storage/', '', $event->image_url);
                Storage::disk('public')->delete($filePath);
            }

            $event->delete();

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'Event Berhasil Dihapus dari Database');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.events.index')
                ->with('error', 'Event Gagal Dihapus dari Database');
        }
    }
}
