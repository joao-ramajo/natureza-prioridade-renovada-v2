<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\CollectionPoint\CreateCollectionPointController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/auth/register', [RegisterUserController::class, 'handle'])->name('auth.register');
Route::post('/auth/login', [LoginController::class, 'handle'])->name('auth.login');

// Collection Point
Route::post('/collection-points', [CreateCollectionPointController::class, 'handle'])->name('collection_points.create')->middleware(['auth:sanctum']);