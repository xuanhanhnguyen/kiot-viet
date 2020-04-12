<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'giao_dich'], function () {
        /**
         * Phần giao dịch
         */
        Route::get('/', 'Admin\GiaoDichController@index')->name('giao_dich.index');
        Route::get('/them', 'Admin\GiaoDichController@create')->name('giao_dich.create');
        Route::post('/', 'Admin\GiaoDichController@store')->name('giao_dich.store');
        Route::get('/{id}', 'Admin\GiaoDichController@show')->name('giao_dich.show');
    });
});
