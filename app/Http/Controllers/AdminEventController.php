<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminEventController extends Controller
{
    public function index(): View
    {
        $events = Event::query()->latest()->paginate(12);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEvent($request);

        Event::create([
            ...$validated,
            'slug' => $this->generateUniqueSlug($validated['title']),
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $this->validateEvent($request);

        $event->update([
            ...$validated,
            'slug' => $this->generateUniqueSlug($validated['title'], $event->id),
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('status', 'Event deleted successfully.');
    }

    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'quota' => ['required', 'integer', 'min:1'],
            'fee' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,published,completed,cancelled'],
            'organizer' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $base = $baseSlug !== '' ? $baseSlug : 'event';
        $slug = $base;
        $counter = 1;

        while (
            Event::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
