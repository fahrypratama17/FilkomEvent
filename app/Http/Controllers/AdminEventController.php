<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
            return response()->view('Admin.partials.events-management-results', [
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
            'registration_status' => ['required', 'in:dibuka,ditutup'],
            'is_paid' => ['required', 'boolean'],
            'price' => ['required_if:is_paid,1', 'nullable', 'numeric', 'min:0'],
            'category_id' => $categoryRules,
            'organizer' => ['required', 'string', 'max:150'],
            'contact_email' => ['required', 'email', 'max:100'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image_url' => ['required', 'image', 'max:2048'],
        ]);

        $imagePath = null;

        try {
            $imagePath = $request->file('image_url')->store('events', 'public');

            Event::create([
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

            return redirect()
                ->route('admin.events.index')
                ->with('success', 'Event Berhasil Ditambahkan ke Database');
        } catch (\Throwable $e) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Event Gagal Ditambahkan ke Database');
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
