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
    return view('admin_views.admin-login');
});

Route::resource('client', 'clientcontroller');

Route::resource('/jireh/login', 'logincontroller');

Route::resource('/jireh/profile', 'profilecontroller');

Route::resource('/jireh/loans', 'loancontroller');

Route::resource('/jireh/admin', 'admincontroller');

Route::get('/jireh/admin/loans/pending_loans', 'admincontroller@pending')->name("pending");

Route::get('/jireh/admin/loans/approved_loans', 'admincontroller@approved')->name('approved');

Route::get('/jireh/admin/loans/refused_loans', 'admincontroller@refused')->name('refused');

Route::get('/jireh/admin/loans/all_loans', 'admincontroller@all')->name('all');

Route::get('/jireh/client/client-loan-details', 'admincontroller@client_details')->name('details');

Route::get('/jireh/client/details/{email}', 'admincontroller@view_client_details')->name('view_client_details');

Route::get('/jireh/client/pending_client', 'admincontroller@pending_client_details')->name('pending_details');

Route::post('/approve', 'admincontroller@approve_loan')->name('approve');

Route::post('/refuse', 'admincontroller@refuse_loan')->name('refuse');

Route::get('/jireh/add_admin', 'admincontroller@show_admin_view')->name('add_admin_view');

Route::post('/add_admin_action', 'admincontroller@add_admin')->name('add_admin');

Route::get('/jireh/edit', 'admincontroller@show_edit_details')->name('edit');

Route::post('/edit_admin_action', 'admincontroller@edit_admin')->name('edit_admin');

Route::get('/all_loans_excel', 'admincontroller@export_excel')->name('export_excel');

Route::get('/pdf', 'admincontroller@export_pdf')->name('export_pdf');

Route::get('/mail', 'admincontroller@mail')->name('mail');

Route::get('/jireh/client_logs', 'admincontroller@client_log')->name('client_log');

Route::get('/jireh/admin_logs', 'admincontroller@admin_log')->name('admin_log');

Route::get('/jireh/manage-clients', 'admincontroller@manage_clients')->name('manage_clients');

Route::get('client-details', 'admincontroller@single_client_details')->name('single');

Route::post('update', 'admincontroller@update')->name('update');

Route::post('/admin/login', 'admincontroller@admin_login')->name('admin_login');

Route::get('admin-logout', 'admincontroller@logout')->name('admin_logout');

Route::get('logout', 'logincontroller@logout')->name('user_logout');

Route::get('test', 'admincontroller@test')->name('test');

//APIs


Route::get('/home', 'HomeController@index')->name('home');
