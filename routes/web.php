<?php






Route::get('/', 'TweetController@index');
Route::post('/tweets', 'TweetController@store');
Route::get('tweets/{id}/delete', 'TweetController@destroy');
Route::get('tweets/{id}', 'TweetController@viewID');
Route::get('tweets/{id}/edit', 'TweetController@edit');
Route::post('/tweets/{id}/update', 'TweetController@update');