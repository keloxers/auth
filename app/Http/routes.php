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



Route::group(['middleware' => 'web'], function() {
    Route::auth();
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index');

    Route::get( '/provincias/search', array('as' => 'provincias.search', 'uses' => 'ProvinciasController@search'));
    Route::post('/provincias/finder', [ 'as' => 'provincias.finder', 'uses' => 'ProvinciasController@finder']);
    Route::resource('provincias', 'ProvinciasController');

    Route::post('/ciudads/finder', [ 'as' => 'ciudads.finder', 'uses' => 'CiudadsController@finder']);
    Route::get( '/ciudads/search', array('as' => 'ciudads.search', 'uses' => 'CiudadsController@search'));
    Route::resource('ciudads', 'CiudadsController');

    Route::post('/barrios/finder', [ 'as' => 'barrios.finder', 'uses' => 'BarriosController@finder']);
    Route::get( '/barrios/search', array('as' => 'barrios.search', 'uses' => 'BarriosController@search'));
    Route::resource('barrios', 'BarriosController');


    Route::post('/zonas/finder', [ 'as' => 'zonas.finder', 'uses' => 'ZonasController@finder']);
    Route::resource('zonas', 'ZonasController');

    Route::post('/condicionesventas/finder', [ 'as' => 'condicionesventas.finder', 'uses' => 'CondicionesventasController@finder']);
    Route::resource('condicionesventas', 'CondicionesventasController');


    Route::post('/chofers/finder', [ 'as' => 'chofers.finder', 'uses' => 'ChofersController@finder']);
    Route::resource('chofers', 'ChofersController');

    Route::post('/tiposdocumentos/finder', [ 'as' => 'tiposdocumentos.finder', 'uses' => 'TiposdocumentosController@finder']);
    Route::resource('tiposdocumentos', 'TiposdocumentosController');

    Route::post('/pedidostipos/finder', [ 'as' => 'pedidostipos.finder', 'uses' => 'PedidostiposController@finder']);
    Route::resource('pedidostipos', 'PedidostiposController');

    Route::post('/articuloscategorias/finder', [ 'as' => 'articuloscategorias.finder', 'uses' => 'ArticuloscategoriasController@finder']);
    Route::get( '/articuloscategorias/search', array('as' => 'articuloscategorias.search', 'uses' => 'ArticuloscategoriasController@search'));
    Route::resource('articuloscategorias', 'ArticuloscategoriasController');

    Route::post('/depositos/finder', [ 'as' => 'depositos.finder', 'uses' => 'DepositosController@finder']);
    Route::get( '/depositos/search', array('as' => 'depositos.search', 'uses' => 'DepositosController@search'));
    Route::resource('depositos', 'DepositosController');

    Route::post('/proveedorescategorias/finder', [ 'as' => 'proveedorescategorias.finder', 'uses' => 'ProveedorescategoriasController@finder']);
    Route::resource('proveedorescategorias', 'ProveedorescategoriasController');

    Route::post('/devolucionesmotivos/finder', [ 'as' => 'devolucionesmotivos.finder', 'uses' => 'DevolucionesmotivosController@finder']);
    Route::resource('devolucionesmotivos', 'DevolucionesmotivosController');

    Route::post('/motivosajustesstocks/finder', [ 'as' => 'motivosajustesstocks.finder', 'uses' => 'MotivosajustesstocksController@finder']);
    Route::resource('motivosajustesstocks', 'MotivosajustesstocksController');

    Route::post('/pedidostiposbonificacions/finder', [ 'as' => 'pedidostiposbonificacions.finder', 'uses' => 'PedidostiposbonificacionsController@finder']);
    Route::resource('pedidostiposbonificacions', 'PedidostiposbonificacionsController');

    Route::post('/articulos/finder', [ 'as' => 'articulos.finder', 'uses' => 'ArticulosController@finder']);
    Route::get( '/articulos/search', array('as' => 'articulos.search', 'uses' => 'ArticulosController@search'));
    Route::resource('articulos', 'ArticulosController');

    Route::post('/proveedors/finder', [ 'as' => 'proveedors.finder', 'uses' => 'ProveedorsController@finder']);
    Route::get( '/proveedors/search', array('as' => 'proveedors.search', 'uses' => 'ProveedorsController@search'));
    Route::resource('proveedors', 'ProveedorsController');

    Route::get( '/tipoivas/search', array('as' => 'tipoivas.search', 'uses' => 'TipoivasController@search'));

    Route::post('/compras/finder', [ 'as' => 'compras.finder', 'uses' => 'ComprasController@finder']);
    Route::resource('compras', 'ComprasController');
    Route::get('/compras/{id}/close', [ 'as' => 'compras.close', 'uses' => 'ComprasController@close']);

    Route::post('/comprasdetalles/finder', [ 'as' => 'comprasdetalles.finder', 'uses' => 'ComprasdetallesController@finder']);
    Route::get('/comprasdetalles/{id}', [ 'as' => 'comprasdetalles.index', 'uses' => 'ComprasdetallesController@index']);
    Route::get('/comprasdetalles/{id}/create', [ 'as' => 'comprasdetalles.create', 'uses' => 'ComprasdetallesController@create']);
    Route::post('/comprasdetalles/store', [ 'as' => 'comprasdetalles.store', 'uses' => 'ComprasdetallesController@store']);
    Route::get('/comprasdetalles/{id}/edit', [ 'as' => 'comprasdetalles.edit', 'uses' => 'ComprasdetallesController@edit']);
    Route::put('/comprasdetalles/{id}', [ 'as' => 'comprasdetalles.update', 'uses' => 'ComprasdetallesController@update']);
    Route::get('/comprasdetalles/{id}/show', [ 'as' => 'comprasdetalles.show', 'uses' => 'ComprasdetallesController@show']);
    Route::delete('/comprasdetalles/{id}', [ 'as' => 'comprasdetalles.destroy', 'uses' => 'ComprasdetallesController@destroy']);


});
