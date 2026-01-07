<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get(
    '/auth/verify/{id}/{hash}',
    EmailVerificationController::class
)->name('auth.verification.verify');

Route::post(
    '/auth/register',
    RegisterUserController::class
)->name('auth.register');

Route::post(
    '/auth/login',
    LoginController::class
)->name('auth.login');

