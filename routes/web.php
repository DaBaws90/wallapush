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
// Authentication routes
Auth::routes(['verify' => true]);

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::group(['middleware' => 'auth'], function () {
    
    // User routes
    Route::post('/users/{id}/disable', 'UserController@disable')->name('disableUser');
    Route::resource('users','UserController');

});

// Home routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::group(['middleware' => 'auth'], function() {

    // ANUNCIOS
    Route::get('/anuncios/add', 'AnuncioController@addAnuncio')->name('addAnuncio');
    Route::post('/anuncios/store', 'AnuncioController@storeAnuncio')->name('storeAnuncio');

    Route::get('/anuncios/categorias', 'AnuncioController@categorias')->name('categorias');
    Route::post('anuncios/storeCategoria', 'AnuncioController@storeCategoria')->name('storeCategoria');
});
