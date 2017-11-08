<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix'=>'api/v1'], function(){
  Route::group(['prefix'=>'user'], function(){
    Route::post('login', 'APIUser@login');
    Route::post('register', 'APIUser@register');
  });
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('book', 'BookController');
