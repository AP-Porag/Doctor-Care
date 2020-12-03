<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


//front end rute start
Route::get('/', function () {
    return view('frontend.index');
})->name('website');

Route::get('/web_login',function (){
    return view('frontend.login');
})->name('web_login');

Auth::routes();

//backend route start
Route::get('/home', 'HomeController@index')->name('home');
