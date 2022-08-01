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

//訪客模式


// food側
Route::get('/food/index','App\Http\Controllers\GuestController@checkmember');
Route::get('/food','App\Http\Controllers\GuestController@checkmember');

Route::get('/food/introduce','App\Http\Controllers\GuestController@checkmember');
Route::get('/food/minigame','App\Http\Controllers\GuestController@checkmember');
Route::get('/goods/randomGoods','App\Http\Controllers\GoodsController@getRandomGoods');

// sport側
Route::get('/sport/index','App\Http\Controllers\GuestController@checkmember');
Route::get('/sport','App\Http\Controllers\GuestController@checkmember');

Route::get('/sport/introduce','App\Http\Controllers\GuestController@checkmember');

Route::get('/sport/gymmap','App\Http\Controllers\GymMapController@gymmap');
Route::get('/sport/gymmap/list','App\Http\Controllers\GymMapController@list');
Route::get('/sport/gymmap/default','App\Http\Controllers\GymMapController@getDefault');
Route::post('/sport/gymmap/inbody','App\Http\Controllers\GymMapController@inbody');

//---------------以下是商品頁面---------------------------------------------
Route::get('/goods/index','App\Http\Controllers\GoodsController@index');
Route::get('/goods/data/{pid}','App\Http\Controllers\GoodsController@data');


Route::get('/goods/getGoodsData','App\Http\Controllers\GoodsController@getGoodsData');



//--------------以下結帳流程------------------------------------------------
Route::get('/payment','App\Http\Controllers\PaymentController@payment');
Route::get('/payment/page01','App\Http\Controllers\PaymentController@payment');


Route::post('/payment/page02','App\Http\Controllers\PaymentController@page02');
Route::post('/payment/page03','App\Http\Controllers\PaymentController@page03');
Route::post('/payment/addOrder','App\Http\Controllers\PaymentController@addorder');
Route::get('/payment/addOrder','App\Http\Controllers\PaymentController@addorder');





//---------------以下會員管理------------------------------------------------
// 會員登入
Route::get('/member/login',function() {return view('mb.login');});
Route::post('/member/login','App\Http\Controllers\MbLoginController@isMember');

//會員登出
Route::get('/member/logout','App\Http\Controllers\MbLoginController@logout');

// 帳號註冊
Route::get('/member/login/{account}','App\Http\Controllers\MbLoginController@isNewAccount');
Route::post('member/register','App\Http\Controllers\MbLoginController@register');

// 忘記密碼MbLoginController@
Route::get('/member/forget',  'App\Http\Controllers\MbLoginController@forget');
Route::post('/member/forget', 'App\Http\Controllers\MbLoginController@forget');


// 重設密碼
Route::get('/member/renewPsw','App\Http\Controllers\MbLoginController@renewPsw');
Route::post('/member/updatePsw','App\Http\Controllers\MbLoginController@updatePsw');

// 驗證結束頁(固定跳轉回登入畫面)
Route::get('/member/confirmAcc','App\Http\Controllers\MbLoginController@confirmAcc');


// 帳號管理
Route::get('/member/update','App\Http\Controllers\MbUpdateController@update');
Route::post('/member/updateData','App\Http\Controllers\MbUpdateController@updateData');











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

// for goods
Route::get('/ld/goods/list','App\Http\Controllers\LdGoodsController@list');
Route::get('/ld/branddetail/list','App\Http\Controllers\LdGoodsController@brandList');
Route::get('/ld/ptype/list','App\Http\Controllers\LdGoodsController@ptypeList');

// 編輯
Route::post('/ld/goods/bigEdit','App\Http\Controllers\LdGoodsController@bigEdit');
Route::post('/ld/goods/smallEdit','App\Http\Controllers\LdGoodsController@smallEdit');

//上下架
Route::get('/ld/goods/takeDown/{id}','App\Http\Controllers\LdGoodsController@takeDown');
Route::get('/ld/goods/onShelf/{id}','App\Http\Controllers\LdGoodsController@onShelf');

// 刪除
Route::get('/ld/goods/deleteAll/{id}','App\Http\Controllers\LdGoodsController@deleteAll');
Route::get('/ld/goods/deleteOne/{id}','App\Http\Controllers\LdGoodsController@deleteOne');

// 新增
Route::get('/ld/goods/create','App\Http\Controllers\LdGoodsController@bigCreateList');
Route::post('/ld/goods/create','App\Http\Controllers\LdGoodsController@bigCreate');

// just test
Route::get('/test','App\Http\Controllers\TestController@getRandomGoods');




