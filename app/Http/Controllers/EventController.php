<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Console\EventListCommand;
use Illuminate\Http\Request;

class EventController extends Controller
{
  private function getMenu() {
    $role = auth()->user()->role;

    if ($role === 'admin') {
      return [
        ['label' => 'Dashboard', 'route' => 'Admin.AdminDashboard', 'icon' => 'UserRound']
      ];
    }

    return [
      ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'House'],
      ['label' => 'Bookmark', 'route' => 'bookmark', 'icon' => 'BookMarked'],
      ['label' => 'History', 'route' => 'history', 'icon' => 'History'],
      ['label' => 'List Event', 'route' => 'events.index', 'icon' => 'List'],
    ];
  }

  private function getSetting() {
    return [
      ['label' => 'Profile', 'route' => 'profile', 'icon' => 'UserRound']
    ];
  }

  public function index() {
    $query = Event::with(['category', 'bookmarkedBy' => function ($q) {
      $q->where('bookmarks.user_id', auth()->id());
    }])->latest();

    if (request('search')) {
      $query->where('title', 'like', '%' . request('search') . '%');
    }

    $events = $query->paginate(6);

    return view('Mahasiswa.list-event', [
      'events' => $events,
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  public function show($id) {
    $event = Event::with('category')->findOrFail($id);

    return view ('Mahasiswa.detail-event', [
      'event' => $event,
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  public function toggleBookmark($id) {
    $user = auth()->user();

    if ($user->bookmarks()->where('events.event_id', $id)->exists()) {
      $user->bookmarks()->detach($id);
    } else {
      $user->bookmarks()->attach($id);
    }

    return response()->json([
      'status' => 'ok'
    ]);
  }
}
