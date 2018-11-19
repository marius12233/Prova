<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user/{user}','UserController@show');


//Route::apiResource('/user','UserController');


//Route::resource('/register','RegisterController@create');

//Route::apiResource('/uploadFile','PhotoController');


Route::apiResource('/products','ProductController');

//Middleware protection for updating method
Route::middleware('auth:api')->post('/products','ProductController@store');
Route::middleware('auth:api')->put('/products/{product}','ProductController@update');
Route::middleware('auth:api')->delete('/products/{product}','ProductController@destroy');



Route::group(['prefix'=>'products'],function(){

	Route::apiResource('/{product}/reviews','ReviewController');

});
//Imposto l'autorizzazione anche per creare, modificare e cambiare le review  
//
Route::middleware('auth:api')->post('/products/{product}/reviews','ReviewController@store');
Route::middleware('auth:api')->put('/products/{product}/reviews/{review}','ReviewController@update');
Route::middleware('auth:api')->delete('/products/{product}/reviews/{review}','ReviewController@destroy');

//Rotte per i dettagli del prtodotto
Route::group(['prefix'=>'products'],function(){

	Route::apiResource('/{product}/details','DetailController');

});

Route::middleware('auth:api')->post('/products/{product}/details','DetailController@store');
Route::middleware('auth:api')->put('/products/{product}/details/{detail}','DetailController@update');
Route::middleware('auth:api')->delete('/products/{product}/details/{detail}','DetailController@destroy');


Route::group(['prefix'=>'products'],function(){

	Route::apiResource('/{product}/tails','TailController');

});

Route::middleware('auth:api')->post('/products/{product}/tails','TailController@store');
Route::middleware('auth:api')->put('/products/{product}/tails/{tail}','TailController@update');
Route::middleware('auth:api')->delete('/products/{product}/tails/{tail}','TailController@destroy');

//Aggiungere autenticazione a tails

Route::group(['prefix'=>'products'],function(){

	Route::apiResource('/{product}/uploadFile','PhotoController');

});

Route::middleware('auth:api')->post('/products/{product}/uploadFile','PhotoController@store');
Route::middleware('auth:api')->put('/products/{product}/uploadFile/{uploadFile}','PhotoController@update');
Route::middleware('auth:api')->delete('/products/{product}/uploadFile/{uploadFile}','PhotoController@destroy');




