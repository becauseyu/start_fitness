<?php

include('../php/mysqli.php');
//把phpmailer帶進來
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
//取得帳號密碼做驗證
$acc = $_REQUEST['lg_account'];
//因為密碼用MD5加密放入的
$psw = md5($_REQUEST['lg_password']);

if (isset($acc)) {
    //判定帳號密碼是否正確
    $sql = "SELECT * FROM member WHERE account = '{$acc}' AND psw ='$psw'";
    $result = $mysqli->query($sql);
    $row =  $result->num_rows; //確認是否有符合的
    //如果帳號密碼正確
    if ($row > 0) {
        $data = $result->fetch_array();
        $status = $data['staId'];
        $email = $data['email'];
        $token = $psw;
        $token_exptime = time();
        $wrongPsw = '';
        //驗證是否完成驗證
        if ($status == 1) {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();                                    //設定使用SMTP方式寄信
            $mail->SMTPAuth = true;                        //設定SMTP需要驗證
            $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
            $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
            $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
            $mail->CharSet = "utf-8";
            $mail->Username = "startfitness0809@gmail.com"; //Gamil帳號
            $mail->Password = "jsifadwuzaatcklc";                 //Gmail密碼(要去申請應用程式密碼)
            $mail->From = "startfitness0809@gmail.com";        //寄件者信箱
            $mail->FromName = "動吃!動吃!";                  //寄件者姓名
            $mail->Subject = "請認證您在『動吃！動吃！』的會員註冊"; //郵件標題
            $mail->Body = "
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
                            <a href='http://localhost:3000/Maria/php/confirmAcc.php?verify={$token}&time={$token_exptime}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>
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
            $mail->IsHTML(true);
            $mail->AddAddress("$email"); //收件者email
            $mail->Send();
            //錯誤訊息為空值
            $wrongPsw = '您尚未完成 信箱驗證 ，這邊將自動重新發送驗證信，請立即到信箱查收！';

            //在自動跳轉回登入頁
            header("refresh:3;url=../html/mb_login.php");
        }
        //如果是1代表已完成驗證會員
        else if ($status = 2) {
            header("Location:../html/mb_update.php?account={$acc}&psw={$psw}");
        }
    } else {
        //顯示錯誤訊息
        $wrongPsw = '帳號密碼錯誤';
        header("refresh:1;url=../html/mb_login.php");
    };
}
//如果帳號密碼輸入錯誤就回到繼續回到登入頁
else {

    header("url=../html/mb_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--加入jquery-->
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.toast.js"></script>
    <link href="../css/jquery.toast.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入bootstrap-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!-- 頁首頁尾的css -->
    <link href="/MengYing/大專/_css/head.css" rel="stylesheet">
    <!-- 插入自己的css -->
    <link href="../css/main.css" rel="stylesheet">



    <title>會員身分驗證</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class="headerpage">
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <div id='login_form' class="m-5">
                            <?php echo $wrongPsw ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 頁尾 -->
    <div class='footerpage'>

    </div>
</body>
<script src="../js/main.js"></script>




</html>