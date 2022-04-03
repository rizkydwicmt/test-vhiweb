<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* User */
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'user',
    ],
    function ($router) {
        Route::post('login', 'Api\AuthController@login')->name('login');
        Route::get('/', 'Api\AuthController@me');
        Route::post('logout', 'Api\AuthController@logout');
        Route::post('refresh', 'Api\AuthController@refresh');
    },
);

Route::group(['prefix' => '/user'], function () {
    Route::post('register', 'Api\AuthController@register')->name('register');
});


/* Photo */
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'photos',
    ],
    function ($router) {
        Route::post('/', 'Api\PhotoController@createPhoto');
        Route::put('/{id}', 'Api\PhotoController@updatePhoto');
        Route::delete('/{id}', 'Api\PhotoController@deletePhoto');
    },
);

Route::group(['prefix' => '/photos'], function () {
    Route::get('/', 'Api\PhotoController@getPhoto');
    Route::get('/{id}', 'Api\PhotoController@getPhotoDetail');
});

