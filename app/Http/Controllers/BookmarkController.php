<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index(Request $request): View
    {
        $events = $request->user()
            ->bookmarkedEvents()
            ->orderBy('starts_at')
            ->paginate(8);

        return view('app.bookmarks.index', compact('events'));
    }

    public function toggle(Request $request, Event $event): RedirectResponse
    {
        $relation = $request->user()->bookmarkedEvents();

        $isBookmarked = $relation->where('events.id', $event->id)->exists();

        if ($isBookmarked) {
            $relation->detach($event->id);

            return back()->with('status', 'Event removed from bookmarks.');
        }

        $relation->attach($event->id);

        return back()->with('status', 'Event saved to bookmarks.');
    }
}
