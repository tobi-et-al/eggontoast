<?php

use Illuminate\Http\Request;
Use App\Model\Job;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => ['auth:api','cors']], function() {

    Route::get('job', 'JobController@index');
    Route::get('job/{job}', 'JobController@show');
    Route::post('job', 'JobController@store');
    Route::put('job/{job}', 'JobController@update');
    Route::delete('job/{job}', 'JobController@delete');

});
