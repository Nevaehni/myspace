<?php

Auth::routes();

//Home page
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@getUser')->name('home.getuser');
Route::post('/home/{id}', 'HomeController@likedUser')->name('home.like');

//Edit profile page
Route::get('/edit', 'EditPageController@profileindex')->name('edit');
Route::post('/edit/update', 'EditPageController@updateUser')->name('edit.update');


