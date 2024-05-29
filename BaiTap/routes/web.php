<?php

use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;

Route::get("/", [BrandsController::class,"index"])->name("brands.index");
Route::resource("brands", BrandsController::class);