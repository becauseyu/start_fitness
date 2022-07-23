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
    $host = $_SERVER['HTTP_HOST'];

    //發送驗證信

    $mail = new PHPMailer(true);
    $mail->IsSMTP();                                    //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
    $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";
    $mail->Username = "1102136108@gm.kuas.edu.tw"; //Gamil帳號
    $mail->Password = "bynaaenzrlbquvio";                 //Gmail密碼(要去申請應用程式密碼)
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
            <a href='http://{$host}/php/confirmAcc.php?verify={$token}&time={$token_exptime}&acc={$acc}' target='_blank'>＞＞＞點此驗證您的信箱＜＜＜＜</a><br/>
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
    header("refresh:2;url=../html/mb_login.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊 | 動吃動吃</title>
    <!--加入jquery-->
    <script src="../_js/jquery/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <!--加入bootstrap-->
    <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../_js/bootstrap/bootstrap.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!-- 插入自己的css -->
    <link rel="stylesheet" href="../_css/main.css">
    <link rel="stylesheet" href="../_css/mb_login.css">
    <!-- 插入favicon -->
    <link rel="icon" href="../img/favico.ico" type="image/x-icon">


</head>

<body>
    <!-- 頁首  -->
    <div class="headerpage">
        <nav class="fixed-top  navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="../img/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7" aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-2 col-sm-2 ">　</div>
                <ul class="navbar-nav  nav-justif justify-content-around col-8 col-sm-8  " style="align-items: end;">
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link " href="./sp_introduce.php">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./gym_map.php">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="./openindex.php"><img width="60" height="60" style="display:block; margin:auto;" src="../img/LOGO.png"></a>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./fd_introduce.php">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-2 col-sm-2 d-flex justify-content-end ">
                    <a href="./mb_login.php">
                        <button type="button" class="btn ">
                            <i class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057">訪客</span> </i>
                        </button>
                    </a>

                    <a href="./payment_01.php">
                        <button type="button" class="btn btn-cart">
                            <i class="fa fa-shopping-cart navbar_fa" aria-hidden="true"></i>
                            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                        </button>
                    </a>


                </div>
            </div>
        </nav>

    </div>

    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset" style="margin-top:30px ;">
                        <p class="m-5">您已完成註冊，請於24小時內至您的信箱進行驗證。</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <div class='footerpage'>
    </div>
</body>
<script src="../_js/main.js"></script>
<script src="../_js/mb_login.js"></script>

</html>