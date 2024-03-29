<?php

use Illuminate\Support\Facades\Auth;
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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localizationRedirect' ],
], function () {

    Auth::routes(['verify' => false]);

    Route::group(
        [
            'prefix' => 'manager',
            'as' => 'manager.',
            'namespace' => 'Manager',
            'middleware' => ['auth', 'can:manager'],
        ],
        function () {
            Route::resource('/autoparks', 'AutoparkController');
            Route::resource('/cars', 'CarController');
            Route::get('/', 'HomeController@index')->name('home');
        }
    );

    Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

    Route::resource('/cars', 'CarController')->except(['destroy'])->middleware('auth');

});
