<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-design', function () {
    return view('dashboard');
});

Route::get('/bookmark-design', function () {
    return view('bookmark');
});

Route::get('/history-design', function () {
    return view('history');
});

Route::get('/profile-design', function () {
    return view('profile');
});
