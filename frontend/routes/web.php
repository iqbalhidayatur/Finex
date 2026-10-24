<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/report', function () {
    return view('report');
})->name('report');

Route::get('/management', function () {
    return view('management');
})->name('management');

Route::get('/analytics', function () {
    return view('analytics');
})->name('analytics');