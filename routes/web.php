<?php

/**********  auth  **********/
Auth::routes();

Route::namespace('Auth')->group(function() {
    Route::get('/register/active/{token}', 'UserController@activeAccount');
    Route::get('/register/again/send/{id}', 'UserController@sendActiveMail');
});

Route::get('/', 'Home\HomeController@index');