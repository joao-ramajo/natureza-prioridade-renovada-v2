<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\CollectionPoint\ApproveCollectionPointController;
use App\Http\Controllers\CollectionPoint\CreateCollectionPointController;
use App\Http\Controllers\CollectionPoint\DeleteCollectionPointController;
use App\Http\Controllers\CollectionPoint\GetCollectionPointController;
use App\Http\Controllers\CollectionPoint\ListCollectionPointController;
use App\Http\Controllers\CollectionPoint\ReproveCollectionPointController;
use App\Http\Controllers\CollectionPoint\UpdateCollectionPointController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/auth/register', [RegisterUserController::class, 'handle'])->name('auth.register');
Route::post('/auth/login', [LoginController::class, 'handle'])->name('auth.login');
Route::get('/auth/verify/{id}/{hash}', [EmailVerificationController::class, 'handle'])->name('auth.verification.verify');

// Collection Point
Route::put('/collection-points/reprove/{uuid}', [ReproveCollectionPointController::class, 'handle'])->name('collection_points.reprove')->middleware(['auth:sanctum', 'verified']);
Route::put('/collection-points/approve/{uuid}', [ApproveCollectionPointController::class, 'handle'])->name('collection_points.approve')->middleware(['auth:sanctum', 'verified']);
Route::get('/collection-points', [ListCollectionPointController::class, 'handle'])->name('collection_points.list');
Route::get('/collection-points/{uuid}', [GetCollectionPointController::class, 'handle'])->name('collection_points.find');
Route::post('/collection-points', [CreateCollectionPointController::class, 'handle'])->name('collection_points.create')->middleware(['auth:sanctum', 'verified']);
Route::delete('/collection-points/{uuid}', [DeleteCollectionPointController::class, 'handle'])->name('collection_points.delete')->middleware('auth:sanctum', 'verified');
Route::put('/collection-points/{uuid}', [UpdateCollectionPointController::class, 'handle'])->name('collection_points.update')->middleware('auth:sanctum', 'verified');
