<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\PhpMailTrait;
use App\Models\Member;
use App\Models\Log;

use Illuminate\Support\Facades\Session;


class MbUpdateController extends Controller
{


    // 進會員頁
    function update(Request $request)
    {
        $text = (object) [];
        $text->title = '會員中心';


        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                // dd($member);
            } else {
                $text->body = '連線逾時，請重新登入';
                return view('mb.confirmAcc', compact('text'));
            }
        } catch (\Throwable $th) {
            $text->body = '連線逾時，請重新登入';
            return view('mb.confirmAcc', compact('text'));
        }

        // 資料整理區----------------------------------------------------
        // 狀態
        switch ($member->staId) {
            case 2:
                $member->staId = '一般會員';
                break;
            case 3:
                $member->staId = '管理員';
                break;
            default:
                $member->staId = '一般會員';
                break;
        }

        // 電話
        if ($member->tel == '') {
            $member->tel_text = '新增您的手機號碼 ex:0912345678';
        } else {
            $member->tel_text = '';
        }

        return view('mb.update', compact('text', 'member'));
    }




    // 會員資料修改
    function updateData(Request $request)
    {
        $text = (object) [];
        $text->title = '更新資料';
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                // dd($member);
            } else {
                $text->body = '連線逾時，請重新登入';
                return view('mb.confirmAcc', compact('text'));
            }
        } catch (\Throwable $th) {
            $text->body = '連線逾時，請重新登入';
            return view('mb.confirmAcc', compact('text'));
        }


        // 資料修改-----------------------------------------------------
        // 目前能改的只有 up_tel 跟 up_name

        //偵測是否有改過資料
        $isEdit = 0;


        if ($member->tel != $request->input('up_tel')) {
            $member->tel = $request->input('up_tel');
            $isEdit = 1;
        }

        if ($member->name != $request->input('up_name')) {
            $member->name = $request->input('up_name');
            $isEdit = 1;
        }
        

        if ($isEdit) {

            // 有動過資料
            $member->save();
            $text->body = '資料修改成功';
                return view('mb.updateData', compact('text'));
        }else{

            // 沒動過資料
            return redirect('/member/update');
        }








    }



    // 會員密碼修改
    // 密碼修改沿用MbLoginController 的 updatePsw


































}



// include_once('../php/mysqli.php');

// //確認是否為會員
// if (isset($_REQUEST['mid'])) {
//     //從網址得到會員帳號
//     $mid = $_REQUEST['mid'];
//     $psw = $_REQUEST['psw'];
//     //找出所有會員的資料放進去
//     $sql_data = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
//     $result = $mysqli->query($sql_data);
//     $data = $result->fetch_array();
//     //抓全部的東西出來
//     $acc = $data['account'];
//     $pws = $data['psw'];
//     $email = $data['email'];
//     $status = $data['staId'];
//     if ($status == 2) {
//         $status = '一般會員';
//     } else if ($status == 3) {
//         $status = '管理員';
//     }
//     $tel = $data['tel'];
//     //還沒解決tel的放入 0710
//     if ($tel == '') {
//         //如果手機尚未設定，文字丟在placeholder
//         $tel = '新增您的手機號碼 ex:0912345678';
//         $tel2 = '';
//     } else {
//         //如果有存在，內容會放value
//         $tel2 = $tel;
//         $tel = '';
//         // echo $tel;
//         // echo $te2;
//     }
//     $name = $data['name'];
//     $point = $data['point'];
//     // echo "{$acc};{$pws};{$status};{$name};{$point}";

//     //放入訂單資訊
//     $sql_order = "SELECT * FROM `memberorder` INNER JOIN payment ON memberorder.paid = payment.paid INNER JOIN deliver on memberorder.did = deliver.did WHERE mid='{$mid}' ;";
//     $result_order = $mysqli->query($sql_order);
//     //確認訂單是否為空白
//     $check = $result_order->num_rows;
//     if ($check = 0) {
//         die();
//     }
// } else {
//     header("Location:/Maria/html/mb_login.php");
// }

// $start = 1;

// 




// 修改會員資料
// include('../php/mysqli.php');

// //唯一不會被改變的資料，用來當作select條件
// $mid = $_REQUEST['mid'];
// $name = $_REQUEST['up_name'];
// $tel =$_REQUEST['up_tel'];
// // echo "{$name};{$tel};{$mid}";
// //找回密碼
// $sql_match="SELECT psw FROM member WHERE mid='{$mid}'";
// $result= $mysqli->query($sql_match);
// $row = $result->fetch_array();
// $psw = $row['psw'];


// //已帳號為條件去更新資料
// $sqlRenewData = "UPDATE member SET name='{$name}' ,tel ='{$tel}' WHERE mid = '{$mid}'";
// $mysqli->query($sqlRenewData);

// header("Location:../html/mb_update.php?mid={$mid}&psw={$psw}");
