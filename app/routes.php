<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'admin'), function(){
    Route::get('/' , function(){
        return View::make('admin.main')->with('title', 'Main');
    });
    
    Route::group(array('prefix' => 'post'), function(){
        Route::get('/',                 array('as' => 'listAllPosts',   'uses' => "PostController@listPosts"));
        Route::get('list',              array('as' => 'listAllPosts',   'uses' => "PostController@listPosts"));
        Route::get('list/{id}',         array('as' => 'listSinglePost', 'uses' => "PostController@showPost"));
        Route::get('add',               array('as' => 'getAddPost',        'uses' => "PostController@getAddPost"));
        Route::get('edit/{id}',         array('as' => 'getEditPost',       'uses' => 'PostController@getEditPost'));
        Route::get('comment/edit/{comment_id}', array('as' => 'getEditComment',    'uses' => 'CommentController@getEditComment'));

        Route::group(array('before' => 'csrf'), function(){
            Route::post('addcomment/{post_id}',         array('as' => 'addComment',     'uses' => 'CommentController@addComment'));
            Route::post('deletecomment/{comment_id}',   array('as' => 'deleteComment',  'uses' => 'CommentController@deleteComment'));
            Route::post('comment/edit/{comment_id}',    array('as' => 'postEditComment','uses' => 'CommentController@postEditComment'));
            Route::post('add',                          array('as' => 'postAddPost',    'uses' => 'PostController@postAddPost'));
            Route::post('edit/{id}',                    array('as' => 'postEditPost',   'uses' => "PostController@postEditPost"));
            Route::post('delete/{id}',                  array('as' => 'deletePost',     'uses' => "PostController@deletePost"));    
        });
        
    });
});