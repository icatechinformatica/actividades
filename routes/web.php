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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Actividades/inicio', 'ActividadesController@index')->name('actividades.inicio');
Route::post('/Actividades/guardar', 'ActividadesController@store')->name('actividades.store');
Route::get('/Actividades/{id}/{semana}', 'ActividadesController@destroy')->name('actividades.destroy');
Route::get('/Actividades/enviar', 'ActividadesController@send')->name('actividades.enviar');
Route::post('/Actividades/editar/{id}/{semana}', 'ActividadesController@update')->name('actividades.editar');
Route::post('/Actividades/editar2', 'ActividadesController@update2')->name('actividades.editar2');

Route::get('/vistoBueno/inicio', 'VtoBuenoController@index')->name('vtoBueno.inicio');
Route::post('/vistoBueno/editar', 'VtoBuenoController@update')->name('vtoBueno.editar');
Route::post('/vistoBueno/enviar/{semana}', 'VtoBuenoController@store')->name('vtoBueno.enviar');

Route::get('/Validaciones/inicio', 'ValidacionController@index')->name('validacion.inicio');
Route::post('/Validaciones/enviar', 'ValidacionController@store')->name('validacion.enviar');

Route::get('/plan/inicio', 'PlanSemanalController@index')->name('plan.inicio');
Route::post('/plan/editar/{id}', 'PlanSemanalController@update')->name('plan.editar');
Route::get('/plan/reporte/{ejercicio}/{direccion}/{semana}', 'PlanSemanalController@reporteSemanal')->name('planSemanal.reporte');
// {mes}/

Route::get('/Registro/inicio', 'RegistroController@index')->name('registro.inicio');
Route::post('/Registro/enviar', 'RegistroController@store')->name('registro.enviar');

Route::get('/Password/inicio', 'PasswordController@index')->name('password.inicio');
Route::post('/Password/enviar', 'PasswordController@store')->name('password.enviar');

Route::get('/Usuarios/inicio', 'UsuariosController@index')->name('usuarios.inicio');
Route::post('/Usuarios/modificar', 'UsuariosController@update')->name('usuarios.modificar');

// pagos
Route::get('/Pagos/inicio', 'pagos\AddPagoController@index')->name('pagos.inicio');

// agregar rol
Route::get('/Roles/inicio', 'permisos\RolesController@index')->name('roles.inicio');
Route::post('/Roles/guardar', 'permisos\RolesController@store')->name('roles.store');

// permisos
Route::get('/Permisos/inicio', 'permisos\PermisosController@index')->name('permisos.inicio');
Route::post('/Permisos/guardar', 'permisos\PermisosController@store')->name('permisos.store');

// calendario {agregar pagos}
Route::get('/pagos/inicio', 'pagos\AddPagoController@index')->name('pagos.inicio');
Route::post('/pagos/guardar', 'pagos\AddPagoController@store')->name('pagos.guardar');
Route::get('/pagos/show/{id}', 'pagos\AddPagoController@show')->name('pagos.show');
Route::get('/pagos/{id}', 'pagos\AddPagoController@destroy')->name('pagos.destroy');
Route::post('/pagos/update/{id}', 'pagos\AddPagoController@update')->name('pagos.update');
Route::post('/pagos/enviar', 'pagos\AddPagoController@sendPagos')->name('pagos.enviar');

// calendario {Visualizar los pagos realizados}
Route::get('/pagosRealizados/inicio', 'pagos\PagosController@index')->name('pagosRealizados.inicio');
Route::get('/pagosRealizados/show/{id}/{fechaInicio}/{fechaFinal}', 'pagos\PagosController@show')->name('pagosRealizados.show');
Route::get('/pagosRealizados/reporte', 'pagos\PagosController@reporte')->name('pagosRealizados.reporte');

// cronograma de pagos
Route::get('/cronogramaPagos/inicio', 'pagos\CronogramaPagosController@index')->name('cronogramaPagos.inicio');
Route::get('/cronogramaPagos/reporte', 'pagos\CronogramaPagosController@reporte')->name('cronogramaPagos.reporte');

// previualizar
Route::post('/pagos/previsualizar', 'pagos\AddPagoController@previsualizar')->name('pagos.previsualizar');
