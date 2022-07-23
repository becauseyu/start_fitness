<?php

$email = $_GET['email'];
// echo $email;



?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼 | 動吃動吃</title>
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
                    <div  class="m-5">
                            <form action="./fg_updatePsw.php" method="POST">
                                <p align="center">請輸入新密碼：</p>
                                <p align="center" id="validUpdate"></p>
                                <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>

                                <div class="input-group mb-1">
                                    <input id="fg_password" name="fg_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <i class="checkEye2 fas fa-eye"></i>
                                    <span id='cor_password' class="confirmSpan"></span>

                                </div>
                                <div class="input-group mb-3 ">
                                    <input id="fg_password2" name="fg_password2" type="text" class="password2 form-control ml-5 mr-5" placeholder="請再次輸入密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <i class="checkEye2 fas fa-eye"></i>
                                    <span id='cor_password2' class="confirmSpan"></span>
                                    <input name="fg_email" type="text" class="hidden" value="<?php echo $email?>" />
                                </div>
                                <div class="input-group mb-3">
                                    <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="重設密碼">
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
<script src="../_js/main.js"></script>
<script src="../_js/mb_renewPsw.js"></script>

</html>