<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

//     Route::controller(CityController::class)->group(function () {
//     Route::get('/cities', 'index')->name('cities.index');
//     Route::get('/cities/create', 'create')->name('cities.create');
//     Route::post('/cities', 'store')->name('cities.store');
//     Route::get('/cities/{uuid}', 'show')->name('cities.show');
//     Route::get('/cities/{uuid}/edit', 'edit')->name('cities.edit');
//     Route::put('/cities/{uuid}', 'update')->name('cities.update');
//     Route::delete('/cities/{uuid}', 'destroy')->name('cities.destroy');
//     Route::get('/cities/search', 'Search')->name('cities.search');
//     Route::get('/areas/{city}', 'getAreas')->name('city.areas');
// });


//********** Area Routes **********//
Route::middleware('auth:sanctum')->get();

});
