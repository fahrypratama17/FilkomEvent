<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-design', function () {
    return view('dashboard');
});

Route::get('/bookmark-design', function () {
    return view('bookmark');
});
