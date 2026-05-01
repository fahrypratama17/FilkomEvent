<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
      $events = Event::with('category')
        ->latest()
        ->paginate(6);

      return view('Mahasiswa.listEvent', [
        'events' => $events,
        'menuItems' => $this->getMenu(),
        'settingItems' => $this->getSetting(),
      ]);
    }

    public function show($id) {
      $event = Event::with('category')->findOrFail($id);

      return view ('Mahasiswa.detailEvent', [
        'event' => $event,
        'menuItems' => $this->getMenu(),
        'settingItems' => $this->getSetting(),
      ]);
    }
}
