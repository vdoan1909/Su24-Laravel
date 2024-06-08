<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')
    ->middleware(['auth', 'admin_auth'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');

        Route::prefix('catalogues')
            ->group(function () {
                Route::get('/', [CatalogueController::class, 'index'])->name('admin.catalogues.index');
                Route::get('create', [CatalogueController::class, 'create'])->name('admin.catalogues.create');
                Route::post('store', [CatalogueController::class, 'store'])->name('admin.catalogues.store');
                Route::get('show/{id}', [CatalogueController::class, 'show'])->name('admin.catalogues.show');
                Route::get('edit/{id}', [CatalogueController::class, 'edit'])->name('admin.catalogues.edit');
                Route::put('update/{id}', [CatalogueController::class, 'update'])->name('admin.catalogues.update');
                Route::delete('destroy/{id}', [CatalogueController::class, 'destroy'])->name('admin.catalogues.destroy');
            });
    });

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
