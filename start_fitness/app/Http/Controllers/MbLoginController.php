<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\MbLoginTrait;
use App\Http\Traits\PhpMailTrait;
use App\Models\Member;

class MbLoginController extends Controller
{


    // 檢查是否有重複
    function isNewAccount(Request $request)
    {
        $acc = $request->account;
        $aa =Member::where('account', $acc)->first();
        if ($aa->account){ return $aa->account;
        }else{
            return 'false';
        };
        
    }

    function register(Request $request)
    {
        return '你點下註冊鈕，可是他正在施工';
    }

}
