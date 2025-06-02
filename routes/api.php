<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserContoller;
// use App\Http\Controllers\Auth\
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
//********** Area Routes **********//    
Route::controller(AreaController::class)->group(function () {
  Route::get('/areas', 'index')->name('areas.all');
  Route::get('/area/{name}', 'show')->name('areas.show')->middleware('auth');
  Route::get('/area/create', 'create')->name('area.create')->middleware('auth');
  Route::post('/area/create', 'store')->name('area.store')->middleware('auth');
  Route::get('/area/edit/{name}', 'edit')->name('area.edit')->middleware('auth');
  Route::post('/area/edit/{name}', 'update')->name('area.update')->middleware('auth');
  Route::get('/area/delete/{name}', 'destroy')->name('area.delete')->middleware('auth');
});
//********** City Routes **********//    
Route::controller(CityController::class)->group(function () {
  Route::get('/cities', 'index')->name('cities.all');
  Route::get('/city/{name}', 'show')->name('citys.show')->middleware('auth');
  Route::get('/city/create', 'create')->name('city.create')->middleware('auth');
  Route::post('/city/create', 'store')->name('city.store')->middleware('auth');
  Route::get('/city/edit/{name}', 'edit')->name('city.edit')->middleware('auth');
  Route::post('/city/edit/{name}', 'update')->name('city.update')->middleware('auth');
  Route::get('/city/delete/{name}', 'destroy')->name('city.delete')->middleware('auth');
});

//********** User Routes **********//   
Route::controller(UserContoller::class)->group(function () {
  Route::post('/register', 'register')->name('register');
  Route::get('/profile','showProfile')->name('showProfile');
  Route::post('/profile/update','updateProfile')->name('updateProfile');
  Route::post('/profile/password/update','updatePassword')->name('updatePassword');
  Route::post('/profile/image/updload','storeImage')->name('uploadImage');
  Route::get('/profile/delete','destroy')->name('deleteProfile');
});