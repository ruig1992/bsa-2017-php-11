<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::prefix('cars')->group(function () {
    Route::get('/', 'CarController@index')->name('cars.index');
    Route::get('/{car}', 'CarController@show')->name('cars.show');

    Route::get('/create', 'CarController@create')->name('cars.create');
    Route::post('/', 'CarController@store')->name('cars.store');

    Route::get('/{car}/edit', 'CarController@edit')->name('cars.edit');
    Route::patch('/{car}', 'CarController@update')->name('cars.update');

    //Route::delete('/{car}', 'CarController@destroy')->name('cars.destroy');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('app.index');

Route::resource('cars', 'CarController');

Route::get('/auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
