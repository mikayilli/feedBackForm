<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\LoginController::class, "index"])->middleware('guest')->name('login');
Route::post('login', [\App\Http\Controllers\LoginController::class, "login"])->middleware('guest');
Route::get('logout', [\App\Http\Controllers\LoginController::class, "logout"])->middleware('auth');

Route::get('/',  [\App\Http\Controllers\ReviewController::class, "index"]);
Route::post('/reviews',  [\App\Http\Controllers\ReviewController::class, "store"])->name('reviews');

Route::group(["middleware" => ["auth"]], function(){
    Route::get('/reviews/{review}/edit',  [\App\Http\Controllers\ReviewController::class, "edit"])->name('reviews.edit');
    Route::put('/reviews/{review}/update',  [\App\Http\Controllers\ReviewController::class, "update"])->name('reviews.update');
});
