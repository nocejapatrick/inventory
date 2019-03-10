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

Route::group(['middleware'=>'auth:api'],function(){
    Route::apiResources(
        ['item'=>'ItemController',
        'request'=>'RequestController',
        'transaction'=>'RequestTransactionController'
        ]
    );
    Route::get('users/{users}','UserController@show');
    Route::post('transactionUser','RequestTransactionController@sendToUserRequest');
    Route::post('transactionRemark','RequestTransactionController@sendRemark');
    
});

