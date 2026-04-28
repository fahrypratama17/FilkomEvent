<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller {
  private function getMenu() {
    return [
      ['label' => 'Dashboard', 'route' => 'dashboard'],
      ['label' => 'Bookmark', 'route' => 'bookmark'],
      ['label' => 'History', 'route' => 'history'],
      ['label' => 'List Event', 'route' => 'events.*'],
    ];
  }

  public function index() {
    return view('Mahasiswa.dashboard', [
      'menuItems' => $this->getMenu()
    ]);
  }

  public function bookmark() {
    return view('Mahasiswa.bookmark', [
      'menuItems' => $this->getMenu()
    ]);
  }

  public function history() {
    return view('Mahasiswa.history', [
      'menuItems' => $this->getMenu()
    ]);
  }

  public function events() {
    return view('Mahasiswa.listEvent', [
      'menuItems' => $this->getMenu()
    ]);
  }
}
