<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {
  private function getMenu() {
    $role = auth()->user()->role;

    if ($role === 'admin') {
      return [
        ['label' => 'Dashboard', 'route' => 'Admin.AdminDashboard']
      ];
    }

    return [
      ['label' => 'Dashboard', 'route' => 'dashboard'],
      ['label' => 'Bookmark', 'route' => 'bookmark'],
      ['label' => 'History', 'route' => 'history'],
      ['label' => 'List Event', 'route' => 'events.*'],
    ];
  }

  public function index() {
    return view('Mahasiswa.dashboard', [
      'menuItems' => $this->getMenu(),
      'settingItems' => $this->getSetting(),
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
      ['label' => 'Profile', 'route' => 'profile'],
    ];
  }
}
