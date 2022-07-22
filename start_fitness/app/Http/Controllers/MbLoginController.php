<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\MbLoginTrait;
use App\Http\Traits\PhpMailTrait;
use App\Models\Member;
use App\Models\Log;



use Illuminate\Support\Facades\Session;
use mysqli;


class MbLoginController extends Controller
{


    // 真的撈不到的時候使用原始mysqli撈資料
    function mysqli()
    {
        //連線mysql資料庫
        $mysqli = new mysqli('localhost', 'root', '', 'startfitness', 3306);
        //設定程式庫語言
        $mysqli->set_charset('utf8');

        return $mysqli;
    }


    // 檢查是否有重複
    function isNewAccount(Request $request)
    {
        $acc = $request->account;
        // $mysqli = $this->mysqli();


        //  使用 try catch，抓不到值會延遲
        try {
            $aa = Member::where('account', $acc)->first();
            $result = $aa->account;
            return $result;
        } catch (\Throwable $th) {
            return;
        }



        // 嘗試 firstOrFail 好像不太對
        // $result = Member::where('account', $acc)->firstOrFail();
        // return $result;

        //  原寫法    
        // if (isset($acc)) {
        //     //判定帳號密碼是否正確
        //     $sql = "SELECT * FROM member WHERE account = '{$acc}'";
        //     $result = $mysqli->query($sql);
        //     //輸出畫面(代表有重複)
        //     return $result->num_rows;
        // }
    }

    function register(Request $request)
    {
        return '你點下註冊鈕，可是他正在施工';
    }



    use PhpMailTrait;
    function isMember(Request $request)
    {

        $acc = '';
        $psw = '';
        $error_log = '';

        if ($request->lg_account &&  $request->lg_password) {
            $acc = $request->lg_account;
            $psw = $request->lg_password;
        } else {

            // 缺少帳密的往這裡走
            $error_log = 'somthing wrong';


            return '沒有帳密';
        }


        $memberList = new Member();

        if ($memberList->accountCheck($acc, $psw)) {
            Session::put('account', $acc);
            Session::forget('loginError');
            $member = $memberList->where('account', $acc)->first();



            if ($member->staId == 1) {
                // 信箱未驗證
                $sendmail = (object) [];
                $sendmail->email = $member->email;

                $token = $psw;
                $token_exptime = time();
                $sendmail->subject = "請認證您在『動吃！動吃！』的會員註冊"; //郵件標題
                $sendmail->body = "
                    <table style='background-color: white;'>
                    <tr>
                        <td>
                            <img src='https://upload.cc/i1/2022/07/07/cYzknK.png' style='width:800px'>
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <h1 style='color: rgb(223, 128, 34) ;'>感謝您在『動吃！動吃！』網站註冊會員</h1>

                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding: 30px;font-size: 16px;'>
                            親愛的{$acc}：<br/>
                            請點選連結啟用您的帳號。<br/>
                            <a href='http://{$_SERVER['HTTP_HOST']}/Maria/php/confirmAcc.php?verify={$token}&time={$token_exptime}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>   
                            如果以上網址無法點取，請將它複製到你的瀏覽器位址列中進入訪問，該連結24小時內有效。<br/>
                            如果此次啟用請求非你本人所發，請忽略本郵件。<br/><p style='text-align:right'>

                        </td>
                    </tr>
                    <tr>
                        <td style='background-color: rgb(142,180,227);padding: 20px;'>
                            <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊如資訊有問題，請來信<a
                                    href='startfitness0809@gmail.com'>startfitness0809@gmail.com</a>告知＊</p>

                        </td>
                    </tr>
                </table>
                    "; //郵件內容


                // 寄信
                $this->composeEmail($sendmail);
            }


            $url = '/member/update/' . $acc;
            // 登入成功在這裡
            return redirect($url);
        } else {

            // 登入失敗往這裡
            $loginError = Session::get('loginError') | 0;
            $loginError += 1;
            Session::put('loginError', $loginError);


            if ($loginError >= 5) {
                $error_log = new Log();
                $error_log->writeLoginTimes($acc, 5);
                Session::put("loginError", 0);
            }

            return '登入失敗';
        }



        return '你點下登入鈕，可是他正在施工';
    }



    function confirmAcc()
    {
        $verify = stripslashes(trim($_GET['verify'])); //得到驗證碼
        // echo $verify;
        $timeStamp = $_GET['time'] + (60 * 60 * 24); //得到驗證效期最後時間 UNIX(24小時)
        // echo date("Y-m-d",$timeStamp);
        $nowtime = time();
        $sql = "SELECT * FROM member WHERE psw = '{$verify}' ";
        $result = $mysqli->query($sql);
        // var_dump($result);
        $row =  $result->num_rows; //確認是否有符合的

        $text = "";

        if ($row > 0) {
            if ($nowtime > $timeStamp) {
                $text = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                header('Location:../html/mb_login.html');
            } else {
                $sqlConfirm = "UPDATE member SET staId = 2 WHERE psw = '{$verify}'";
                $mysqli->query($sqlConfirm);
                $text = '驗證成功！將為您跳轉至登入頁面重新登入。';
                //設定幾秒後做頁面跳轉
                header("refresh:2;url=../html/mb_login.php");
            }
        }
        return view('mb.confirmAcc');
    }
}
