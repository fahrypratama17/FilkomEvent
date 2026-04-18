<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function() {
  return view('Auth.login');
});

Route::get('/register', function() {
    return view('Auth.register');
});

Route::get('/forgot-password', function() {
    return view('Auth.forgotPassword');
});

Route::get('/reset-password', function() {
    return view('Auth.resetPassword');
});

Route::get('/dashboard-design', function () {
    return view('dashboard');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/admin/dashboard', function () {
  return view('AdminDashboard');
});

Route::get('/history-design', function () {
  return view('history');
});

Route::get('/profile-design', function () {
    return view('profile');
});

Route::get('/detail-event-design', function () {
    return view('detail-event');
});

Route::get('/list-event-design', function () {
    return view('list-event');
});

Route::get('/registration-event-design', function () {
    return view('registration-event');
});

Route::get('/payment-design', function () {
    return view('payment');
});

Route::get('/bookmark', function () {
  return view('bookmark');
});
