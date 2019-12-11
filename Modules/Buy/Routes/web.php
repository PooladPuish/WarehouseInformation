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

Route::prefix('buy')->group(function () {
    Route::get('index', 'BuyController@index')->name('admin.buy.user.index');
    Route::get('show', 'BuyController@show')->name('admin.buy.user.show');
    Route::get('success/{id?}', 'BuyController@success')->name('admin.buy.user.success');
    Route::get('error/{id?}', 'BuyController@error')->name('admin.buy.user.error');
});
