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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('es_admin');

Route::get('/admin/pistas', 'AdminController@indexPistas')->name('pistasAdmin')->middleware('es_admin');
Route::post('/admin/pistas', 'AdminController@insertarPista')->name('insertarPista')->middleware('es_admin');
Route::get('/editarPista/{id}', 'AdminController@getEditar')->middleware('es_admin');
Route::put('/editarPista/{id}', 'AdminController@putEditar')->middleware('es_admin');
Route::delete('/deletePista/{id}', 'AdminController@deletePista')->middleware('es_admin');

Route::get('/admin/mensajes', 'AdminController@indexMensajes')->name('mensajesAdmin')->middleware('es_admin');
Route::post('/admin/mensajes', 'AdminController@filtroMensajes')->middleware('es_admin');
Route::delete('/deleteMensaje/{id}', 'AdminController@deleteMensaje')->middleware('es_admin');

Route::delete('/deleteMensajeUser/{pista_id}/{id}', 'MensajesController@deleteMensaje');

Route::get('/usuarios', 'UsuariosController@index')->name('usuarios')->middleware('es_admin');

Route::get('/editarUsuario/{id}', 'UsuariosController@getEditar')->middleware('es_admin');
Route::put('/editarUsuario/{id}', 'UsuariosController@putEditar')->middleware('es_admin');
Route::delete('/deleteUsuario/{id}', 'UsuariosController@deleteUsuario')->middleware('es_admin');

Route::get('/mensajes/{id}', 'MensajesController@index')->name('mensajes')->middleware('verified');
Route::post('/mensajes/{id}', 'MensajesController@enviar')->name('enviarMensaje')->middleware('verified');

Route::get('/contacta', 'ContactaController@index')->name('contacta');
Route::post('/contacta', 'ContactaController@enviarContacta');
Route::get('/listaContactas', 'ContactaController@getContactas')->name('getContactas')->middleware('es_admin');
Route::delete('/deleteContacta/{id}', 'ContactaController@deleteContacta')->middleware('es_admin');

Route::get('/pistas', 'PistasController@index')->name('pistas')->middleware('verified');
Route::get('/pistas/action', 'PistasController@action')->name('pistas.action')->middleware('verified');
Route::get('/pista/{id}', 'PistasController@getPista')->name('pista')->middleware('verified');

Route::get('/reservas/{id}', 'ReservasController@index')->name('reservas')->middleware('verified');
Route::post('/reservas/{id}', 'ReservasController@reservar')->name('reservar')->middleware('verified');

Route::get('/admin/reservas', 'ReservasController@getReservas')->name('reservasAdmin')->middleware('es_admin');
Route::delete('/deleteReserva/{id}', 'ReservasController@deleteReserva')->middleware('es_admin');
Route::post('/admin/reservas', 'ReservasController@filtroReservas')->middleware('es_admin');

