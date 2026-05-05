<?php

namespace App\Http\Controllers;

use App\Service\MenuService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index() {
    $user = Auth::user();

    return view('Mahasiswa.profile', [
      'user' => $user,
      'menuItems' => MenuService::getMenu($user->role),
      'settingItems' => MenuService::getSetting(),
    ]);
  }
}
