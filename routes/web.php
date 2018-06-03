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

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'AuthenticationController@loginForm')->name('loginForm');
        Route::post('/', 'AuthenticationController@login')->name('login');

    });

    Route::get('/logout', 'AuthenticationController@logout')->name('logout');

    Route::get('/home', 'AuthenticationController@index')->name('home');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UsersController@index')->name('listUsers');
        Route::get('/add', 'UsersController@create')->name('usersForm');
        Route::post('/add', 'UsersController@store')->name('createUsers');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('/update', 'UsersController@edit')->name('editUsersForm');
            Route::post('/update', 'UsersController@update')->name('updateUsers');
            Route::post('/delete', 'UsersController@destroy')->name('deleteUsers');
        });
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@index')->name('listNews');
        Route::get('/add', 'NewsController@Create')->name('newsForm');
        Route::post('/add', 'NewsController@store')->name('createNews');
        Route::group(['prefix' => '{news}'], function () {
            Route::get('/update', 'NewsController@edit')->name('editNewsForm');
            Route::post('/update', 'NewsController@update')->name('updateNews');
            Route::post('/delete', 'NewsController@destroy')->name('deleteNews');

            Route::group(['prefix' => 'comments'], function () {
                Route::get('/add', 'CommentsController@Create')->name('commentsForm');
                Route::post('/add', 'CommentsController@store')->name('createComments');
                Route::get('/', 'CommentsController@index')->name('listComments');
                Route::group(['prefix' => '{comment}'], function () {
                    Route::get('/update', 'CommentsController@edit')->name('editCommentsForm');
                    Route::post('/update', 'CommentsController@update')->name('updateComments');
                    Route::post('/delete', 'CommentsController@destroy')->name('deleteComments');
                });
            });

        });
    });

});


Route::get('/login', 'AuthenticationController@loginForm')->name('userLogin');
Route::post('/login', 'AuthenticationController@Login')->name('userLogin');

Route::get('/logout', 'AuthenticationController@userLogout')->name('userLogout');
Route::get('/', 'NewsController@news')->name('frontHome');
Route::post('/', 'CommentsController@comment')->name('comments');
Route::group(['prefix' => 'news'], function () {
    Route::get('/add', 'NewsController@Create')->name('addNewsForm');
    Route::post('/add', 'NewsController@store')->name('addNews');
});
