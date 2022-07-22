<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Member;
use App\Models\Log;
use PhpParser\Node\Expr\AssignOp\Concat;

class LdLoginController extends Controller
{
    function index() {
        $data = [
            'account'=> '',
            'error' => '',
        ];
        return view('ld.login.index',compact('data'));
        
    }

    function idCheck(Request $request) {
        $data = [
            'account'=> '',
            'error' => '',
        ];
        
        
        
        //簡易帳號驗證完成       
        if ($request->input('account') &&  $request->input('password')){

            $account = $request->input('account');
            $data['account']=$account;


            $psw = $request->input('password');
            $member = new Member();
            
            if ($member->accountCheck($account,$psw)) {
                Session::put('account',$account);
                Session::forget('loginError');

                return redirect('/ld/member/list');

            }else{
                $loginError = Session::get('loginError') | 0;
                $loginError +=1;
                $data['error'] = '帳密有誤';
                Session::put('loginError',$loginError);


                if ($loginError >= 5) {
                    $error_log = new Log();
                    $error_log->writeLoginTimes($account,5);
                    Session::put("loginError",0);
                }

                return view('ld.login.index',compact('data'));


            }
            
        }else{
            $data['error']='帳密未輸入';
            
            return view('ld.login.index',compact('data'));
        }
        
    }


    function logout() {
        Session::flush();
        return view('ld.login.logout');
    }


}
