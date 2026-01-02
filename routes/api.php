<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/auth/register', [RegisterUserController::class, 'handle'])->name('auth.register');
Route::post('/auth/login', [LoginController::class, 'handle'])->name('auth.login');