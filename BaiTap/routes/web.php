<?php
use App\Http\Controllers\BrandsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/{any}', function () {
    return redirect()->route('login');
})->where('any', '^(|home)$');

Route::middleware(['authentication'])->group(function () {
    Route::resource('brands', BrandsController::class);
});
