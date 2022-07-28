<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Log;

use App\Models\Goodsdetail;
use App\Models\Branddetail;
use App\Models\Payment;
use App\Models\Deliver;
use App\Models\Memberorder;
use App\Models\OrderDeatail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller


{
    // 結帳
    function payment()
    {
        $text = (object) [];
        $text->title = '(1)購物車結帳-購物車';

        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                // dd($member);
            } else {

                return redirect('/member/login');
            }
        } catch (\Throwable $th) {
            return redirect('/member/login');
        }
        //---------------------------------------------------------------




        return view('payment.page01', compact('text','member'));
    }

    // 商品確認頁
    function page02(Request $request)
    {
        $text = (object) [];
        $text->title = '(2)送貨資訊-購物車';


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
        //---------------------------------------------------------------

        // 撈會員資料
        // 已經有會員資料
        // 還要上一頁資料

        if ($request->input('payment') && $request->input('deliver') && $request->input('total')) {
            $member->pay = $request->input('payment');
            $member->del = $request->input('deliver');
            $member->total = $request->input('total');
        } else {
            // 資料不齊，跳回上一頁
            // dd($request);
            return redirect('/payment/page01');
        }

        return view('payment.page02', compact('text', 'member'));
    }



    function page03(Request $request)
    {
        $text = (object) [];
        $text->title = '(3)已送出-購物車';

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

        date_default_timezone_set('Asia/Taipei');
        // 訂購人id
        $mid = $member->mid;
        // 時間
        $date = date('Y/m/d H:i:s');
        // 收件地址
        $address = $request->input('del_addr');
        // 收件電話
        $tel = $request->input('del_tel');
        // 收件人名字
        $name = $request->input('del_name');
        //找到送貨did
        $did = Deliver::where('deliver', $request->input('del_method'))->first()->did;
        // 找到付款方式paid
        $paid = Payment::where('payment', $request->input('pay_method'))->first()->paid;
        // memmo 這是啥?
        $memo = $request->input('order_memo') || '無特殊備註';
        //total
        $total = $request->input('total');

        // dd($mid,$date,$address,$tel,$name,$did,$paid);
        try {
            if ($mid && $date && $address && $tel && $name && $did && $paid) {
                $order = (new Memberorder)->createNewOrder($mid, $date, $address, $tel, $name, $did, $paid, $memo, $total);
                $order->orderNumber = (new Memberorder)->createOrderNumber($order->oid);
                
                (new Log)->writeLoginNewOrder($order->oid);
                
                return view('payment.page03', compact('order','text','member'));
            } else {
                return redirect('/payment/page01');
            }
        } catch (\Throwable $th) {

            // 有任何錯誤，回去第1步
            return redirect('/payment/page01');
        }
        //---------------------------------------------------------------
        // 設定時區
        //     "_token" => "kagKKETb9a9quQtzDJRzGj1xOsBPPk8sUTkZGCHB"
        //   "del_method" => "新竹物流宅配"
        //   "pay_method" => "貨到付款"
        //   "customer_name" => "Lai"
        //   "customer_email" => "stfs0723@gmail.com"
        //   "customer_tel" => "0988888877"
        //   "order_memo" => null
        //   "del_name" => "222"
        //   "del_tel" => "0922222222"
        //   "del_addr" => "wwwwwww"
        //   "isAgree" => null



        return view('payment.page03', compact('text','member'));
    }

    function addorder(Request $request)
    {
        $oid = $request->input('oid');
        $name = $request->input('name');
        $style = $request->input('style');
        $count = $request->input('count');
        $pid = Goodsdetail::where('pname',$name)->where('pstyle',$style)->first()->pid;
        // dd($oid,$name,$style,$count,$pid);
        $addOrder = (new OrderDeatail)->createNewOrderDetail($oid,$pid,$count);
        dd($addOrder);
        


    }

    


























    //  尾巴
}


// 02 頁
// include('./mysqli.php');
// //確認是否為會員
// if (isset($_REQUEST['mid'])) {
//   //得到會員帳號與密碼進行驗證
//   $mid = $_REQUEST['mid'];
//   $psw = $_REQUEST['password'];
//   //得到付款方式與寄件方式


//  -------這裡我抓不到-----------
//   $pay = $_REQUEST['payment'];
//   $del = $_REQUEST['deliver'];

//   //帶入會員資料
//   $sql_member = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
//   $result = $mysqli->query($sql_member);
//   $data = $result->fetch_array();
//   $email = $data['email'];
//   $name = $data['name'];
//   $tel = $data['tel'];
// } else {
//   header("Location:/Maria/html/mb_login.php");
// }


// page 03
// include('./mysqli.php');
// //設定時區
// date_default_timezone_set('Asia/Taipei');

// if (isset($_REQUEST['mid'])) {
//     //確認是否為會員
//     $mid = $_REQUEST['mid'];
//     $psw = $_REQUEST['password'];
//     $sql_member = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
//     $result = $mysqli->query($sql_member);
//     $count = $result->num_rows;
//     //確認會員帳號密碼正確
//     if ($count > 0) {
//         $del_name = $_REQUEST['del_name'];
//         $del_tel = $_REQUEST['del_tel'];
//         $del_addr = $_REQUEST['del_addr'];
//         $memo = $_REQUEST['order_memo'];
//         $del_method = $_REQUEST['del_method'];
//         $pay_method = $_REQUEST['pay_method'];
//         $date = date('Y/m/d H:i:s'); //放入訂單的資訊


//         //確認付款與寄送的代號
//         $sql_pay = "SELECT paid FROM payment WHERE payment ='{$pay_method}'";
//         $result = $mysqli->query($sql_pay);
//         $row = $result->fetch_array();
//         $pay_method = $row['paid'];
//         $sql_del = "SELECT did FROM deliver WHERE deliver ='{$del_method}'";
//         $result = $mysqli->query($sql_del);
//         $row = $result->fetch_array();
//         $deliver_method = $row['did'];

//         //寫入資料庫
//         $sql_addOrder = "INSERT INTO memberorder(mid,orderdate,delAddr,delTel,delName,did,paid,memo) VALUES
//      ('{$mid}','{$date}','{$del_addr}','{$del_tel}','{$del_name}','{$deliver_method}','{$pay_method}','{$memo}')";
//         $mysqli->query($sql_addOrder);

//         //得到訂單編號，準備傳入下一個狀態
//         $sql_selectOrder = "SELECT oid FROM memberorder WHERE orderdate = '{$date}'";
//         $result = $mysqli->query($sql_selectOrder);
//         $row = $result->fetch_array();
//         $id = $row['oid'];

//         //放入介面的訂單編號
//         $order_date = date('Y/m/d');
//         //php的字串切割存入陣列
//         $a = mb_split('/',"{$order_date}");
//         $order_date = "$a[0]$a[1]$a[2]";
//         if($id<=10){
//           $id = '00'.$id;
//         }else if ($id<=100){
//           $id = '0'.$id;
//         }

//     } else {
//         header("Location:/Maria/html/mb_login.php");
//     }
// } else {
//     header("Location:/Maria/html/mb_login.php");
// }
