<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    @include('front_side_frame.link')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>

    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/mb_login.css" rel="stylesheet">


    <title>Log In 會員登入</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class='headerpage'>
        @include('front_side_frame.header')
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
                                <input id="lg_account" name="lg_account" type="text" class="form-control ml-5 mr-5"
                                    placeholder="帳號" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <input id="lg_password" name="lg_password" type="password"
                                    class="form-control ml-5 mr-5" placeholder="密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required>
                                <i id="checkEye" class="fas fa-eye-slash"></i>
                            </div>
                            <input id="remember" type="checkbox" class="ml-5">記住我
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="登入">
                            </div>
                            <p align="center"><a href="../html/mb_forget.html">忘記密碼?</a></p>
                        </form>
                        <form id='register_form' class="m-5 hidden" method="POST" enctype="multipart/form-data"
                            action="member/login/register">
                            <p align="center" class="mt-n4">註冊會員：</p>
                            <p align="center" id="validUpdate"></p>
                            <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的帳號(有大小寫之分)*</span><span id='message'></span>
                            <div class="input-group mb-1">
                                <input id="re_account" name="re_account" type="text"
                                    class="re_account form-control ml-5 mr-5" placeholder="帳號" aria-label="Username"
                                    aria-describedby="basic-addon1" required onchange="ckdNewAccount()">
                                <span id='cor_account' class="confirmSpan"></span>
                                <br />
                            </div>
                            <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>
                            <div class="input-group mb-1">
                                <input id="re_password" name="re_password" type="text"
                                    class="password2 form-control ml-5 mr-5" placeholder="密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password' class="confirmSpan"></span>

                            </div>
                            <div class="input-group mb-3 ">
                                <input id="re_password2" name="re_password2" type="text"
                                    class="password2 form-control ml-5 mr-5" placeholder="請再次輸入密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password2' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="re_name" name="re_name" type="text" class="form-control ml-5 mr-5"
                                    placeholder="真實姓名" aria-label="Realname" aria-describedby="basic-addon1"
                                    required>
                            </div>
                            <div class="input-group mb-3">
                                <input id="re_email" name="re_email" type="email" class="form-control ml-5 mr-5"
                                    placeholder="信箱" aria-label="Username" aria-describedby="basic-addon1" required>
                                <span id='cor_email' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-info' type="submit" value="註冊">
                            </div>
                            <p align="center">已有會員?請點此<input type="button" class="btn btn-success"
                                    id="change_login" value="登入"></input>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 購物車-->
    <div id="slide_buycart">
        <i class="fa-solid fa-circle-xmark" onclick="closebuycar()"></i>
        <div id='slide_buycart_title' class="slide_buycart_title">
            |您的購物清單|
        </div>
        <div id='slide_buycart_content' class="slide_buycart_content">
            <nav id='slide_buycart_goods'></nav>
        </div>

        <div id='slide_buycart_bottom' class="slide_buycart_bottom">
            <hr>
            <p id="totalCount" class="hide">0</p>
            <p class="slide_buycart_total">總計 NT$<span id="slide_buycart_accounttotal">0</span></p>
            <a href="/Eva/buycart/payment_01.php"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


        </div>

    </div>
    <!-- 頁尾 -->
    <footer>
        @include('front_side_frame.footer')
    </footer>
</body>
<script src="/js/main.js"></script>
<script src="/js/mb_login.js"></script>

</html>
