<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('user.menu');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

