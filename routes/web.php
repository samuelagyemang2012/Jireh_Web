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

Route::post('/client-loan-details', 'admincontroller@client_details')->name('details');

Route::post('/approve', 'admincontroller@approve_loan')->name('approve');

Route::post('/refuse', 'admincontroller@refuse_loan')->name('refuse');

Route::get('/add_admin', 'admincontroller@show_admin_view')->name('add_admin_view');

Route::post('/add_admin_action', 'admincontroller@add_admin')->name('add_admin');

Route::get('/edit', 'admincontroller@show_edit_details')->name('edit');

Route::post('/edit_admin_action', 'admincontroller@edit_admin')->name('edit_admin');

Route::get('/all_loans_excel', 'admincontroller@export_excel')->name('export_excel');

Route::get('/pdf', 'admincontroller@export_pdf')->name('export_pdf');

Route::get('/mail', 'admincontroller@mail')->name('mail');

Route::get('/client_log', 'admincontroller@client_log')->name('client_log');

Route::get('admin_log', 'admincontroller@admin_log')->name('admin_log');

Route::get('manage-clients', 'admincontroller@manage_clients')->name('manage_clients');

Route::get('client-details', 'admincontroller@single_client_details')->name('single');

Route::post('update', 'admincontroller@update')->name('update');

Route::get('admin-logout', 'admincontroller@logout')->name('logout');

Route::get('logout', 'logincontroller@logout')->name('user_logout');

Route::get('test', 'admincontroller@test')->name('test');

//APIs

Route::post('api/jireh', ['uses' => 'logincontroller@store','middleware'=>'simpleauth']);


