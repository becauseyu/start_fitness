<?php
include('../php/mysqli.php');
//把phpmailer帶進來
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;


//將帳號新增到資料庫
$account = $_REQUEST['re_account'];

if (isset($account)) {
    $acc = $_REQUEST['re_account'];
    //密碼使用MD5雜湊放入
    $psw = md5($_REQUEST['re_password']);
    $realName = $_REQUEST['re_name'];
    $email = $_REQUEST['re_email'];
    //這邊新增一個參數為驗證碼，之後要拿來做驗證啟用
    $token = $psw;
    $token_exptime = time(60 * 60 * 24); //驗證碼效期為24小時

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
            <a href='http://localhost:3000/Maria/php/confirmAcc.php?verify={$token}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>
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
    header('Location:../html/mb_confirm.html');
}
