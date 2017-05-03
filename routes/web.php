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


	Route::group(['middleware' => ['web']], function () {

	   Route::get('/', 'HomeController@index');

        Auth::routes();

        Route::get('/home', 'HomeController@index');

        Route::resource('answers', 'AnswerController');
        Route::resource('tasklists','TasklistController');
        Route::resource('model_answers', 'ModelAnswerController');
        Route::resource('sets', 'SetController', ['except' => ['store', 'show'
        ]]);
        Route::post('/sets/{id}/store', 'SetController@store');
        Route::get('sets/{id}/{taskNumber}', 'SetController@show');
        Route::resource('tasks', 'TaskController');
        Route::resource('users','UserController');

});


