<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class BookmarkController extends Controller
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

  public function index(Request $request)
  {
    $query = $request->search;

    $bookmarks = Event::with(['category', 'bookmarkedBy'])
      ->whereHas('bookmarkedBy', function ($q) {
        $q->where('bookmarks.user_id', auth()->id());
      })
      ->when($query, function ($q) use ($query) {
        $q->where('title', 'like', "%{$query}%");
      })
      ->latest()
      ->get();

    if ($request->ajax()) {
      return view('partials.bookmark-list', compact('bookmarks'))->render();
    }

    return view('Mahasiswa.bookmark', [
      'bookmarks' => $bookmarks,
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }
}
