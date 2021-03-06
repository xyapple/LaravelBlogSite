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

Route::get('/', [
    'uses'=>'FrontEndController@index',
    'as'=>'index',
]);

Auth::routes();

Route::get('/test', function(){
    return App\User::find(1)->profile;
});
  //single page display
    Route::get('/post/{slug}',[
    'uses'=>'FrontEndController@singlePost',
    'as'=>'post.single'
    ]);

    //category page
    Route::get('/category/{id}', [
        'uses'=>'FrontEndController@category',
        'as'=>'category.single'
    ]);
        //category page
    Route::get('/tag/{id}', [
        'uses'=>'FrontEndController@tag',
        'as'=>'tag.single'
    ]);
    //search
    Route::get('/results', function(){
            $posts = \App\Post::where('title','like',  '%'. request('query'). '%')->get();

            return view('results')->with('posts', $posts)
                                ->with('title', 'Search results : ' . request('query'))
                                ->with('settings', \App\Settings::first())
                                ->with('categories', \App\Category::take(5)->get())
                                ->with('query', request('query'));

    });

//put the individual routes inside the group
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){

    Route::get('/dashboard', [
        'uses'=>'HomeController@index',
        'as'=>'home'
    ]);

  

// Post
    Route::get('/post/create', [
        'uses'=>'PostsController@create',
        // this is naming the route
        'as'=>'post.create'
    ]);

    Route::post('/post/store', [
        'uses'=>'PostsController@store',
        'as'=>'post.store'
    ]);

    Route::get('/posts', [
        'uses' => 'PostsController@index',
        'as' => 'posts'
    ]);
    Route::get('/post/delete/{id}', [
        'uses'=>'PostsController@destroy',
        'as'=>'post.delete'
    ]);
    Route::get('/post/trashed', [
        'uses'=>'PostsController@trashed',
        'as'=>'posts.trashed'
    ]);
    Route::get('/post/kill/{id}', [
        'uses'=>'PostsController@kill',
        'as'=>'post.kill'
    ]);
    Route::get('/post/restore/{id}', [
        'uses'=>'PostsController@restore',
        'as'=>'post.restore'
    ]);
    Route::get('/post/edit/{id}', [
        'uses'=>'PostsController@edit',
        'as'=>'post.edit'
    ]);

    Route::post('/post/update/{id}', [
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);
// Category
    Route::get('/category/create', [
        'uses'=>'CategoryController@create',
        'as'=>'category.create'
    ]);
    Route::post('/category/store', [
        'uses'=>'CategoryController@store',
        'as'=>'category.store'
    ]);
    Route::get('/categories', [
        'uses'=>'CategoryController@index',
        'as'=>'categories'
    ]);
    Route::get('/category/edit/{id}', [
        'uses'=>'CategoryController@edit',
        'as'=>'category.edit'
    ]);
    Route::get('/category/delete/{id}', [
        'uses'=>'CategoryController@destroy',
        'as'=>'category.delete'
    ]);
    Route::post('/category/update/{id}', [
        'uses'=>'CategoryController@update',
        'as'=>'category.update'
    ]);
    //Tags
    Route::get('/tags',[
        'uses'=>'TagsController@index',
        'as'=>'tags'
    ]);
    Route::get('/tags/edit/{id}',[
        'uses'=>'TagsController@edit',
        'as'=>'tag.edit'
    ]);
    Route::post('/tags/update/{id}',[
        'uses'=>'TagsController@update',
        'as'=>'tag.update'
    ]);
    Route::get('/tags/delete/{id}',[
        'uses'=>'TagsController@destroy',
        'as'=>'tag.delete'
    ]);
    Route::get('/tags/create',[
        'uses'=>'TagsController@create',
        'as'=>'tag.create'
    ]);
    Route::post('/tags/store',[
        'uses'=>'TagsController@store',
        'as'=>'tag.store'
    ]);
    //Users
    Route::get('/users',[
        'uses'=>'UsersController@index',
        'as'=>'users'
    ]);
    Route::post('/users/store',[
        'uses'=>'UsersController@store',
        'as'=>'user.store'
    ]);
    Route::get('/users/create',[
        'uses'=>'UsersController@create',
        'as'=>'user.create'
    ]);
    Route::get('/users/delete/{id}',[
        'uses'=>'UsersController@destroy',
        'as'=>'user.delete'
    ]);

    Route::get('user/admin/{id}', [
         'uses' => 'UsersController@admin',
         'as' => 'user.admin'
     ]);

    Route::get('user/not-admin/{id}', [
         'uses' => 'UsersController@not_admin',
         'as' => 'user.not.admin'
     ]);

     Route::get('user/profile', [
           'uses' => 'ProfilesController@index',
           'as' => 'user.profile'
       ]);

     Route::post('/user/profile/update', [
         'uses' => 'ProfilesController@update',
         'as' => 'user.profile.update'
     ]);

    //  settings
     Route::get('/settings', [
           'uses' => 'SettingsController@index',
           'as' => 'settings'
       ]);
       Route::post('/settings/update', [
           'uses' => 'SettingsController@update',
           'as' => 'settings.update'
       ]);
       
});
