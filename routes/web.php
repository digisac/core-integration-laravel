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


