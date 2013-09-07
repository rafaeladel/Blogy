<?php

Route::get('/',     array('as' => 'listAllPosts',      'uses' => 'PostController@listPosts'));

//Added where() below because without specifying the type of the id. Anything comes after / is considered an id !
Route::get('/{id}', array('as' => 'listSinglePost',   'uses' => 'PostController@showPost'))->where(array('id' => '[0-9]+'));

Route::get('login',                     array('before' => 'guest' , 'as' => 'getLogin',     'uses' => 'UserController@getLogin'));
Route::post('login',                    array('before' => 'csrf' ,  'as' => 'postLogin',    'uses' => 'UserController@postLogin'));
Route::get('make/me/an/admin/account',  array(                      'as' => 'getSignup',    'uses' => 'UserController@getCreateAdmin'));
Route::post('make/me/an/admin/account', array('before' => 'csrf',   'as' => 'postSignup',   'uses' => 'UserController@postCreateAdmin'));
Route::get('logout',                    array('before' => 'auth',   'as' => 'getLogout',    'uses' => 'UserController@getLogout'));

Route::group(array('before' => 'auth'), function(){
    Route::get('add',               array('as' => 'getAddPost',     'uses' => "PostController@getAddPost"));
    Route::get('edit/{id}',         array('as' => 'getEditPost',    'uses' => 'PostController@getEditPost'));
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

