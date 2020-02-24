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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/principal', 'PrincipalController@index')->name('principal')->middleware('verified');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('es_admin');
Route::post('/admin', 'AdminController@insertar')->name('insertar')->middleware('es_admin');

Route::get('/editarPista/{id}', 'AdminController@getEditar')->middleware('es_admin');
Route::put('/editarPista/{id}', 'AdminController@putEditar')->middleware('es_admin');
Route::delete('/deletePista/{id}', 'AdminController@deletePista')->middleware('es_admin');
Route::delete('/deleteMensaje/{id}', 'AdminController@deleteMensaje')->middleware('es_admin');

Route::delete('/deleteMensajeUser/{id}', 'MensajesController@deleteMensaje');

Route::get('/usuarios', 'UsuariosController@index')->name('usuarios')->middleware('es_admin');

Route::get('/editarUsuario/{id}', 'UsuariosController@getEditar')->middleware('es_admin');
Route::put('/editarUsuario/{id}', 'UsuariosController@putEditar')->middleware('es_admin');
Route::delete('/deleteUsuario/{id}', 'UsuariosController@deleteUsuario')->middleware('es_admin');

Route::get('/mensajes', 'MensajesController@index')->name('mensajes')->middleware('verified');
Route::post('/mensajes', 'MensajesController@enviar')->name('enviarMensaje')->middleware('verified');

