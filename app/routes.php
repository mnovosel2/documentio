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
Route::get('/',function(){
    return View::make('home.index');
});
/**************Views******************/
Route::get('/admin', ['as' => 'adminPanelRoute', 'uses' => 'PanelController@index']);
Route::get('/account/logout', [ 'as' => 'logoutRoute', 'uses' => 'AccountController@logout' ]);
Route::get('/login', [ 'as' => 'loginRoute', 'uses' => 'AccountController@loginForm' ]);
Route::get('/register', [ 'as' => 'registerRoute', 'uses' => 'AccountController@registerForm' ]);
Route::get('/logout',['as'=>'logoutRoute','uses'=>'AccountApiController@logout']);
/**************Views******************/

/***************API******************/
Route::post('/api/account/registration', ['as' => 'registerApiRoute', 'uses' => 'AccountApiController@register']);
Route::post('/api/account/login', ['as' => 'loginApiRoute', 'uses' => 'AccountApiController@login']);
/***************API******************/

Route::group(array('before' => 'auth.token'), function() {
    Route::post('api/data', function(){
        return Token::getUserInstance();
    });
});


/***************************AuthToken*****************************/
Route::get('auth', 'Tappleby\AuthToken\AuthTokenController@index');
Route::post('auth', 'Tappleby\AuthToken\AuthTokenController@store');
Route::delete('auth', 'Tappleby\AuthToken\AuthTokenController@destroy');
/***************************AuthToken*****************************/

/**************************Resource******************************/
Route::resource('repositories', 'RepositoriesController');

Route::resource('documents','DocumentController');
Route::post('/documents/search',['as'=>'documents.search','uses'=>'SearchController@index']);
Route::get('/documents/list/{repositoryId}',['as'=>'documents.index','uses'=>'DocumentController@index']);
Route::post('/documents/{repositoryId}',['as'=>'documents.store','uses'=>'DocumentController@store']);
Route::get('/documents/create/{repositoryId}',['as'=>'documents.create','uses'=>'DocumentController@create']);
Route::get('/documents/edit/{documentId}/{repositoryId}',['as'=>'documents.edit','uses'=>'DocumentController@edit']);
Route::patch('/documents/{documentId}/{repositoryId}',['as'=>'documents.update','uses'=>'DocumentController@update']);
Route::get('/documents/versions/{documentId}',['as'=>'documents.versions','uses'=>'DocumentController@versions']);
Route::delete('/documents/{documentId}/{repositoryId}',['as'=>'documents.destroy','uses'=>'DocumentController@destroy']);
Route::get('/documents/versions/create/{documentId}',['as'=>'versions.create','uses'=>'DocumentController@createVersion']);
Route::post('/documents/versions/create/{documentId}',['as'=>'versions.create','uses'=>'DocumentController@createVersion']);

