<?php

namespace App\Http\Controllers;
use App\Service\DashboardService;
use App\Models\Category;
use App\Models\Registration;
use App\Models\Event;

class DashboardController extends Controller {
  private function getMenu() {
    return [
      ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'House'],
      ['label' => 'Bookmark', 'route' => 'bookmark', 'icon' => 'BookMarked'],
      ['label' => 'History', 'route' => 'history', 'icon' => 'History'],
      ['label' => 'List Event', 'route' => 'events.*', 'icon' => 'List'],
    ];
  }

  private function getSetting() {
    return [
      ['label' => 'Profile', 'route' => 'profile', 'icon' => 'UserRound'],
    ];
  }

  private function sharedData() {
    return [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ];
  }

  public function index(DashboardService $dashboardService) {
    if (auth()->user()->role === 'admin') {
      return view('Admin.admin-dashboard', $this->sharedData());
    }

    $events = Event::with('category')->latest()->take(3)->get();

    $iconMap = [
      'Workshop' => 'Wrench',
      'Lomba' => 'Trophy',
      'Webinar' => 'Video',
      'Seminar' => 'Users',
    ];

    $categoryStats = $dashboardService->getCategoryStats(auth()->id());

    $stats = [
      [
        'value' => Registration::where('user_id', auth()->id())->count(),
        'label' => 'Acara yang Diikuti',
        'icon' => 'UserRound'
      ],
      [
        'value' => Registration::where('user_id', auth()->id())
          ->where('registration_status', 'Selesai')
          ->count(),
        'label' => 'Sertifikat Diperoleh',
        'icon' => 'Award'
      ],
      [
        'value' => Event::where('event_start', '>', now())->count(),
        'label' => 'Acara Mendatang',
        'icon' => 'Calendar'
      ],
    ];

    $categories = Category::withCount('events')
      ->orderByDesc('events_count')
      ->take(4)
      ->get()
      ->map(function ($cat) use ($iconMap) {
        $cat->icon = $iconMap[$cat->category_name] ?? 'Tag';
        return $cat;
      });

    return view('Mahasiswa.dashboard', array_merge(
      $this->sharedData(),
      [
        'events' => $events,
        'categories' => $categories,
        'categoryStats' => $categoryStats,
        'stats' => $stats,
      ]
    ));
  }
  public function history() {
    return view('Mahasiswa.history', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  public function profile() {
    return view('Mahasiswa.profile', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }
}
