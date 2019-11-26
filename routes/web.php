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

use App\Twitter;

app()->singleton('App\Twitter', function ($app){
    return new Twitter();
    
});

Route::get('exampleroute', 'BlogPostController@tweet');
Route::get('/', function () {
    return view('welcome');
});

Route::get('blog_posts', 'BlogPostController@index')->name('blog_post.index');
Route::get('blog_posts/{id}', 'BlogPostController@show')->name('blog_post.show');
//Route::get('blog_posts/{id}', 'BlogPostController@comments')->name('blog_post.comments');
