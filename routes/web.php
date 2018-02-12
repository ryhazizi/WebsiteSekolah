<?php

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


Route::get('/', 'HomeController@index');
Route::get('/datasiswa', 'HomeController@index');
Route::get('/404', 'HomeController@errorpage');
Route::post('/proses/tambahdata', 'HomeController@tambahdata');
Route::get('/proses/tambahdata', 'HomeController@PreventDirectAccess');
Route::get('/datasiswa/{id}/edit', 'HomeController@editdata');
Route::post('/proses/memperbaharuidata', 'HomeController@memperbaharuidata');
Route::get('/proses/memperbaharuidata', 'HomeController@index');
Route::post('/proses/hapusdata', 'HomeController@hapusdata');
Route::get('/proses/hapusdata', 'HomeController@index');