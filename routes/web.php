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

    Route::resource('answers', 'AnswerController');

    


    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['auth', 'CheckUser']], function () {
            Route::get('users/{id}', 'UserController@show');
    });

    Route::group(['middleware' => ['auth', 'CheckTask']], function () {
            Route::get('tasks/{id}/edit', 'TaskController@edit')->name('tasks.edit');
            Route::put('tasks/{id}', 'TaskController@update');
            Route::delete('tasks/{id}', 'TaskController@destroy')->name('tasks.destroy');;
    });

    Route::group(['middleware' => ['auth', 'CheckTasklist']], function () {
            Route::get('tasklists/{id}/edit', 'TasklistController@edit')->name('tasklists.edit');
            Route::put('tasklists/{id}', 'TasklistController@update');
            Route::delete('tasklists/{id}', 'TasklistController@destroy')->name('tasklists.destroy');
    });


    Route::group(['middleware' => ['auth', 'CheckIfAdmin']], function () {
            Route::resource('users','UserController', ['except' => ['show']]);
            
            Route::post('users/{id}/makeMod', 'UserController@makeMod');
            Route::post('users/{id}/unmakeMod', 'UserController@unmakeMod');

            Route::get('sets', 'SetController@index');
            Route::get('sets/{id}/details', 'SetController@details')->name('sets.details');
            

    });

    Route::group(['middleware' => ['auth', 'CheckIfTeacher']], function () {
            Route::resource('tasks', 'TaskController', ['except' => ['edit', 'update', 'destroy']]);
            Route::resource('tasklists', 'TasklistController', ['except' => ['edit', 'update', 'destroy']]);
    });

    Route::resource('sets', 'SetController', ['except' => ['store', 'show', 'index']]);

    Route::post('sets', 'SetController@store')->name('sets.store');

            
    Route::get('sets/{id}/{taskNumber}', 'SetController@show')->name('sets.show');



    Route::get('sets/{id}', 'SetController@timeout')->name('sets.timeout');


    Route::delete('sets/{id}', 'SetController@destroyTables')->name('sets.destroyTables');

});


