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

Route::resource('client', 'clientcontroller');

Route::resource('login', 'logincontroller');

Route::resource('profile', 'profilecontroller');

Route::resource('loan', 'loancontroller');

Route::resource('admin', 'admincontroller');

Route::get('pending_loans', 'admincontroller@pending')->name("pending");

Route::get('approved_loans', 'admincontroller@approved')->name('approved');

Route::get('refuse_loans', 'admincontroller@refused')->name('refused');

Route::get('all_loans', 'admincontroller@all')->name('all');

Route::post('/details', 'admincontroller@client_details')->name('details');

Route::post('/approve', 'admincontroller@approve_loan')->name('approve');

Route::post('/refuse', 'admincontroller@refuse_loan')->name('refuse');

Route::get('/add_admin', 'admincontroller@show_admin_view')->name('add_admin_view');

Route::post('/add_admin_action', 'admincontroller@add_admin')->name('add_admin');

Route::get('/edit', 'admincontroller@show_edit_details')->name('edit');

Route::post('/edit_admin_action', 'admincontroller@edit_admin')->name('edit_admin');

Route::get('/all_loans_excel', 'admincontroller@export_excel')->name('export_excel');
