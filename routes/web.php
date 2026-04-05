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
