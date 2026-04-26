<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    ], [
      'nim.required' => 'NIM wajib diisi',
      'nim.unique' => 'NIM sudah terdaftar',

      'email.required' => 'Email wajib diisi',
      'email.email' => 'Format email tidak valid',
      'email.ends_with' => 'Gunakan email UB (@student.ub.ac.id)',
      'email.unique' => 'Email sudah digunakan',

      'password.required' => 'Password wajib diisi',
      'password.min' => 'Password minimal 8 karakter',
      'password.confirmed' => 'Konfirmasi password tidak sama',
    ]);

    User::create([
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
    ], [
      'email.required' => 'Email wajib diisi',
      'email.email' => 'Format email tidak valid',
      'email.ends_with' => 'Gunakan email UB (@student.ub.ac.id)',
      'email.unique' => 'Email sudah digunakan',

      'password.required' => 'Password wajib diisi',
      'password.min' => 'Password minimal 8 karakter',
    ]);

    $user = User::where('email', $request->email)->first();

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      return redirect('/dashboard')->with('success', 'Selamat Datang ');
    }

    return back()->withErrors(['login' => 'Email atau password salah'])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Anda berhasil logout');
  }
}
