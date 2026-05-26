<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
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

  private function sharedData(): array
  {
    return [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ];
  }

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

    $summaryCards = [
      [
        'value' => str_pad((string) $totalEvents, 2, '0', STR_PAD_LEFT),
        'label' => 'Jumlah Event',
      ],
      [
        'value' => str_pad((string) $upcomingEvents, 2, '0', STR_PAD_LEFT),
        'label' => 'Event Akan Datang',
      ],
      [
        'value' => str_pad((string) $ongoingEvents, 2, '0', STR_PAD_LEFT),
        'label' => 'Event Sedang Berlangsung',
      ],
      [
        'value' => str_pad((string) $finishedEvents, 2, '0', STR_PAD_LEFT),
        'label' => 'Event Selesai',
      ],
    ];

    $palette = [
      '#08076F',
      '#054D92',
      '#0497C7',
      '#0CB2C9',
      '#7C3AED',
      '#F9682A'
    ];

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
        ->all()
      : [];

    return view('Admin.admin-dashboard', array_merge(
      $this->sharedData(),
      [
        'summaryCards' => $summaryCards,
        'categoryStats' => $categoryStats,
      ]
    ));
  }
}
