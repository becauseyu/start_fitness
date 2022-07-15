<?php
include('../php/mysqli.php');
$oPsw = md5($_POST['old_password']);
$nPsw = md5($_POST['fg_password']);
$email = $_POST['fg_email'];
//先確認舊密碼是否正確
$sqlConfirm = "SELECT * FROM member WHERE email = '{$email}' AND psw = '{$oPsw}' ;";
$result = $mysqli->query($sqlConfirm);
$count = $result->num_rows;
$text = '';
//有找到代表舊密碼正確
if ($count > 0) {
    //已信箱為條件去搜尋並更新密碼
    $sqlRenewPsw = "UPDATE member SET psw = '{$nPsw}' WHERE email = '{$email}'";
    $mysqli->query($sqlRenewPsw);
    $text = '密碼已更新完成，請重新登入！';
    header("refresh:2;url=../html/mb_login.php");
}else{
    $sqlOrign = "SELECT * FROM member WHERE email = '{$email}'";
    $result2 = $mysqli->query($sqlOrign);
    $data = $result2->fetch_array();
    $mid = $data['mid'];
    $psw = $data['psw'];
    $text = '舊密碼輸入錯誤!';
    header("refresh:2;url=../html/mb_update.php?mid={$mid}&psw={$psw}");

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
    <title>密碼更新成功</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class='headerpage'>
        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="../AI/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7" aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-1"></div>
                <ul class="navbar-nav mx-auto nav-justif justify-content-around " style="align-items: end;">
                    <li class="nav-iteml px-1">
                        <a class="nav-link " href="#">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1">
                        <a class="nav-link" href="#">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1">
                        <a class="nav-link" href="#">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="../AI/LOGO.png"></a>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-1 d-flex justify-content-end">
                    <button class="btn ">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-cart" data-toggle="dropdown" onclick="openbuycar()">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                    </button>
                </div>
            </div>
        </nav>
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <div class="m-5">
                            <?php echo $text ?>
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
<script src="../js/mb_renewPsw.js"></script>



</html>