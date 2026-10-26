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

Route::get('/analytics', [
    \App\Http\Controllers\DashboardController::class,
    'analytics'
])->name('analytics');


use App\Http\Controllers\ReportController;

Route::get('/report', [ReportController::class, 'index'])
    ->name('report');

Route::put('/report/{id}', [ReportController::class, 'update'])
    ->name('report.update');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

use App\Http\Controllers\WalletController;

Route::get('/management', [WalletController::class, 'index'])
    ->name('management');

Route::resource('wallets', WalletController::class);

use App\Http\Controllers\SavingGoalController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::post('/saving-goals', [SavingGoalController::class, 'store'])
    ->name('saving-goals.store');

Route::put('/saving-goals/{savingGoal}', [SavingGoalController::class, 'update'])
    ->name('saving-goals.update');

Route::delete('/saving-goals/{savingGoal}', [SavingGoalController::class, 'destroy'])
    ->name('saving-goals.destroy');

Route::post('/saving-goals/{savingGoal}/add', [SavingGoalController::class, 'addSavings'])
    ->name('saving-goals.add');
