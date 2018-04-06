<?php

/**********  auth  **********/
Auth::routes();

Route::get('/', 'Home\HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
