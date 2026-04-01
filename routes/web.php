<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-design', function () {
    return view('dashboard');
});
