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


Route::get('/usuarios', 'APIController@getUsuarios')->middleware('auth.basic.once')->middleware('es_admin');
Route::post('/usuarios', 'APIController@storeUsuario');
Route::put('/usuarios/{id}', 'APIController@putUsuario')->middleware('auth.basic.once')->middleware('es_admin');
Route::delete('/usuarios/{id}', 'APIController@deleteUsuario')->middleware('auth.basic.once')->middleware('es_admin');


Route::get('/pistas', 'APIController@getPistas');

Route::get('/mensajes', 'APIController@getMensajes')->middleware('auth.basic.once');
