<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Member;
use App\Models\Log;
use Illuminate\Auth\Events\Login;

class LdMemberController extends Controller
{



    // 會員列表
    function list(Request $request)
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
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------




        // $data = [
        //     'page' => '1',
        //     'error' => '',
        //     'next_page' => '',
        //     'prev_page' => '',
        // ];
        // if ($request->input('page')) {
        //     $data['page'] = $request->input('page');
        // }


        $memberList = Member::paginate(15);


        foreach ($memberList as $member) {
            $member->status = '1' ?  '正常'  :  '停權';
            $member->lastLogin = (new Member)->lastLogin($member->account);
        }
        return view('ld.member.list', compact('memberList'));
    }







    // 搜尋功能(沒做)
    function search(Request $request)
    {

        $memberList = Member::paginate(15);


        foreach ($memberList as $member) {
            $member->status = '1' ?  '正常'  :  '停權';
        }
        return view('ld.member.list', compact('memberList'));
    }
}
