<?php

use App\CollectionPoint\Infrastructure\Http\Controllers\CreateCollectionPointController;
use App\CollectionPoint\Infrastructure\Http\Controllers\DeleteCollectionPointController;
use App\CollectionPoint\Infrastructure\Http\Controllers\GetCollectionPointController;
use App\CollectionPoint\Infrastructure\Http\Controllers\ListCollectionPointController;
use App\CollectionPoint\Infrastructure\Http\Controllers\UpdateCollectionPointController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/collection-points',
    ListCollectionPointController::class
)->name('collection_points.list');

Route::get(
    '/collection-points/{uuid}',
    GetCollectionPointController::class
)->name('collection_points.find');

Route::post(
    '/collection-points',
    CreateCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.create');

Route::put(
    '/collection-points/{uuid}',
    UpdateCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.update');

Route::delete(
    '/collection-points/{uuid}',
    DeleteCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.delete');
