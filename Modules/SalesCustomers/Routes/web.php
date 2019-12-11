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

Route::prefix('salescustomers')->group(function () {
    Route::get('index', 'SalesCustomersController@index')->name('admin.sales.user.index');
    Route::get('show', 'SalesCustomersController@show')->name('admin.sales.user.show');
    Route::get('success/{id?}', 'SalesCustomersController@success')->name('admin.sales.user.success');
    Route::get('error/{id?}', 'SalesCustomersController@error')->name('admin.sales.user.error');
    Route::get('wizard/{id?}', 'SalesCustomersController@wizard')->name('admin.sales.user.wizard');
    Route::post('store', 'SalesCustomersController@store')->name('admin.sales.user.store');
});
