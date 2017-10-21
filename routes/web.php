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

//put the individual routes inside the group
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    Route::get('/post/create', [
        'uses'=>'PostsCOntroller@create',
        // this is naming the route
        'as'=>'post.create'
    ]);

    Route::post('/post/store', [
        'uses'=>'PostsCOntroller@store',
        'as'=>'post.store'
    ]);

});
