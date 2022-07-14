<?php
include_once('../php/mysqli.php');

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
        header("refresh:2;url=../html/mb_login.html");
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



    <title>會員驗證是否成功</title>
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

                        <div id='login_form' class="m-5">
                            <?php echo $text; ?>
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