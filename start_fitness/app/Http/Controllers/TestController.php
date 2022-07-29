<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memberorder;
use App\Models\Member;
use App\Models\Goodsdetail;

use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    function index(Request $request) {
        dd((new Memberorder)->createOrderNumber(123456789));
        return view('ld.member.test');
    }

    
}
