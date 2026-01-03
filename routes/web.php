<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('cadastro', function() {
    return view ('auth.register');
})->name('web.register');

Route::get('login', function() {
    return view('auth.login');
})->name('web.login');

Route::get('home', function() {
    return view('web.home');
})->name('web.home');

Route::get('/ponto-de-coleta/{uuid}', function ($uuid) {
    return view('collection_point.show', ['uuid' => $uuid]);
})->name('web.collection_point.show');
