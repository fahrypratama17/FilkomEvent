<?php

use Illuminate\Support\Facades\Route;

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
