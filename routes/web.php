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
    Route::post('/users/saldo', 'UserController@saldo')->name('saldo');
    Route::get('/users/disableUsers', 'UserController@disableUsers')->name('disableUsers');
    Route::post('/users/disableUsersPost', 'UserController@disableUsersPost')->name('disableUsersPost');
    Route::post('/users/setSaldo', 'UserController@setSaldo')->name('setSaldo');
    Route::post('/users/{id}/disable', 'UserController@disable')->name('disableUser');
    Route::resource('users','UserController');

});

// Home routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
// ANUNCIOS
Route::get('/anuncios/list', 'AnuncioController@listAnuncios')->name('listAnuncios');
Route::get('/anuncios/details/{id}', 'AnuncioController@detailsAnuncio')->name('detailAnuncio');

Route::group(['middleware' => 'auth'], function () {

    // ANUNCIOS
    Route::get('/anuncios/add', 'AnuncioController@addAnuncio')->name('addAnuncio');
    Route::post('/anuncios/store', 'AnuncioController@storeAnuncio')->name('storeAnuncio');
    Route::get('/anuncios/remove/{id}', 'AnuncioController@remove')->name('removeAnuncio');
    Route::get('/anuncios/edit/{id}', 'AnuncioController@edit')->name('editAnuncio');
    Route::post('/anuncios/editAnuncio/', 'AnuncioController@editAnuncio')->name('editAnuncio');

    // Images
    // Route::get('/images/{path}/{attachment}', function ($path, $attachment){
    //     // Lo siguiente devuelve el Path absoluto de "Storage"
    //     $storagePath = Storage::disk($path)->getDriver()->getAdapter()->getPathPrefix();
    //     $imageFilePath = $storagePath . $attachment;
    //     if(File::exists($imageFilePath)) {
    //         return Image::make($imageFilePath)->response();
    //     }
    // });
    Route::get('/images/remove/{img}', 'ImageController@remove')->name('removeImage');


    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/anuncios/categorias', 'AnuncioController@categorias')->name('categorias');
        Route::post('anuncios/storeCategoria', 'AnuncioController@storeCategoria')->name('storeCategoria');
    });
});
