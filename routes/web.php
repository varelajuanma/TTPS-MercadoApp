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

use App\Publicacion;

Route::get('/', 'HomeController@comprador')->name('home.comprador');

Auth::routes();

Route::get('/publicaciones/create', 'PublicacionController@create')->name('publicacion.create');
Route::get('/publicaciones/{publicacion}', 'PublicacionController@show')->name('publicacion.show');
Route::get('vendedor/publicaciones/{publicacion}', 'PublicacionController@showVistaVendedor')->name('publicacion.showVistaVendedor');
Route::post('/publicaciones', 'PublicacionController@store')->name('publicacion.store');
Route::get('/publicaciones/{publicacion}/edit', 'PublicacionController@edit')->name('publicacion.edit');
Route::put('/publicaciones/{publicacion}', 'PublicacionController@update')->name('publicacion.update');
Route::put('/publicaciones/{publicacion}/habilitar', 'PublicacionController@habilitar')->name('publicaciones.habilitar');
Route::put('/publicaciones/{publicacion}/deshabilitar', 'PublicacionController@deshabilitar')->name('publicaciones.deshabilitar');
Route::get('/buscar', 'PublicacionController@buscar')->name('publicacion.buscar');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/miperfil', 'PerfilesController@miperfil')->name('miperfil');
Route::get('/miperfil/edit', 'PerfilesController@editarmiperfil');
Route::put('/miperfil', 'PerfilesController@guardarmodificacion');
Route::get('/perfiles/{user}', 'PerfilesController@index');


Route::get('/productos/create', 'ProductosController@create');
Route::get('/comprador', 'HomeController@comprador')->name('home.comprador');
Route::get('/vendedor', 'HomeController@vendedor')->name('home.vendedor');
Route::get('/vendedor/mispublicaciones', 'HomeController@mispublicaciones')->name('mispublicaciones');
Route::get('/vendedor/mispublicaciones/inactivas', 'HomeController@misPublicacionesInactivas')->name('mispublicacionesinactivas');
Route::get('/vendedor/mispublicaciones/sinstock', 'HomeController@misPublicacionesSinStock')->name('mispublicacionessinstock');
Route::get('/vendedor/paneldegestiondeprecios', 'PreciosController@paneldegestiondeprecios')->name('paneldegestiondeprecios');
Route::post('/vendedor/paneldegestiondeprecios/setearprecios', 'PreciosController@setearTipoDePrecio')->name('vendedor.setearprecios');
Route::post('/vendedor/paneldegestiondeprecios/aumentarprecios', 'PreciosController@aumentarprecios')->name('vendedor.aumentarprecios');
Route::post('/vendedor/paneldegestiondeprecios/disminuirprecios', 'PreciosController@disminuirprecios')->name('vendedor.disminuirprecios');

Route::get('/vendedor/reportes', 'ReportesController@show')->name('vendedor.reportes');
Route::get('/vendedor/reportes/porpublicacion', 'ReportesController@porpublicacion')->name('reportes.porpublicacion');
Route::get('/vendedor/reportes/porcomprador', 'ReportesController@porcomprador')->name('reportes.porcomprador');
Route::get('/vendedor/reportes/porcategoria', 'ReportesController@porcategoria')->name('reportes.porcategoria');



Route::get('/mibilleteravirtual', 'BilleteraController@mibilleteravirtual')->name('mibilletera');
Route::put('/mibilleteravirtual/ingresarDinero', 'BilleteraController@ingresar')->name('saldo.ingresar');
Route::put('/mibilleteravirtual/retirarDinero', 'BilleteraController@retirar')->name('saldo.retirar');
Route::get('/mibilleteravirtual/canjearpuntos', 'BilleteraController@canjearpuntos')->name('billetera.canjearpuntos');
Route::post('/mibilleteravirtual/canjearpuntos', 'BilleteraController@efectuarcanje')->name('billetera.canjearpuntos');

Route::get('/productos/{producto}/edit', 'ProductosController@edit')->name('productos.edit');	//este estaria de mas
Route::delete('/productos/{producto}', 'ProductosController@destroy')->name('productos.destroy');//este estaria de mas
Route::patch('/productos/{producto}', 'ProductosController@update')->name('productos.update');//este estaria de mas


Route::get('/comprador/historialdecompras', 'HistorialesController@showhistorialdecompras')->name('historialdecompras');
Route::get('/vendedor/historialdeventas/{publicacion}', 'HistorialesController@showhistorialdeventas')->name('historialdeventas');
Route::get('/miperfil/historialdetransacciones', 'HistorialesController@showhistorialdetransacciones')->name('historialdetransacciones');
Route::get('/filtrar', 'PublicacionController@filtrar')->name('filtrar');
Route::get('/ordenar', 'PublicacionController@ordenar')->name('ordenar');


Route::get('/publicaciones/{publicacion}/calificar', 'CalificacionesController@calificarpublicacion')->name('calificarpublicacion');
Route::post('/publicaciones/{publicacion}/storecalificacion', 'CalificacionesController@store')->name('storecalificacionpublicacion');


Route::get('/comprador/carrito', 'CarritoController@vercarrito')->name('vercarrito');
Route::post('/comprador/agregaralcarrito', 'CarritoController@agregaralcarrito')->name('agregaralcarrito');
Route::post('/comprador/eliminardelcarrito', 'CarritoController@eliminardelcarrito')->name('eliminardelcarrito');
Route::post('/comprador/comprar', 'CarritoController@comprar')->name('comprar');
Route::post('/comprador/vaciarcarrito', 'CarritoController@vaciarcarrito')->name('vaciarcarrito');


