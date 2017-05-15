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

Route::get('/', function () {
    return view('welcome');
});

//get base url/index page
//Route::get('/', 'homecontroller@index');

//get about page
//Route::get('create-account', 'homecontroller@create_account');

Route::resource('client', 'clientcontroller');

Route::resource('login', 'logincontroller');

Route::resource('profile', 'profilecontroller');

Route::resource('loan', 'loancontroller');

