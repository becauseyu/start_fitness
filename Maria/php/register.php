<?php
include('../php/mysqli.php');
//把phpmailer帶進來
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$account = $_REQUEST['re_account'];

//將帳號新增到資料庫
if (isset($account)) {
    $acc = $_REQUEST['re_account'];
    //密碼使用MD5雜湊放入
    $psw = md5($_REQUEST['re_password']);
    $realName = $_REQUEST['re_name'];
    $email = $_REQUEST['re_email'];
    //這邊新增一個參數為驗證碼，之後要拿來做驗證啟用
    $token = $psw;
    $token_exptime = time(); //驗證碼效期為24小時

    $sql = "INSERT INTO member(account,psw,name,email) VALUES ('{$acc}','{$psw}','{$realName}','{$email}')";
    $result = $mysqli->query($sql);

    //發送驗證信

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
    $mail->IsHTML(true);                     //郵件內容為html
    $mail->AddAddress("$email");            //收件者郵件及名稱
    $mail->Send();
    //設定幾秒後做頁面跳轉
    header("refresh:2;url=../html/mb_login.html");
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


    <title>信箱驗證</title>
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
                            感謝您的註冊！請先至您　註冊的信箱　收取驗證信！

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