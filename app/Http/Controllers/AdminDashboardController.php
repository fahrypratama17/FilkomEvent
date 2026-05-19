<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $hasEventsTable = Schema::hasTable('events');
        $hasCategoriesTable = Schema::hasTable('categories');

        $totalEvents = $hasEventsTable ? Event::count() : 0;
        $upcomingEvents = $hasEventsTable
            ? Event::where('event_start', '>', now())->count()
            : 0;
        $ongoingEvents = $hasEventsTable
            ? Event::where('event_start', '<=', now())
                ->where('event_end', '>=', now())
                ->count()
            : 0;
        $finishedEvents = $hasEventsTable
            ? Event::where('event_end', '<', now())->count()
            : 0;

        $palette = ['#08076F', '#054D92', '#0497C7', '#0CB2C9', '#7C3AED', '#F9682A'];

        $categoryStats = $hasEventsTable && $hasCategoriesTable
            ? Category::withCount('events')
                ->orderBy('category_name')
                ->get()
                ->map(fn (Category $category, int $index) => [
                    'label' => $category->category_name,
                    'value' => $category->events_count,
                    'color' => $palette[$index % count($palette)],
                ])
                ->values()
            : collect();

        return view('Admin.admin-dashboard', [
            'totalEvents' => $totalEvents,
            'upcomingEvents' => $upcomingEvents,
            'ongoingEvents' => $ongoingEvents,
            'finishedEvents' => $finishedEvents,
            'categoryStats' => $categoryStats,
        ]);
    }
}
