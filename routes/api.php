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
    Route::get('analytics','VueController@analytics');
    Route::post('ajaxUser','AxiosController@userAxios');
    Route::get('user','VueController@user');
    Route::post('ajaxInflow','AxiosController@inflowAxios');
    Route::get('inflow','VueController@inflow');
    Route::get('action','VueController@action');
    Route::get('conversion','VueController@cv');
    Route::get('ad','VueController@ad');
});
