<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('categoria', 'API\CategoriaController')->names('api.categoria');

Route::apiResource('producto', 'API\ProductoController')->names('api.producto');

// eliminar imagen 
Route::delete('/eliminarimagen/{id}','API\ProductoController@eliminarimagen')->name('api.eliminarimagen');

Route::get('/resultados', function () {

	$image = App\Image::orderBy('id', 'DESC')->get();
	return $image;
});