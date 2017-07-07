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
Route::get('/', 'HomeController@landingpage');

Route::get('/login', 'UserController@login')->name('twitter.login');
Route::get('/logout', 'UserController@logout')->name('twitter.logout');
Route::get('/callback', 'UserController@callback')->name('twitter.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@home');
    Route::get('/tweets', 'TweetsController@index');
    Route::post('/tweets', 'TweetsController@create');
    Route::get('/tweets/{id}', 'TweetsController@edit');
    Route::post('/tweets/{id}', 'TweetsController@update');
    Route::get('/tweets/{id}/remove', 'TweetsController@delete');
    Route::get('/direct-messages', 'DirectMessagesController@index');
    Route::post('/direct-messages', 'DirectMessagesController@create');
    Route::get('/direct-messages/{id}', 'DirectMessagesController@edit');
    Route::post('/direct-messages/{id}', 'DirectMessagesController@update');
    Route::post('/direct-messages/{id}/remove', 'DirectMessagesController@delete');

});



Route::get('twitter/error', ['as' => 'twitter.error', function(){
	// Something went wrong, add your own error handling here
}]);
