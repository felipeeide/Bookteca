<?php

use Illuminate\Http\Request;

Route::group(['prefix'=>'v1', 'middleware'=>'auth:api'], function(){

  Route::group(['prefix'=>'book', 'middleware'=>'auth:api'], function(){
    Route::get('/', 'APIBookController@index');
    Route::get('/{id}', 'APIBookController@book');
  	Route::post('/', 'APIBookController@create');
  	Route::put('/{id}', 'APIBookController@update');
  	Route::delete('/{id}', 'APIBookController@delete');
  });

});
