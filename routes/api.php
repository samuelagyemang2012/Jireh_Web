<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/test', 'apicontroller@test');

Route::post('/login/{email}/{password}', 'apicontroller@login');

Route::post('/add-client', 'apicontroller@sign_up');

Route::post('/getloans/{email}', 'apicontroller@get_loans');

Route::post('/add-loan', 'apicontroller@loan');

Route::post('/upload', 'apicontroller@upload');