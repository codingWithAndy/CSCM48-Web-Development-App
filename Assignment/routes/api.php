<?php

use Illuminate\Http\Request;

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

Route::get('posts/{post}/comments', 'BlogCommentController@apiIndex')->name('api.comments.index');
Route::post('posts/{post}/comment', 'BlogCommentController@apiStore')->name('api.comment.store');

Route::middleware('auth:api')->group(function () {

});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// }); -> was here but not in tutorial followed.


