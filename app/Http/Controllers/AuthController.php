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
      'nim' => 'required',
      'name' => 'required',
      'email' => 'required|email|ends_with:student.ub.ac.id|unique:users',
      'password' => 'required|min:8|confirmed'
    ]);

    User::create([
      'nim' =>  $request->nim,
      'name' =>  $request->name,
      'email' =>  $request->email,
      'password' => Hash::make($request->password),
    ]);

    return redirect('login')->with('success', 'Akun Berhasil Dibuat');
  }
}
