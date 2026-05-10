<?php

namespace App\Service;

class MenuService
{
  public static function getMenu($role)
  {
    if ($role === 'admin') {
      return [
        ['label' => 'Dashboard', 'route' => 'Admin.AdminDashboard', 'icon' => 'UserRound'],
      ];
    }

    return [
      ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'House'],
      ['label' => 'Bookmark', 'route' => 'bookmark', 'icon' => 'BookMarked'],
      ['label' => 'History', 'route' => 'history', 'icon' => 'History'],
      ['label' => 'List Event', 'route' => 'events.index', 'icon' => 'List'],
    ];
  }

  public static function getSetting()
  {
    return [
      ['label' => 'Profile', 'route' => 'profile', 'icon' => 'UserRound'],
    ];
  }
}
