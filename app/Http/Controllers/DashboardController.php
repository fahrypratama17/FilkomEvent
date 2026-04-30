<?php

namespace App\Http\Controllers;
use App\Models\Event;

class DashboardController extends Controller {
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
      ['label' => 'List Event', 'route' => 'events.*', 'icon' => 'List'],
    ];
  }

  public function index() {
    $events = Event::with('category')->latest()->take(3)->get();

    return view('Mahasiswa.dashboard', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
      'events' => $events,
    ]);
  }

  public function bookmark() {
    return view('Mahasiswa.bookmark', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  public function history() {
    return view('Mahasiswa.history', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  public function events() {
    return view('Mahasiswa.listEvent', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }

  private function getSetting() {
    return [
      ['label' => 'Profile', 'route' => 'profile', 'icon' => 'UserRound'],
    ];
  }

  public function profile() {
    return view('Mahasiswa.profile', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
    ]);
  }
}
