<?php

include('../php/mysqli.php');
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_REQUEST['fg_email'];

if (isset($email)) {
    $sql = "SELECT * FROM member WHERE email = '{$email}'";
    $result = $mysqli->query($sql);
    $row =  $result->num_rows; //確認是否有符合的
    $data = $result->fetch_array();
    //代表沒有輸入錯誤的註冊信箱
    if ($row > 0) {
        //發重設密碼的信件
        $acc = $data['account'];
        $mail = new PHPMailer(true);
        $mail->IsSMTP();                                    //設定使用SMTP方式寄信
        $mail->SMTPAuth = true;                        //設定SMTP需要驗證
        $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
        $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
        $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
        $mail->CharSet = "utf-8";
        $mail->Username = ""; //Gamil帳號
        $mail->Password = "";                 //Gmail密碼(要去申請應用程式密碼)
        $mail->From = "startfitness0809@gmail.com";        //寄件者信箱
        $mail->FromName = "動吃!動吃!";                  //寄件者姓名
        $mail->Subject = "『動吃！動吃！』網站的密碼重設請求！"; //郵件標題
        $mail->Body = "
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
                <a href='http://localhost:3000/Maria/php/renewPsw.php?email={$email}' target='_blank'>＞＞＞點此重設密碼＜＜＜＜</a><br/>
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
        $mail->IsHTML(true);
        $mail->AddAddress("$email");
        $mail->Send();
        $text = '';
        //跳轉回認證正確訊息
        header('Location:../php/forget_ok.php');
    }
    //代表了錯誤的信箱 
    else {
        $text = '請輸入正確的電子信箱';
    }
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
    <title>忘記密碼</title>
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
                        <div id='forget' class="m-5">
                            <form action="../php/forget.php" method="POST">
                                <p align="center">忘記密碼：</p>
                                <div class="input-group mb-3">
                                    <input id="fg_email" name="fg_email" type="text" class="form-control ml-5 mr-5" placeholder="請輸入註冊信箱" aria-label="Email" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="重設密碼" />
                                    <span class='notice ml-5'><?php echo $text;  ?></span>
                                </div>
                            </form>
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
<script>

</script>

</html>