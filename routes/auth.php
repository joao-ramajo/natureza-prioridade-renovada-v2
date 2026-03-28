<?php

use App\Auth\Infrastructure\Http\Controllers\EmailVerificationController;
use App\Auth\Infrastructure\Http\Controllers\LoginController;
use App\Auth\Infrastructure\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

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
