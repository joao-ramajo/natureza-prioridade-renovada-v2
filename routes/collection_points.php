<?php

use App\CollectionPoint\Infrastructure\Http\Controllers\DeleteDeleteCollectionPoint;
use App\CollectionPoint\Infrastructure\Http\Controllers\GetLoadCollectionPointByUuid;
use App\CollectionPoint\Infrastructure\Http\Controllers\GetLoadCollectionPoints;
use App\CollectionPoint\Infrastructure\Http\Controllers\PostCreateCollectionPoint;
use App\CollectionPoint\Infrastructure\Http\Controllers\PutUpdateCollectionPoint;
use Illuminate\Support\Facades\Route;

Route::get(
    '/collection-points',
    GetLoadCollectionPoints::class
)->name('collection_points.list');

Route::get(
    '/collection-points/{uuid}',
    GetLoadCollectionPointByUuid::class
)->name('collection_points.find');

Route::post(
    '/collection-points',
    PostCreateCollectionPoint::class
)
->middleware(['auth:sanctum'])
->name('collection_points.create');

Route::put(
    '/collection-points/{uuid}',
    PutUpdateCollectionPoint::class
)
->middleware(['auth:sanctum'])
->name('collection_points.update');

Route::delete(
    '/collection-points/{uuid}',
    DeleteDeleteCollectionPoint::class
)
->middleware(['auth:sanctum'])
->name('collection_points.delete');
