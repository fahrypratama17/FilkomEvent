<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use App\Mail\ContactMail;
use App\Models\User;

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

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();

            return redirect('/dashboard')->with('success', 'Login berhasil');
        }

        return back()
            ->withErrors(['login' => 'Email atau password salah'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout');
    }

    public function sendEmail(Request $request) {
      $data = $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'nim' => 'required',
        'pesan' => 'required',
      ]);

      Mail::to('m.fahry.pratama.putra@gmail.com')->send(new ContactMail($data));

      return back()->with('success', "Pesan berhasil dikirim!");
    }

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        $token = \Str::random(64);

        $user->update([
            'reset_token' => $token,
            'reset_token_expired_at' => now()->addMinutes(30)
        ]);

        $link = url('/reset-password/' . $token);

        Mail::to($user->email)->send(new ResetPassword($link));

        return back()->with('success', 'Link reset dikirim ke email!');
    }

    public function resetPassword(Request $request) {
      $request->validate([
        'token' => 'required',
        'password' => 'required|min:8|confirmed'
      ]);

      $user = User::where('reset_token', $request->token)
        ->where('reset_token_expired_at', '>', now())
        ->first();

      if (!$user) {
        return back()->withErrors(['error' => 'Token tidak valid atau expired']);
      }

      $user->update([
        'password' => bcrypt($request->password),
        'reset_token' => null,
        'reset_token_expired_at' => null,
      ]);

      return redirect('/login')->with('success', 'Password berhasil direset');
    }
}
