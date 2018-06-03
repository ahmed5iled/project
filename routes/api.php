<?php

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

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@index')->name('listNews');
        Route::post('/add', 'NewsController@store')->name('createNews');
        Route::group(['prefix' => '{news}'], function () {
            Route::post('/update', 'NewsController@update')->name('updateNews');

            Route::group(['prefix' => 'comments'], function () {
                Route::get('/', 'CommentsController@index')->name('listComments');
                Route::post('/add', 'CommentsController@store')->name('createComments');
                Route::group(['prefix' => '{comment}'], function () {
                    Route::get('/update', 'CommentsController@edit')->name('editCommentsForm');
                    Route::post('/update', 'CommentsController@update')->name('updateComments');
                    Route::post('/delete', 'CommentsController@destroy')->name('deleteComments');
                });
            });

        });
    });
});
Route::get('/', 'NewsController@news')->name('frontHome');
Route::post('/', 'CommentsController@comment')->name('comments');
Route::group(['prefix' => 'news'], function () {
    Route::get('/add', 'NewsController@Create')->name('addNewsForm');
    Route::post('/add', 'NewsController@store')->name('addNews');
});
