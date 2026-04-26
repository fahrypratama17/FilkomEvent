<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
      session(['user' => $user]);
      return redirect('/dashboard');
    }

    return back()->withErrors(['login' => 'Email atau password salah']);
  }
}
