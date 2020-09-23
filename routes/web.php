<?php

use Illuminate\Support\Facades\Route;
use App\Producto;
use App\Categoria;

Route::get('/', 'Admin\AdminTiendaController@index')->name('tienda.index');

Route::get('tienda/{slug}', 'Admin\AdminTiendaController@show')->name('tienda.show');
// Route::get('tienda/categorias/{slug}', 'Admin\AdminTiendaController@categorias')->name('tienda.categorias');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/categoria', 'Admin\AdminCategoriaController')->names('admin.categoria');
Route::resource('admin/producto', 'Admin\AdminProductoController')->names('admin.producto');






Route::get('cancelar/{ruta}', function($ruta){
	 return redirect()->route($ruta)
        ->with('cancelar', 'Accíon Cancelada!');
})->name('cancelar');

 Route::get('anadir-al-carro/{id}', [
    'uses' => 'Admin\AdminTiendaController@anadiralcarro',
    'as' => 'tienda.anadiralcarro'
    ]);

 Route::post('anadir-al-carro', [
    'uses' => 'Admin\AdminTiendaController@postanadiralcarro',
    'as' => 'tienda.postanadiralcarro'
    ]);
 

 Route::get('carro', [
        'uses' => 'Admin\AdminTiendaController@carro',
        'as' => 'tienda.carro'
    ]);
Route::get('remover-un-item/{id}', [
    'uses' => 'Admin\AdminTiendaController@removerunitemcarro',
    'as' => 'tienda.removerunitemcarro'
    ]);

Route::get('remover-item/{id}', [
    'uses' => 'Admin\AdminTiendaController@removeritemcarro',
    'as' => 'tienda.removeritemcarro'
    ]);

Route::get('comprar', [
        'uses' => 'Admin\AdminTiendaController@comprar',
        'as' => 'tienda.comprar',
        // 'middleware' => 'auth'
    ]);

Route::post('comprar', [
        'uses' => 'Admin\AdminTiendaController@postcomprar',
        'as' => 'tienda.postcomprar',
        // 'middleware' => 'auth'
    ]);

Route::resource('admin/pedido', 'Admin\AdminPedidoController')->names('admin.pedido');
