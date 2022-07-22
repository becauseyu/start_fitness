<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function index() {
        dd($_SERVER);
        return view('ld.member.test');
    }
}
