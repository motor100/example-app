<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

// Route для редиректа
Route::get('/abc{model}', [MainController::class, 'link_redirect']);
