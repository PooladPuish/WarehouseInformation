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

Route::prefix('store')->group(function () {
    Route::get('wizard', 'StoreController@wizard')->name('admin.store.user.wizard');
    Route::get('show', 'StoreController@show')->name('admin.store.user.show');
    Route::get('details/{id?}', 'StoreController@details')->name('admin.store.user.details');
    Route::post('store', 'StoreController@store')->name('admin.store.user.store');
});
