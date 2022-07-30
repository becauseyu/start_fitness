<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Member;

use Illuminate\Support\Facades\Session;

class LdLogController extends Controller
{
    function list()
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





        $logList = Log::orderBy('id', 'desc')->paginate(20);

        return view('ld.log.list', compact('logList'));
    }
}
