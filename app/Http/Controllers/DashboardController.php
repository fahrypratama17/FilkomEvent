<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $events = Event::query()
            ->published()
            ->upcoming()
            ->orderBy('starts_at')
            ->take(3)
            ->get();

        $stats = [
            'events_attended' => $user->registrations()->where('status', 'completed')->count(),
            'bookmarks' => $user->bookmarkedEvents()->count(),
            'upcoming_events' => $user->registrations()
                ->whereHas('event', fn ($query) => $query->where('starts_at', '>=', now()))
                ->count(),
        ];

        return view('app.dashboard', compact('events', 'stats'));
    }
}
