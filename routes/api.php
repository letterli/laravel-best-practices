<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Exceptions\CustomException;


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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user('api');
        // throw new CustomException(401, 'Unathorizate.');
    });
});

Route::post('/login', 'Api\Auth\AuthController@login');

use Carbon\Carbon;
Route::get('/test', function () {
    $entry = ['foo', false, -1, null, ''];
    return array_filter($entry);         // output:
});

// Redis Example
Route::group(['namespace' => 'Redis', 'prefix' => 'redis'], function () {
    Route::post('/resource', 'RedisController@store');
    Route::get('/publisher', 'RedisController@publish');
});


Route::post('/api/test', 'Api\TestController@store');


Route::get('/api/test/{id}', 'Api\TestController@show')->middleware('force-json');
