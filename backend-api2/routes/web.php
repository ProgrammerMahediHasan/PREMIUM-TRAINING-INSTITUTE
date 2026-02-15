<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [WebAuthController::class, 'showLogin']);
Route::post('/login', [WebAuthController::class, 'login']);
Route::get('/register', [WebAuthController::class, 'showRegister']);
Route::post('/register', [WebAuthController::class, 'register']);
Route::post('/logout', [WebAuthController::class, 'logout']);
Route::get('/logout', [WebAuthController::class, 'showLogout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
