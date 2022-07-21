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

//-----------------------測試區

// Route::get('/', function () {
//     return '你是在哈囉? 請直接輸入網址好嗎';
// });

// Route::get('/', function() {return redirect('/ld/login');});
Route::view('/test2', 'test');


//------------------------首頁、起始畫面-------------------------

// 首頁、開門頁
// Route::get('/', 'App\Http\Controllers\OpenController@index');
// Route::get('/index', 'App\Http\Controllers\OpenController@index');
Route::view('/', 'openindex');
Route::view('/index', 'openindex');


// food側
Route::get('/food/index',function() {return view('fd.idx');});
Route::get('/food',function() {return view('fd.idx');});

Route::get('/food/introduce',function() {return view('fd.introduce');});
Route::get('/food/minigame',function() {return view('fd.minigame');});

// sport側
Route::get('/sport/index',function() {return view('sp.idx');});
Route::get('/sport',function() {return view('sp.idx');});

Route::get('/sport/introduce',function() {return view('sp.introduce');});



// 奇怪的網址會直接跳轉到最外面的網址
Route::get('/index/{any}',function() { return redirect('/index');});




//----------------以下是後台管理-----------------------------------------------

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




