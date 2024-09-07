<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SongcategoryController;
use Illuminate\Support\Facades\Route;

    


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('homePages');
Route::get('/playlist', [HomeController::class, 'playlist'])->middleware('auth')->name('playlistPages');
Route::get('/script', [HomeController::class, 'script'])->middleware('auth')->name('scriptPages');
Route::get('/editscript/{id}', [HomeController::class, 'editscript'])->middleware('auth')->name('editscriptPages');


Route::get('login', [LoginController::class, 'loginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->middleware('guest')->name('loginPost');
Route::get('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logoutPost');

// Route::get('/song', [HomeController::class, 'song'])->middleware('auth')->name('songPages');
Route::get('/song', [SongcategoryController::class, 'index'])->middleware('auth')->name('song');
