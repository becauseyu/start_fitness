<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Member;

class GuestController extends Controller
{
    //訪客頁面跳轉(request)
    function checkmember(Request $request)
    {
        //會員身分驗證
        $text = (object) [];
        $text->title = '更新資料';
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                $text->memberStatus = true;
            } else {
                $text->memberStatus = false;
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
        }
        switch ($request->path()) {
            case 'food/index':
                return view('fd.idx', compact('text','member'));
                break;
            case 'food':
                return view('fd.idx', compact('text','member'));
                break;

            case 'food/introduce':
                return view('fd.introduce', compact('text','member'));
                break;

            case 'food/minigame':
                return view('fd.minigame', compact('text','member'));
                break;

            case 'sport/index':
                return view('sp.idx', compact('text','member'));
                break;

            case 'sport':
                return view('sp.idx', compact('text','member'));
                break;
            case 'sport/introduce':
                return view('sp.introduce', compact('text','member'));
                break;
        }



        // dd($request->path());

    }
}