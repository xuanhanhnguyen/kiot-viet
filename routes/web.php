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
    /**
     * Sản phẩm
     */
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('goadd', 'ProductController@goadd')->name('admin.product.goadd');
        Route::post('add', 'ProductController@add')->name('admin.product.add');
        Route::get('goedit/{id}', 'ProductController@goedit')->name('admin.product.goedit');
        Route::post('edit/{id}', 'ProductController@edit')->name('admin.product.edit');
        Route::get('delete/{id}', 'ProductController@delete')->name('admin.product.delete');
    });

    /**
     * Khách hàng
     */

    Route::prefix('customer')->group(function () {
        Route::get('/', 'CustomerController@index')->name('admin.customer.index');
        Route::get('goadd', 'CustomerController@goadd')->name('admin.customer.goadd');
        Route::post('add', 'CustomerController@add')->name('admin.customer.add');
        Route::get('goedit/{id}', 'CustomerController@goedit')->name('admin.customer.goedit');
        Route::post('edit/{id}', 'CustomerController@edit')->name('admin.customer.edit');
        Route::get('delete/{id}', 'CustomerController@delete')->name('admin.customer.delete');
    });

    /**
     * Nhà cung cấp
     */

    Route::prefix('supplier')->group(function () {
        Route::get('/', 'SupplierController@index')->name('admin.supplier.index');
        Route::get('goadd', 'SupplierController@goadd')->name('admin.supplier.goadd');
        Route::post('add', 'SupplierController@add')->name('admin.supplier.add');
        Route::get('goedit/{id}', 'SupplierController@goedit')->name('admin.supplier.goedit');
        Route::post('edit/{id}', 'SupplierController@edit')->name('admin.supplier.edit');
        Route::get('delete/{id}', 'SupplierController@delete')->name('admin.supplier.delete');
    });

    /**
     * Phần giao dịch
     */

    Route::group(['prefix' => 'giao_dich'], function () {
        Route::get('/', 'Admin\GiaoDichController@index')->name('giao_dich.index');
        Route::get('/them', 'Admin\GiaoDichController@create')->name('giao_dich.create');
        Route::post('/them', 'Admin\GiaoDichController@store')->name('giao_dich.store');
        Route::get('/{id}', 'Admin\GiaoDichController@show')->name('giao_dich.show');
        Route::get('/{id}/delete', 'Admin\GiaoDichController@destroy')->name('giao_dich.delete');
    });
});
