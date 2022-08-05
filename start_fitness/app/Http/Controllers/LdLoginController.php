<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Log;
use App\Models\Branddetail;


use Illuminate\Support\Facades\Session;

class LdLoginController extends Controller
{
    function index()
    {
        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                    array_push($compact_var, 'member');
                    return redirect('/ld/log/list');
                } else {
                    
                }
            } else {
                
            }
        } catch (\Throwable $th) {
            
        }
        //------------------------------------------------------







        $data = [
            'account' => '',
            'error' => '',
        ];
        return view('ld.login.index', compact('data'));
    }

    function idCheck(Request $request)
    {
        $data = [
            'account' => '',
            'error' => '',
        ];

        $text = (object) [];
        $text->title = '後台登入';
        $text->body = '';
        //簡易帳號驗證完成       
        if ($request->input('account') &&  $request->input('password')) {
            
            $account = $request->input('account');
            $data['account'] = $account;

            $psw = $request->input('password');
            if ((new Member)->accountCheck($account, $psw)) {
                try {
                    
                    $member = (new Member)->isController($account);
                    
                    if ($member) {


                        // 登入成功在這裡
                        Session::put('account', $account);
                        $verify = md5(md5($psw) . $account);
                        Session::put('verify', $verify);
                        Session::forget('loginError');

                        (new Log)->writeLoginBack($account);

                        return redirect('/ld/log/list');
                    } else {
                        $text->body = '您不是管理員，請移至前台登入';
                        return view('mb.confirmScc', compact('text'));
                    }
                } catch (\Throwable $th) {
                    $data['error'] = '登入有問題';
                    return view('ld.login.index', compact('data'));
                }
            } else {
                $loginError = Session::get('loginError') | 0;
                $loginError += 1;
                $data['error'] = '帳密有誤';
                Session::put('loginError', $loginError);


                if ($loginError >= 5) {
                    $error_log = new Log();
                    $error_log->writeLoginTimes($account, 5);
                    Session::put("loginError", 0);
                }

                return view('ld.login.index', compact('data'));
            }
        } else {
            $data['error'] = '帳密未輸入';

            return view('ld.login.index', compact('data'));
        }
    }


    function logout()
    {
        Session::flush();
        return view('ld.login.logout');
    }
}
