<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/search', [SearchController::class, 'query'])->name('search');
Route::get('/article/{id}', [SearchController::class, 'detail'])->name('article.detail');
