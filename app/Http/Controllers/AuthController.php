<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'nim' => 'required',
      'name' => 'required',
      'email' => 'required|email|ends_with:@student.ub.ac.id',
      'password' => 'required|min:8|confirmed'
    ]);

    $users = [];
    if (Storage::exists('users.json')) {
      $users = json_decode(Storage::get('users.json'), true);
    }

    foreach ($users as $user) {
      if ($user['email'] === $request->email) {
        return back()->withErrors(['email' => 'Email sudah digunakan']);
      }
    }

    $users[] = [
      'nim' => $request->nim,
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ];

    Storage::put('users.json', json_encode($users, JSON_PRETTY_PRINT));

//    User::create([
//      'nim' =>  $request->nim,
//      'name' =>  $request->name,
//      'email' =>  $request->email,
//      'password' => Hash::make($request->password),
//    ]);

    return redirect('login')->with('success', 'Akun Berhasil Dibuat');
  }

  public function login(Request $request)
  {
    $users = json_decode(Storage::get('users.json'), true);

    foreach ($users as $user) {
      if ($user['email'] === $request->email &&
        Hash::check($request->password, $user['password'])) {

        session(['user' => $user]);
        return redirect('/dashboard-design');
      }
    }

    return back()->withErrors(['login' => 'Email atau password salah']);
  }
}
