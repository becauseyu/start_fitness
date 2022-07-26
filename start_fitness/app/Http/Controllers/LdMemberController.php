<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Member;
use App\Models\Log;

class LdMemberController extends Controller
{
    function list(Request $request)
    {
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
            $member->lastLogin =(new Member)->lastLogin($member->account);
        }
        return view('ld.member.list', compact('memberList'));
    }


    function search(Request $request)
    {
       
        $memberList = Member::paginate(15);
        
        
        foreach ($memberList as $member) {
            $member->status = '1' ?  '正常'  :  '停權';
        }
        return view('ld.member.list', compact('memberList'));
    }




}
