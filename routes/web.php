<?php

use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'ok',
        'title' => 'NPR',
    ]);
});
