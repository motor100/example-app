<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

// Route для редиректа
Route::get('/abc{model}', [MainController::class, 'link_redirect']);

// Тестирование замыканий callback/closure
Route::get('/callback', [MainController::class, 'callback']);

// Тестирование замыканий callback
Route::get('/callback2', [MainController::class, 'callback2']);

// Тестирование замыканий closure
Route::get('/callback3', [MainController::class, 'callback3']);

// Тестирование замыканий closure
Route::get('/callback4', [MainController::class, 'callback4']);