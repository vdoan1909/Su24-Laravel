<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'admin_auth'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::prefix('catalogue')
            ->as('catalogues.')
            ->group(function () {
                Route::get('/', [CatalogueController::class, 'index'])->name('index');
                Route::get('create', [CatalogueController::class, 'create'])->name('create');
                Route::post('store', [CatalogueController::class, 'store'])->name('store');
                Route::get('show/{id}', [CatalogueController::class, 'show'])->name('show');
                Route::get('edit/{id}', [CatalogueController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [CatalogueController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [CatalogueController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('product')
            ->as('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('create', [ProductController::class, 'create'])->name('create');
                Route::post('store', [ProductController::class, 'store'])->name('store');
                Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
                Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
            });
    });

Route::prefix('/')
    ->as('client.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
    });
