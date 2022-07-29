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
    Route::post('/store', 'proyecto\cotizacionController@store')->name('cotizacion.store');
    Route::get('/edit/{id}', 'proyecto\cotizacionController@edit')->name('cotizacion.edit');
    Route::put('/update/{id}', 'proyecto\cotizacionController@update')->name('cotizacion.lista');
    Route::delete('/delete/{id}', 'proyecto\cotizacionController@destroy')->name('cotizacion.lista');
});
Route::middleware('auth')->prefix('proyecto')->group(function () {
    Route::get('/', 'proyecto\proyectoController@index')->name('proyecto');
    Route::get('/lista', 'proyecto\proyectoController@datatable')->name('proyecto.lista');
    Route::post('/store', 'proyecto\proyectoController@store')->name('proyecto.store');
    Route::get('/edit/{id}', 'proyecto\proyectoController@edit')->name('proyecto.edit');
    Route::put('/update/{id}', 'proyecto\proyectoController@update')->name('proyecto.lista');
    Route::delete('/delete/{id}', 'proyecto\proyectoController@destroy')->name('proyecto.lista');
});

Route::middleware('auth')->prefix('servicio')->group(function () {
    Route::get('/', 'proyecto\servicioController@index')->name('servicio');
    Route::get('/lista', 'proyecto\servicioController@datatable')->name('servicio.lista');
    Route::post('/store', 'proyecto\servicioController@store')->name('servicio.store');
    Route::get('/edit/{id}', 'proyecto\servicioController@edit')->name('servicio.edit');
    Route::put('/update/{id}', 'proyecto\servicioController@update')->name('servicio.lista');
    Route::delete('/delete/{id}', 'proyecto\servicioController@destroy')->name('servicio.lista');
});

Route::middleware('auth')->prefix('contacto')->group(function () {
    Route::get('/', 'cliente\contactoController@index')->name('contacto');
    Route::get('/lista', 'cliente\contactoController@datatable')->name('contacto.lista');
    Route::post('/store', 'cliente\contactoController@store')->name('contacto.store');
    Route::get('/edit/{id}', 'cliente\contactoController@edit')->name('contacto.edit');
    Route::put('/update/{id}', 'cliente\contactoController@update')->name('contacto.lista');
    Route::delete('/delete/{id}', 'cliente\contactoController@destroy')->name('contacto.lista');
});
