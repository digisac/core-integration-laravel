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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});



Route::namespace('v1')->group(function () {
    
    Route::apiResource('companies', 'CompanyController');

    Route::prefix('webhook')->namespace('Webhooks')->group(function () {

        Route::prefix('digisac')->namespace('DigiSac')->group(function () {
            
            Route::post('bot-command', 'DigiSacController@botCommand');
            
        }); 
        
    });
    
});


Route::get('ping', static function () {
    return 'ok';
});

