<?php

use Illuminate\Http\Request;

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
Route::get('/test', function () {
    $result = "test success";
    return $result;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');

Route::post('/register', ['as'=>'register', 'uses'=>'RegisterController@index']);

Route::middleware('auth:api')->post('/logout', 'AuthController@logout');



Route::group(['namespace'=>'Expences', 'prefix'=>'/expences', 'middleware' => ['auth:api']], function(){

    Route::get('/', ['as'=>'expences', 'uses'=>'ExpenceController@index']);

    Route::get('/{expence}', ['as'=>'expences.show', 'uses'=>'ExpenceController@show']);

    Route::post('/', ['as'=>'expences.store', 'uses'=>'ExpenceController@store']);

    Route::put('/{expence}', ['as'=>'expences.update', 'uses'=>'ExpenceController@update']);

    Route::delete('/{expence}', ['as'=>'expences.destroy', 'uses'=>'ExpenceController@destroy']);
    
    Route::delete('/expencesDestroySeveral', ['as'=>'expences.destroySeveral', 'uses'=>'ExpenceController@destroySeveral']);
});
