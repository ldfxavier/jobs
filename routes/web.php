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
Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {

    Route::get('/login', 'AuthController@loginScreen')->name('login');
    Route::post('/login', 'AuthController@login')->name('login.user');
    Route::get('/registrar', 'AuthController@registerScreen')->name('register');
    Route::post('/registrar', 'AuthController@register')->name('register.user');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::get('/novo_job', 'JobsController@create')->name('job.create');
        Route::post('/novo_job', 'JobsController@store')->name('job.store');
        Route::get('/job', 'JobsController@index')->name('job.index');
        Route::get('/job/{id}', 'JobsController@show')->name('job.show');

        Route::get('/auth/atualizar-token', 'AuthController@refresh')->name('auth.update.token');
        Route::get('/auth/usuario', 'AuthController@me')->name('auth.me');
    });
});
