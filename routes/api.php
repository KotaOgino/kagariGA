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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function(){
    Route::get('nav','VueController@nav');
    Route::post('ajax','AxiosController@analyticsAxios');
    Route::post('ajaxUser','AxiosController@userAxios');
    Route::post('ajaxInflow','AxiosController@inflowAxios');
    Route::post('ajaxAction','AxiosController@actionAxios');
    Route::post('ajaxConversion','AxiosController@conversionAxios');
    Route::post('ajaxAd','AxiosController@adAxios');
});
