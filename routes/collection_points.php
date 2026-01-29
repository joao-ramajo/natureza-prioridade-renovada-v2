<?php

use App\Http\Controllers\CollectionPoint\ApproveCollectionPointController;
use App\Http\Controllers\CollectionPoint\ContestCollectionPointController;
use App\Http\Controllers\CollectionPoint\CreateCollectionPointController;
use App\Http\Controllers\CollectionPoint\DeleteCollectionPointController;
use App\Http\Controllers\CollectionPoint\GetCollectionPointController;
use App\Http\Controllers\CollectionPoint\ListCollectionPointController;
use App\Http\Controllers\CollectionPoint\ReproveCollectionPointController;
use App\Http\Controllers\CollectionPoint\UpdateCollectionPointController;
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
    '/collection-points/{uuid}/reprove',
    ReproveCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.reprove');

Route::put(
    '/collection-points/{uuid}/approve',
    ApproveCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.approve');

Route::put(
    '/collection-points/{uuid}/contest',
    ContestCollectionPointController::class
)
->middleware(['auth:sanctum'])
->name('collection_points.contest');

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
