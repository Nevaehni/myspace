<?php

Auth::routes();

//Home page
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@getUser')->name('home.getuser');
Route::post('/home/{id}', 'HomeController@likedUser')->name('home.like');
Route::post('/home', 'HomeController@searchUser')->name('home.search');

//Edit profile page
Route::get('/edit', 'EditPageController@profileindex')->name('edit');
Route::post('/edit/update', 'EditPageController@updateUser')->name('edit.update');


