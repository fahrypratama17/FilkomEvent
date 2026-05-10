<?php

namespace App\Http\Controllers;

use App\Service\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

  public function changePassword(Request $request) {
    $request->validate([
      'current_password'=>'required',
      'new_password'=>'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
      return back()->withErrors([
        'current_password' => 'Password lama salah'
      ]);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('Success', 'Password berhasil diubah');
  }
}
