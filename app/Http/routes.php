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
    Route::resource('ciudads', 'CiudadsController');

    Route::post('/zonas/finder', [ 'as' => 'zonas.finder', 'uses' => 'ZonasController@finder']);
    Route::resource('zonas', 'ZonasController');

    Route::post('/chofers/finder', [ 'as' => 'chofers.finder', 'uses' => 'ChofersController@finder']);
    Route::resource('chofers', 'ChofersController');

    Route::post('/tiposdocumentos/finder', [ 'as' => 'tiposdocumentos.finder', 'uses' => 'TiposdocumentosController@finder']);
    Route::resource('tiposdocumentos', 'TiposdocumentosController');

});
