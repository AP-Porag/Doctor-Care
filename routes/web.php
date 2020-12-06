<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


//front end rute start
Route::get('/', function () {
    return view('frontend.index');
})->name('website');

Auth::routes();
// Auth::routes(['verify' => true]);

//backend route start
Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('supplier', 'Admin\Supplier\SupplierController');
// Route::get('/supplier/soft-delete/{id}', 'Admin\Supplier\SupplierController@softDelete')->name('supplier_soft_delete');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('supplier', 'Admin\Supplier\SupplierController');
    Route::get('/supplier/soft-delete/{id}', 'Admin\Supplier\SupplierController@softDelete')->name('supplier_soft_delete');
    Route::get('/supplier/restore/{id}', 'Admin\Supplier\SupplierController@restore')->name('restore');
    Route::get('/supplier/force-delete/{id}', 'Admin\Supplier\SupplierController@forceDelete')->name('forceDelete');
    Route::get('/supplier/inactive/suppliers', 'Admin\Supplier\SupplierController@inactive')->name('inactive');
});
