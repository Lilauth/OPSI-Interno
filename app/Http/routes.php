<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Funciones;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('client', 'ClientController');
Route::resource('mensajes', 'MensajeTelefonicoController');
Route::resource('asistencias', 'AsistenciaController');
Route::resource('estadostrabajo', 'EstadoTrabajoController');
Route::resource('sistemas', 'SistemaController');
Route::resource('trabajos', 'TrabajoController');
Route::resource('tareasdet', 'TareaDetController');
Route::get('trabajosCliente', 'TareaDetController@trabajosCliente');
//Route::get('dropdown', 'TareaDetController@pruebaDropdown');