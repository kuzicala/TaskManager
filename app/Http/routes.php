<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'HomeController@welcome');
Route::auth();
Route::resource('projects', 'ProjectsController');
Route::post('tasks/{id}/check',['as'=>'tasks.check',"uses"=>'TasksController@check']);
Route::get('tasks/charts', ['as'=>'tasks.charts','uses'=>'TasksController@charts']);
Route::get('tasks/search', ['as'=>'tasks.search','uses'=>'TasksController@search']);
Route::resource('tasks', 'TasksController');
Route::post('tasks/{id}/steps/complete','StepsController@complete');
Route::delete('tasks/{id}/steps/clear','StepsController@clear');
Route::resource('tasks.steps', 'StepsController');
Route::get('/home', 'HomeController@index');
