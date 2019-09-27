<?php
use Illuminate\Http\Request;

Route::namespace('App\\Http\\Controllers\\')
    ->group(function ()
{
    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
            Route::get('/user', function (Request $request) {
                return $request->user();
            });
        });

        Route::any('{any}', function () {
            return response()->json(['error' => 'No existe la ruta!'], 404);
        })->where('any', '.*');
    });

    Route::group(['middleware' => 'web'], function () {
        Route::get('/', function () {
            return view('welcome');
        });
        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');
    });
});
