<?php

use App\Google;
use Auth;
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

// Singleton Service Container
app()->singleton('google', function ($app) {
    $id = Auth::id();
    //dd($id);
    return new Google($id);

});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Google API Routes
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');

// Auth login home route
Route::get('/home', 'HomeController@index')->name('home');

//Blog User
Route::get('bloguser', 'BlogUserController@create')->name('bloguser.create');

// Blog Post Routes
Route::get('blog_posts', 'BlogPostController@index')->name('blog_post.index');
Route::get('blog_posts/create', 'BlogPostController@create')->name('blog_post.create')->middleware('auth');
Route::get('blog_posts/{id} ', 'BlogPostController@show')->name('blog_post.show');
Route::delete('blog_posts/{id}', 'BlogPostController@destroy')->name('blog_post.destroy');
Route::get('blog_posts_edit/{blog_post}', 'BlogPostController@edit')->name('blog_post.edit')->middleware('checkauthor'); // ->middleware('can:update, blog_post') ->middleware('checkauthor') this is trying to edit the blog might have conflict of name.
Route::put('blog_posts_edits/{blog_post}', 'BlogPostController@update')->name('blog_post.update');
Route::post('blog_posts', 'BlogPostController@store')->name('blog_post.store')->middleware('auth');

// Blog Comment Routes
Route::post('blog_comments/{post_id}', 'BlogCommentController@store')->name('blog_comment.store')->middleware('auth');
//Route::get('blog_comments/', 'BlogCommentController@apiIndex')->name('api.comments.index');
//Route::post('blog_comment/', 'BlogCommentController@apiStore')->name('api.comment.store');

Route::get('blog_commments/{id}', 'BlogCommentController@edit')->name('blog_comment.edit');
Route::put('blog_comments_edits/{blog_post}', 'BlogCommentController@update')->name('blog_comment.update');






