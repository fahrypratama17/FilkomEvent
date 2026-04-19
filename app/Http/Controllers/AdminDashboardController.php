<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_events' => Event::count(),
            'published_events' => Event::where('status', 'published')->count(),
            'total_registrations' => Registration::count(),
        ];

        $recentRegistrations = Registration::query()
            ->with(['user', 'event'])
            ->latest()
            ->take(5)
            ->get();

        $eventsRequiringAction = Event::query()
            ->where('ends_at', '<', now())
            ->where('status', 'published')
            ->latest('ends_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'eventsRequiringAction'));
    }
}
