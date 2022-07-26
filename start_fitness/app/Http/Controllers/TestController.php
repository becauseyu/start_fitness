<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(Request $request) {
        dd($request->path());
        return view('ld.member.test');
    }
}
