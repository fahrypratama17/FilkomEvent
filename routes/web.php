<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Routing For Auth Page
Route::get('/login', fn() => view('Auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('Auth.register'))->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', fn() => view('Auth.forgotPassword'));

Route::get('/reset-password', fn() => view('Auth.resetPassword'));

// Routing For Landing Page
Route::get('/', fn() => view('Home.home'));

// Routing For User Page
Route::middleware(['auth', 'role:Mahasiswa'])->group(callback: function() {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/profile', fn() => view('Mahasiswa.profile'));

  Route::get('/detail-event', fn() => view('Mahasiswa.detailEvent'));

  Route::get('/registration-event', fn() => view('Mahasiswa.registrationEvent'));

  Route::get('/list-event', [DashboardController::class, 'events'])->name('events.index');

  Route::get('/payment', fn() => view('Mahasiswa.payment'));

  Route::get('/bookmark', [DashboardController::class, 'bookmark'])->name('bookmark');

  Route::get('/history', [DashboardController::class, 'history'])->name('history');
});

// Routing For Admin Page
Route::middleware(['auth', 'role:admin'])->group(function() {
  Route::get('/admin/dashboard', fn() => view('Admin.AdminDashboard'));
});
