<?php

use Illuminate\Support\Facades\Route;

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

      Route::get('/', 'PostController@index');
      Route::get('/home', ['as' => 'home', 'uses' => 'PostController@index']);

      // Authentication
      // Route::resource('auth', 'Auth\AuthController');
      // Route::resource('password', 'Auth\PasswordController');
      Route::get('/logout', 'UserController@logout');
      Route::group(['prefix' => 'auth'], function () {
        Auth::routes();
      });

        // Check login
        Route::middleware(['auth'])->group(function () {
        // Show Blogs
        Route::get('new-post', 'PostController@create');
        // Save Blog
        Route::post('new-post', 'PostController@store');
        // Edit Blogs
        Route::get('edit/{slug}', 'PostController@edit');
        // Update Blogs
        Route::post('update', 'PostController@update');
        // Delete Blog
        Route::get('delete/{id}', 'PostController@destroy');
        // Display all my blogs
        Route::get('my-all-posts', 'UserController@user_posts_all');
        // Display my drafts
        Route::get('my-drafts', 'UserController@user_posts_draft');
        // Add comments & rate
        Route::post('comment/add', 'CommentController@store');
        // Delete comments
        Route::post('comment/delete/{id}', 'CommentController@distroy');
      });

      // Profile
      Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
      // List of blogs
      Route::get('user/{id}/posts', 'UserController@user_posts')->where('id', '[0-9]+');
      // single Blog
      Route::get('/{slug}', ['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');