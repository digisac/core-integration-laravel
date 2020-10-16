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

Route::get('/integracao/{id}','LoginController@rdstation');

/*
 * Login
 */
Route::get('/login', 'LoginController@index')->name('login.index')->middleware('web');
Route::post('/login', 'LoginController@login')->name('login')->middleware('web');
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('web');

/*
 * Home
 */
Route::get('/', function () {
    return view('core-integration-laravel::home');
})->middleware(['web','auth']);

/*
 * Company
 */
Route::get('/company', 'CompanyController@index')->name('company.index')->middleware(['web','auth']);
Route::get('/company/create', 'CompanyController@create')->name('company.create')->middleware(['web','auth']);
Route::get('/company/data', 'CompanyController@data')->name('company.data')->middleware(['web','auth']);
Route::post('/company/store','CompanyController@store')->name('company.store')->middleware(['web','auth']);
Route::get('/company/{id}/edit', 'CompanyController@edit')->name('company.edit')->middleware(['web','auth']);
Route::post('/company/{id}/update', 'CompanyController@update')->name('company.update')->middleware(['web','auth']);
Route::get('/company/{id}/destroy', 'CompanyController@destroy')->name('company.destroy')->middleware(['web','auth']);
Route::get('/company/{id}/change', 'CompanyController@change')->name('company.change')->middleware(['web','auth']);

/*
 * SendRequest
 */
Route::get('/send-request', 'SendRequestController@index')->name('request.index')->middleware(['web','auth']);
Route::get('/send-request/test','SendRequestController@test')->middleware(['web','auth']);
Route::get('/send-request/{id}/view','SendRequestController@view')->middleware(['web','auth']);
Route::get('/send-request/data', 'SendRequestController@data')->name('request.data')->middleware(['web','auth']);
Route::get('/send-request/{id}/destroy', 'SendRequestController@destroy')->name('request.destroy')->middleware(['web','auth']);

/*
 * Webhook
 */
Route::get('/webhook', 'WebhookController@index')->name('webhook.index')->middleware(['web','auth']);
Route::get('/webhook/{id}/view','WebhookController@view')->middleware(['web','auth']);
Route::get('/webhook/data', 'WebhookController@data')->name('webhook.data')->middleware(['web','auth']);
Route::get('/webhook/{id}/destroy', 'WebhookController@destroy')->name('webhook.destroy')->middleware(['web','auth']);
Route::get('/webhook/{id}/history', 'WebhookController@history')->name('company.history')->middleware(['web','auth']);


