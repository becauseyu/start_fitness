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

// Route::get('/', function () {
//     return '你是在哈囉? 請直接輸入網址好嗎';
// });

Route::get('/','App\Http\Controllers\LdLoginController@index');
Route::post('/','App\Http\Controllers\LdLoginController@idCheck');

// for login
Route::get('/ld/login','App\Http\Controllers\LdLoginController@index');
Route::post('/ld/login','App\Http\Controllers\LdLoginController@idCheck');

// for member
Route::get('/ld/member/list','App\Http\Controllers\LdMemberController@list');
Route::get('/ld/member/list/{search}','App\Http\Controllers\LdMemberController@search');

// for log
Route::get('/ld/log/list','App\Http\Controllers\LdLogController@list');
Route::get('/ld/logout','App\Http\Controllers\LdLoginController@logout');


// just test
Route::get('/test','App\Http\Controllers\TestController@index');




