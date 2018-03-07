<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Show Controller - github.com/harrischristiansen/controlshow
|--------------------------------------------------------------------------
*/

Route::get('/', 'ShowController@getIndex')->name('home');
Route::get('/about', 'ShowController@getAbout')->name('about');