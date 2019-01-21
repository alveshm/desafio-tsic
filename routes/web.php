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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/produtos'], function () {
    Route::get('/', 'ProdutoController@listaProdutos');
    Route::get('/cadastrar', function () {
        return view('produto.cadastrar')->middleware('checkrole');
    });   
    Route::post('/salvar', 'ProdutoController@cadastrarProduto')->middleware('checkrole');
});

Route::group(['prefix' => '/vendas'], function () {
    Route::post('/busca', 'DocumentoController@gerenciaVenda');
    Route::get('/', 'DocumentoController@buscaCodigo');  
    Route::post('/confirmar', 'DocumentoController@cadastrarItem');
    Route::post('/confirmar', 'DocumentoController@cadastrarDocumento');
    Route::post('/finalizarVenda', 'DocumentoController@finalizarDocumento');
});

