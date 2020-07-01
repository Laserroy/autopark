<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/cars', 'CarController');

Route::group(
    [
        'prefix' => 'manager',
        'as' => 'manager.',
        'namespace' => 'Manager',
        'middleware' => ['auth', 'can:manage'],
    ],
    function () {
        Route::resource('/autoparks', 'AutoparkController');
        Route::resource('/cars', 'CarController');
        Route::get('/', 'HomeController@index')->name('home');
    }
);
