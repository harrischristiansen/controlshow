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

// Bridge Discovery
Route::get('bridges', 'APIController@getLocalBridges')->name('api_local_bridges');
Route::get('addBridge/{ipAddr}', 'APIController@addBridge')->name('api_add_bridge');

// Bridges
Route::group(['prefix' => 'bridge'], function () {
	Route::get('all', 'APIController@getBridges')->name('api_bridges');
	Route::group(['prefix' => '{bridge}'], function () {
		Route::get('', 'APIController@getBridge')->name('api_bridge');
	});
});

// Lights
Route::group(['prefix' => 'light'], function () {
	Route::get('all', 'APIController@getLights')->name('api_lights');
	Route::group(['prefix' => '{light}'], function () {
		Route::get('', 'APIController@getLight')->name('api_light');
	});
});
