<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


//front end rute start
Route::get('/', function () {
    return view('layouts.website');
})->name('website');


Auth::routes();

//backend route start
Route::get('/home', 'HomeController@index')->name('home');
