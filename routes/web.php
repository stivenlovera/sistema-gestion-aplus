<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'AuthController@index')->name('auth.login.show'); //añadir midelware
Route::post('/login', 'AuthController@login')->name('auth.login');
Route::get('/logout', 'AuthController@logout')->name('auth.logout');

Route::get('/home', 'HomeController@index')->name('home');
/*
 *clientes
 */
Route::middleware('auth')->prefix('cliente')->group(function () {
    Route::get('/', 'cliente\clienteController@index')->name('cliente');
    Route::get('/lista', 'cliente\clienteController@datatable')->name('cliente.lista');
    Route::post('/store', 'cliente\clienteController@store')->name('cliente.store');
    Route::get('/edit/{id}', 'cliente\clienteController@edit')->name('cliente.edit');
    Route::put('/update/{id}', 'cliente\clienteController@update')->name('cliente.lista');
    Route::delete('/delete/{id}', 'cliente\clienteController@destroy')->name('cliente.lista');
});
/*
 *Cotizaciones
 */
Route::middleware('auth')->prefix('cotizacion')->group(function () {
    Route::get('/', 'proyecto\cotizacionController@index')->name('cotizacion');
    Route::get('/lista', 'proyecto\cotizacionController@datatable')->name('cotizacion.lista');
    Route::get('/create', 'proyecto\cotizacionController@create')->name('cotizacion.create');
    Route::post('/store', 'proyecto\cotizacionController@store')->name('cotizacion.store');
    Route::get('/edit/{id}', 'proyecto\cotizacionController@edit')->name('cotizacion.edit');
    Route::put('/update/{id}', 'proyecto\cotizacionController@update')->name('cotizacion.lista');
    Route::delete('/delete/{id}', 'proyecto\cotizacionController@destroy')->name('cotizacion.lista');
    /*select */
    Route::post('/tipo-servicio', 'proyecto\cotizacionController@tipo_servicio')->name('cotizacion.servicio');
    Route::post('/cliente', 'proyecto\cotizacionController@cliente')->name('cotizacion.cliente');
    Route::post('/contacto', 'proyecto\cotizacionController@contacto')->name('cotizacion.contacto');
});
Route::middleware('auth')->prefix('proyecto')->group(function () {
    Route::get('/', 'proyecto\proyectoController@index')->name('proyecto');
    Route::get('/data-table', 'proyecto\proyectoController@datatable')->name('proyecto.lista');
    Route::post('/store', 'proyecto\proyectoController@store')->name('proyecto.store');
    Route::get('/edit/{id}', 'proyecto\proyectoController@edit')->name('proyecto.edit');
    Route::put('/update/{id}', 'proyecto\proyectoController@update')->name('proyecto.lista');
    Route::delete('/delete/{id}', 'proyecto\proyectoController@destroy')->name('proyecto.lista');
});

Route::middleware('auth')->prefix('servicio')->group(function () {
    Route::get('/', 'proyecto\servicioController@index')->name('servicio');
    Route::get('/data-table', 'proyecto\servicioController@datatable')->name('servicio.lista');
    Route::post('/store', 'proyecto\servicioController@store')->name('servicio.store');
    Route::get('/edit/{id}', 'proyecto\servicioController@edit')->name('servicio.edit');
    Route::put('/update/{id}', 'proyecto\servicioController@update')->name('servicio.lista');
    Route::delete('/delete/{id}', 'proyecto\servicioController@destroy')->name('servicio.lista');
});

Route::middleware('auth')->prefix('actividad')->group(function () {
    Route::post('/iniciar', 'actividad\actividadController@iniciar')->name('actividad.iniciar');
    Route::post('/pausar', 'actividad\actividadController@pausar')->name('actividad.pausar');
    Route::post('/parar', 'actividad\actividadController@parar')->name('actividad.parar');
    Route::get('/data-table', 'actividad\actividadController@datatable')->name('actividad.lista');
    Route::post('/store', 'actividad\actividadController@store')->name('actividad.store');
    Route::get('/edit/{id}', 'actividad\actividadController@edit')->name('actividad.edit');
    Route::put('/update/{id}', 'actividad\actividadController@update')->name('actividad.lista');
    Route::delete('/delete/{id}', 'actividad\actividadController@destroy')->name('actividad.lista');
    Route::get('/{id}', 'actividad\actividadController@index')->name('actividad');
});

Route::middleware('auth')->prefix('contacto')->group(function () {
    Route::get('/', 'cliente\contactoController@index')->name('contacto');
    Route::get('/lista', 'cliente\contactoController@datatable')->name('contacto.lista');
    Route::post('/store', 'cliente\contactoController@store')->name('contacto.store');
    Route::get('/edit/{id}', 'cliente\contactoController@edit')->name('contacto.edit');
    Route::put('/update/{id}', 'cliente\contactoController@update')->name('contacto.lista');
    Route::delete('/delete/{id}', 'cliente\contactoController@destroy')->name('contacto.lista');
});
