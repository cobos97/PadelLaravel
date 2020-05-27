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


Route::get('/admin/complejos', 'AdminController@indexComplejos')->name('complejosAdmin')->middleware('es_admin');
Route::delete('/deleteComplejo/{id}', 'AdminController@deleteComplejo')->middleware('es_admin');

Route::get('/admin/complejos/nuevocomplejo', 'AdminController@indexNuevoComplejo')->name('nuevocomplejo')->middleware('es_admin');
Route::post('/admin/complejos/nuevocomplejo', 'AdminController@insertarComplejo')->middleware('es_admin');
Route::get('/admin/complejo/{id}', 'AdminController@getComplejo')->name('getcomplejo')->middleware('es_admin');

Route::get('/admin/complejo/{id}/nuevapista', 'AdminController@indexNuevaPista')->name('nuevapista')->middleware('es_admin');
Route::post('/admin/complejo/{id}/nuevapista', 'AdminController@insertarPista')->middleware('es_admin');
Route::delete('/deletePista/{id}', 'AdminController@deletePista')->middleware('es_admin');

Route::get('/admin/editarcomplejo/{id}', 'AdminController@getEditarComplejo')->middleware('es_admin');
Route::put('/admin/editarcomplejo/{id}', 'AdminController@putEditarComplejo')->middleware('es_admin');

Route::get('/admin/editarpista/{id}', 'AdminController@getEditarPista')->middleware('es_admin');
Route::put('/admin/editarpista/{id}', 'AdminController@putEditarPista')->middleware('es_admin');

Route::get('/admin/mensajes', 'AdminController@indexMensajes')->name('mensajesAdmin')->middleware('es_admin');

Route::get('/admin/mensajes/{nombre}/{complejo?}', 'AdminController@filtroGet')->name('filtroGet')->middleware('es_admin');

Route::post('/admin/mensajes', 'AdminController@filtroMensajes')->middleware('es_admin');
Route::post('/admin/mensajes/{nombre?}/{pista?}', 'AdminController@filtroMensajes')->middleware('es_admin');


Route::delete('/deleteMensaje/{id}', 'AdminController@deleteMensaje')->middleware('es_admin');

Route::delete('/deleteMensajeUser/{pista_id}/{id}', 'MensajesController@deleteMensaje');

Route::get('/usuarios', 'UsuariosController@index')->name('usuarios')->middleware('es_admin');
Route::post('/usuarios', 'UsuariosController@getFiltro')->middleware('es_admin');

Route::get('/editarUsuario/{id}', 'UsuariosController@getEditar')->middleware('es_admin');
Route::put('/editarUsuario/{id}', 'UsuariosController@putEditar')->middleware('es_admin');
Route::delete('/deleteUsuario/{id}', 'UsuariosController@deleteUsuario')->middleware('es_admin');
Route::put('/penalizarusuario/{id}', 'UsuariosController@putPenalizar')->middleware('es_admin');
Route::put('/deletepenalizacion/{id}', 'UsuariosController@putDespenalizar')->middleware('es_admin');

Route::get('/mensajes/{id}', 'MensajesController@index')->name('mensajes')->middleware('verified', 'esta_penalizado');
Route::post('/mensajes/{id}', 'MensajesController@enviar')->name('enviarMensaje')->middleware('verified', 'esta_penalizado');

Route::get('/contacta', 'ContactaController@index')->name('contacta');
Route::post('/contacta', 'ContactaController@enviarContacta');
Route::get('/listaContactas', 'ContactaController@getContactas')->name('getContactas')->middleware('es_admin');
Route::delete('/deleteContacta/{id}', 'ContactaController@deleteContacta')->middleware('es_admin');

Route::get('/complejos', 'PistasController@index')->name('complejos');
Route::get('/complejos/action', 'PistasController@action')->name('complejos.action');
Route::get('/complejo/{id}', 'PistasController@getPista')->name('complejo');
Route::get('/pista/{id}', 'PistasController@getPistaConcreta')->name('pista');

Route::get('/reservas/{id}', 'ReservasController@index')->name('reservas')->middleware('verified', 'esta_penalizado');
Route::post('/reservas/{id}', 'ReservasController@reservar')->name('reservar')->middleware('verified', 'esta_penalizado');

Route::get('/admin/reservas', 'ReservasController@getReservas')->name('reservasAdmin')->middleware('es_admin');
Route::delete('/deleteReserva/{id}', 'ReservasController@deleteReserva')->middleware('es_admin');
Route::delete('/deleteReservaUser/{id}', 'ReservasController@deleteReservaUser')->middleware('verified');
Route::post('/admin/reservas', 'ReservasController@filtroReservas')->middleware('es_admin');

Route::get('/user/{id}', 'UserController@index')->middleware('verified');
Route::put('/user/{id}', 'UserController@putEditar')->middleware('verified');

Route::post('/reservasdia', 'PdfController@imprimir')->name('imprimir')->middleware('es_admin');

Route::get('/penalizado', function () {
    return view('penalizado');
})->name('penalizado');

Route::get('/chatadmin', 'ChatController@indexCliente')->name('chatAdmin')->middleware('verified');
Route::post('/chatadmin', 'ChatController@enviarCliente')->name('enviarChatCliente')->middleware('verified');

Route::get('/chats', 'ChatController@indexListaCliente')->name('listaChats')->middleware('es_admin');
Route::post('/chats', 'ChatController@nuevoChat')->name('nuevoChat')->middleware('es_admin');

Route::get('/chat/{id}', 'ChatController@getChat')->name('getChat')->middleware('es_admin');
Route::post('/chat/{id}', 'ChatController@enviarAdmin')->name('enviarChatAdmin')->middleware('es_admin');
Route::delete('deletechat/{id}', 'ChatController@deleteChat')->name('deleteChat')->middleware('es_admin');
