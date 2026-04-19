<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::query()->published()->orderBy('starts_at');

        if ($search = trim((string) $request->query('search'))) {
            $query->where(function (Builder $builder) use ($search): void {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%");
            });
        }

        if ($category = trim((string) $request->query('category'))) {
            $query->where('category', $category);
        }

        if ($status = trim((string) $request->query('status'))) {
            if ($status === 'upcoming') {
                $query->where('starts_at', '>', now());
            }

            if ($status === 'ongoing') {
                $query->where('starts_at', '<=', now())->where('ends_at', '>=', now());
            }

            if ($status === 'completed') {
                $query->where('ends_at', '<', now());
            }
        }

        $events = $query->paginate(9)->withQueryString();

        $categories = Event::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $bookmarkedEventIds = $request->user()
            ->bookmarkedEvents()
            ->pluck('events.id')
            ->all();

        return view('app.events.index', compact('events', 'categories', 'bookmarkedEventIds'));
    }

    public function show(Request $request, Event $event): View
    {
        $event->loadCount('registrations');

        $registration = $request->user()->registrations()
            ->with('payment')
            ->where('event_id', $event->id)
            ->first();

        $isBookmarked = $request->user()
            ->bookmarkedEvents()
            ->where('events.id', $event->id)
            ->exists();

        return view('app.events.show', compact('event', 'registration', 'isBookmarked'));
    }
}
