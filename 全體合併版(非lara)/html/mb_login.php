<?php

//判斷如果已經是會員，就直接進入會員修改資料
if(isset($_REQUEST['mid']) && $_REQUEST['psw']){
    $mid = $_REQUEST['mid'];
    $psw = $_REQUEST['psw'];
    header("Location:./mb_update.php?mid={$mid}&psw={$psw}");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入 | 動吃動吃</title>
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
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;"
                    src="../img/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7"
                aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="d-none d-lg-block px-4" href="./openindex.php"><img width="60" height="60"
                            style="display:block; margin:auto;" src="../img/LOGO.png"></a>
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
                            <i class="fa fa-user-o navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057">登入</span> </i>
                        </button>
                    </a>

                    <a href="./payment_01.php" >
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
                    <div class="content-tabset">
                        <ul class="nav nav-tabs">
                            <li class="nav-li selected" id="login">會員登入</li>
                            <li class="nav-li" id="register">註冊會員</li>
                        </ul>
                        <form id='login_form' class="m-5" action="../php/isMember.php" method="post">
                            <p align="center">親愛的 <span id="who">訪客</span> 您好：</p>
                            <p align="center">會員登入：</p>
                            <div class="input-group mb-3">
                                <input id="lg_account" name="lg_account" type="text" class="form-control ml-5 mr-5" placeholder="帳號" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <input id="lg_password" name="lg_password" type="password" class="form-control ml-5 mr-5" placeholder="密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i id="checkEye" class="fas fa-eye-slash"></i>
                            </div>
                            <input id="remember" type="checkbox" class="ml-5">記住我
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="登入">
                            </div>
                            <p align="center"><a href="../html/mb_forget.html">忘記密碼?</a></p>
                        </form>
                        <form id='register_form' class="m-5 hidden" method="POST" enctype="multipart/form-data" action="../php/register.php">
                            <p align="center" class="mt-n4">註冊會員：</p>
                            <p align="center" id="validUpdate"></p>
                            <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的帳號(有大小寫之分)*</span><span id='message'></span>
                            <div class="input-group mb-1">
                                <input id="re_account" name="re_account" type="text" class="re_account form-control ml-5 mr-5" placeholder="帳號" aria-label="Username" aria-describedby="basic-addon1" required onchange="ckdNewAccount()">
                                <span id='cor_account' class="confirmSpan"></span>
                                <br />
                            </div>
                            <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>
                            <div class="input-group mb-1">
                                <input id="re_password" name="re_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password' class="confirmSpan"></span>

                            </div>
                            <div class="input-group mb-3 ">
                                <input id="re_password2" name="re_password2" type="text" class="password2 form-control ml-5 mr-5" placeholder="請再次輸入密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password2' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="re_name" name="re_name" type="text" class="form-control ml-5 mr-5" placeholder="真實姓名" aria-label="Realname" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <input id="re_email" name="re_email" type="email" class="form-control ml-5 mr-5" placeholder="信箱" aria-label="Username" aria-describedby="basic-addon1" required>
                                <span id='cor_email' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-info' type="submit" value="註冊">
                            </div>
                            <p align="center">已有會員?請點此<input type="button" class="btn btn-success" id="change_login" value="登入"></input>
                            </p>
                        </form>
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