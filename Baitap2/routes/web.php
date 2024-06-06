<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Auth::routes();
Route::prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'check_auth_admin']);
    });

Route::prefix('/')
    ->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });
        Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    });
