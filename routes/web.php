<?php

use App\Http\Controllers\ChirperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // TOUTES MES ROUTES SERONT DECLAREES ICI

    Route::get('/', [\App\Http\Controllers\ChirperController::class, 'index'])
        ->name('dashboard');
    Route::get('/favs', [\App\Http\Controllers\FavsController::class, 'index'])
        ->name('favs');
    Route::resource("posts", ChirperController::class);
    Route::resource("posts_answers", PostController::class);

});
