<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'nim' => 'required|unique:users,nim',
      'name' => 'required',
      'email' => 'required|email|ends_with:@student.ub.ac.id|unique:users,email',
      'password' => 'required|min:8|confirmed'
    ]);

    $user = User::create([
      'nim' =>  $request->nim,
      'name' =>  $request->name,
      'email' =>  $request->email,
      'password' => $request->password,
    ]);

    return redirect('login')->with('success', 'Akun Berhasil Dibuat');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      return redirect()->intended('/dashboard')->with('success', 'Selamat Datang');
    }

    return back()
      ->withErrors(['login' => 'Email atau password salah'])
      ->onlyInput('email', 'remember');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Anda berhasil logout');
  }
}
