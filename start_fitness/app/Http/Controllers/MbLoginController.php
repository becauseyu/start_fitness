<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\MbLoginTrait;
use App\Http\Traits\PhpMailTrait;
use App\Models\Member;
use App\Models\Log;



use Illuminate\Support\Facades\Session;
use mysqli;
use PhpParser\Node\Stmt\TryCatch;

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


    // 檢查新註冊帳號是否有重複
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



    // 帳號註冊
    function register(Request $request)
    {
        // 輸入的應該有
        // 1.re_account
        // 2.re_password
        // 3.re_name
        // 4.re_email
        $acc = '';
        $psw = '';
        $realName = '';
        $email = '';
        $text = (object) [];
        $text->title = '信箱驗證';
        $text->body = '';
        if ($request->input('re_account') && $request->input('re_password') && $request->input('re_name') && $request->input('re_email')) {
            $acc = $request->input('re_account');
            $psw = md5($request->input('re_password'));
            $realName = $request->input('re_name');
            $email = $request->input('re_email');



            $member = (new Member)->createNewMember($acc, $psw, $realName, $email);
            if ($member) {

                // 成功的時候送信送起來
                $sendmail = (object) [];
                $sendmail->email = $member->email;
                $id = $member->mid;
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
                        <a href='http://{$_SERVER['HTTP_HOST']}/member/confirmAcc?id={$id}&verify={$token}&time={$token_exptime}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>   
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
                $text->body = '感謝您的註冊！請先至您　註冊的信箱　收取驗證信！';
                return view('mb.confirmAcc', compact('text'));
            } else {
                $text->body = '註冊失敗，資料有問題';
            }

            return view('mb.confirmAcc', compact('text'));
        }



        // 資料有缺
        $text->body = '註冊失敗，資料有問題';
        return view('mb.confirmAcc', compact('text'));
    }




    // 帳號登入檢查
    use PhpMailTrait;
    function isMember(Request $request)
    {

        $acc = '';
        $psw = '';
        $error_log = '';
        $text  = (object) [];
        $text->title = '會員身分驗證';
        if ($request->lg_account &&  $request->lg_password) {
            $acc = $request->lg_account;
            $psw = $request->lg_password;
        } else {

            // 缺少帳密的跳轉回去
            return redirect('/member/login');
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
                $id = $member->mid;
                $token = md5($psw);
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
                            <a href='http://{$_SERVER['HTTP_HOST']}/member/confirmAcc?id={$id}&verify={$token}&time={$token_exptime}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>   
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
                $text->body = '您尚未完成 信箱驗證 ，這邊將自動重新發送驗證信，請立即到信箱查收！';
                return view('mb.confirmAcc', compact('text'));
            }



            // 登入成功在這裡
            (new Log)->writeLoginSuccess($acc);

            // 帳號驗證設計為 md5(密碼+帳號)
            $verify = md5(md5($psw).$acc);
            Session::put('verify', $verify);
            $url = '/member/update';

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

            // 帳密錯誤跳轉回去
            return redirect('/member/login');
        }



        return '你點下登入鈕，可是他正在施工';
    }


    // 帳號驗證
    function confirmAcc(Request $request)
    {
        // 輸入 id 、 verify 、time
        $id = '';
        $verify = '';
        $timeStamp = '';
        // 輸出 text
        $text  = (object) [];
        $text->title = '會員驗證是否成功';
        try {
            // 日期檢查
            if ($request->input('time')) {
                $timeStamp = $request->input('time') + (60 * 60 * 24); //得到驗證效期最後時間 UNIX(24小時)
                $nowtime = time();
                if ($nowtime > $timeStamp) {
                    $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                    return view('mb.confirmAcc', compact('text'));
                }
            } else {
                $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                return view('mb.confirmAcc', compact('text'));
            }

            // 帳號開通

            if ($request->input('id') && $request->input('verify')) {
                $verify = stripslashes(trim($request->input('verify'))); //得到驗證碼
                $id = $request->input('id');

                if ((new Member)->accountOpen($id, $verify)) {


                    $text->body = '驗證成功！將為您跳轉至登入頁面重新登入。';
                } else {
                    $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                }
            }
        } catch (\Throwable $th) {
            $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
        }

        return view('mb.confirmAcc', compact('text'));
    }


    //---------------------------------------------------------------------
    // 以下是忘記密碼
    function forget(Request $request)
    {
        $email = '';
        $text = (object) [];
        $text->title = '忘記密碼';
        $text->body = '';
        if ($request->input('fg_email')) {
            $email = $request->input('fg_email');

            $member = (new Member)->searchEmail($email);
            if ($member) {
                // 如果有找到資料開始寄信
                $sendmail = (object) [];
                $sendmail->email = $member->email;
                $token = $member->psw;
                $token_exptime = time();
                $acc = $member->account;
                $id = $member->mid;
                $sendmail->subject = "『動吃！動吃！』網站的密碼重設請求！"; //郵件標題
                $sendmail->body =  "
                <table style='background-color: white;'>
            <tr>
                <td>
                    <img src='https://upload.cc/i1/2022/07/07/cYzknK.png' style='width:800px'>
                </td>
            </tr>
        
            <tr>
                <td align='center' style='padding: 30px;font-size: 16px;'>
                    親愛的{$acc}：<br/>
                    請點選連結重設您的登入密碼。<br/>
                    <a href='http://{$_SERVER['HTTP_HOST']}/member/renewPsw?id={$id}&verify={$token}&time={$token_exptime}' target='_blank'>＞＞＞點此重設密碼＜＜＜＜</a><br/>
                    如果以上網址無法點取，請將它複製到你的瀏覽器位址列中進入訪問。<br/>
                    如果此次重設密碼請求非你本人所發，請盡速來信聯絡我們。<br/><p style='text-align:right'>
    
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
                $text->title = '忘記密碼_成功';
                $text->body = '已將重設密碼請求發送至您的註冊信箱！請盡速至信箱重設密碼。';
                return view('mb.confirmAcc', compact('text'));
            } else {
                $text->body = '請輸入正確的電子信箱';
                return view('mb.forget', compact('text'));
            }
        } else {
            return view('mb.forget', compact('text'));
        }
    }



    // 密碼重設畫面
    function renewPsw(Request $request)
    {
        // 輸入 id 、 verify 、time
        $id = '';
        $verify = '';
        $timeStamp = '';
        // 輸出 text
        $text  = (object) [];
        $text->title = '重設密碼';
        try {
            // 日期檢查
            if ($request->input('time')) {
                $timeStamp = $request->input('time') + (60 * 60 * 24); //得到驗證效期最後時間 UNIX(24小時)
                $nowtime = time();
                if ($nowtime > $timeStamp) {
                    $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                    return view('mb.confirmAcc', compact('text'));
                }
            } else {
                $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
                return view('mb.confirmAcc', compact('text'));
            }

            // 檢查帳密
            if ($request->input('id') && $request->input('verify')) {
                $verify = stripslashes(trim($request->input('verify'))); //得到驗證碼
                $id = $request->input('id');


                $member = (new Member)->idGet($id, $verify);
                if ($member) {
                    $text->id = $id;
                    $text->verify = $verify;

                    return view('mb.renewPsw', compact('text'));
                } else {
                    $text->body = '資料有誤';
                    return view('mb.confirmAcc', compact('text'));
                }
            } else {
                $text->body = '資料有誤';
                return view('mb.confirmAcc', compact('text'));
            }
        } catch (\Throwable $th) {
            $text->body = '您的驗證碼已過期，請至登入頁面重新登入驗證。';
            return view('mb.confirmAcc', compact('text'));
        }
    }

    // 修改密碼
    function updatePsw(Request $request)
    {
        // 輸入 id 、 verify 、 view(跳轉去哪頁) 、
        $id = '';
        $redirection = '';
        $psw = '';
        // 輸出 text
        $text  = (object) [];
        $text->title = '重設密碼';


        // 取得舊密碼
        if ($request->input('verify')) {
            $verify = $request->input('verify');
        } elseif ($request->input('old_password')){
            $verify = md5($request->input('old_password'));
        }else{
            $text->body = '修改失敗，發生錯誤';
            return view('mb.confirmAcc', compact('text'));
        }

        // 取得新密碼
        if ($request->input('fg_password')) {
            $psw = $request->input('fg_password');
        } else {
            $text->body = '修改失敗，發生錯誤';
            return view('mb.confirmAcc', compact('text'));
        }

        // 取得跳轉網址
        if ($request->input('view')) {
            $view = $request->input('view');
        } else {
            $view = 'mb.confirmAcc';
        }
        $text->redirection = $redirection;



        try {
            // 檢查帳密
            if ($request->input('id') && $verify) {
                $id = $request->input('id');

                // 只有找到的時候修改，其他全部失敗
                if ((new Member)->idGet($id, $verify)) {
                    $member = Member::find($id);
                    $member->psw = md5($psw); 
                    $member->save();             

                    $text->body = '修改成功，請重新登入';
                    return view('mb.confirmAcc', compact('text'));
                } else {
                    $text->body = '修改失敗，密碼有誤1';
                    return view($view, compact('text'));
                }
            } else {
                $text->body = '修改失敗，密碼有誤2';
                return view($view, compact('text'));
            }
        } catch (\Throwable $th) {
            $text->body = '修改失敗，密碼有誤3';
            return view($view, compact('text'));
        }
    }
}
