<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminEventController;
use \App\Http\Controllers\AdminDashboardController;

// Routing For Auth Page
Route::get('/login', fn() => view('Auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', fn() => view('Auth.register'))->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', fn() => view('Auth.forgot-password'))->name('forgotPassword');

Route::get('/reset-password/{token}', fn($token) => view('Auth.reset-password', compact('token')))->name('resetPassword');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword.process');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword.process');

// Routing For Landing Page
Route::get('/', fn() => view('Home.home'));
Route::post('/kirim-email', [AuthController::class, 'sendEmail'])->name('kirim-email');

// Routing For User Page
Route::middleware(['auth', 'role:Mahasiswa'])->group(callback: function() {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/profile', [UserController::class, 'index'])->name('profile');
  Route::post('/profile', [UserController::class, 'changePassword'])->name('profile.change-password');

  Route::get('/events', [EventController::class, 'index'])->name('events.index');
  Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
  Route::get('/events/{id}/registration', [EventController::class, 'registration'])->name('events.id.registration');

  Route::get('/events/{id}/payment', [EventController::class, 'payment'])->name('events.id.payment');

  Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');
  Route::post('/bookmark/{id}', [EventController::class, 'toggleBookmark'])->name('bookmark.toggle');

  Route::get('/history', [HistoryController::class, 'index'])->name('history');
});

// Routing For Admin Page
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');

    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');

    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');

    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');
  });
