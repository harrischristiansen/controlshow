<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes - Show Controller - github.com/harrischristiansen/controlshow
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'bridge'], function () {
	Route::get('all', 'APIController@getBridges')->name('api_bridges');
	Route::group(['prefix' => '{bridge}'], function () {
		Route::get('', 'APIController@getBridge')->name('api_bridge');
	});
});

Route::group(['prefix' => 'light'], function () {
	Route::get('all', 'APIController@getLights')->name('api_lights');
	Route::group(['prefix' => '{light}'], function () {
		Route::get('', 'APIController@getLight')->name('api_light');
	});
});
