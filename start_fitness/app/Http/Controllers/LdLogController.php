<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;



class LdLogController extends Controller
{
    function list() {
        $logList = Log::orderBy('id','desc')->paginate(20);
        
        return view('ld.log.list',compact('logList'));
    }
}
