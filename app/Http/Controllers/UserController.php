<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
      $user = Auth::user();

      return view('Mahasiswa.profile', [
        'user' => $user,
        'menuItems' => $this->getMenu(),
        'settingItems' => $this->getSetting(),
      ]);
    }

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

  private function getSetting() {
    return [
      ['label' => 'Profile', 'route' => 'profile', 'icon' => 'UserRound'],
    ];
  }
}
