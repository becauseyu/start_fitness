<?php

include_once('./mysqli.php');

//確認是否為會員
if (isset($_REQUEST['mid']) && $_REQUEST['psw']) {
    //從網址得到會員帳號
    $mid = $_REQUEST['mid'];
    $psw = $_REQUEST['psw'];
    //找出所有會員的資料放進去
    $sql_data = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
    $result = $mysqli->query($sql_data);
    $data = $result->fetch_array();
    //抓全部的東西出來
    $acc = $data['account'];
    $pws = $data['psw'];
    $user = '';
    $url = "?mid={$mid}&psw={$psw}";
    $memberPage = "./mb_update.php?mid={$mid}&psw={$psw}";
} else {
    $user = '訪客';
    $url = '';
    $memberPage = "./mb_login.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>吃 吃得健康! | 動吃動吃</title>
    <!--加入leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!--加入leaflet js(一定要在css之後)-->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <!--加入jquery-->
    <script src="../_js/jquery/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入bootstrap-->
    <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../_js/bootstrap/bootstrap.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!--加入AOS-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- 插入自己的css -->
    <link rel="stylesheet" href="../_css/main.css">
    <!-- 插入favicon -->
    <link rel="icon" href="../img/favico.ico" type="image/x-icon">

    <style>
        img {
            object-fit: contain;
        }
    </style>

</head>


<body>
    <!-- navbar -->
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
                        <a class="nav-link " href="./sp_introduce.php<?php echo $url; ?>">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url; ?>">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./gym_map.php<?php echo $url; ?>">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="./openindex.php<?php echo $url; ?>"><img width="60" height="60" style="display:block; margin:auto;" src="../img/LOGO.png"></a>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./fd_introduce.php<?php echo $url; ?>">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url; ?>">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-2 col-sm-2 d-flex justify-content-end ">
                    <a href="<?php echo $memberPage; ?>">
                        <button type="button" class="btn ">
                            <i class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user; ?></span> </i>
                        </button>
                    </a>

                    <a href="./payment_01.php<?php echo $url; ?>">
                        <button type="button" class="btn btn-cart">
                            <i class="fa fa-shopping-cart navbar_fa" aria-hidden="true"></i>
                            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                        </button>
                    </a>
                    <a id='userlogout' style="color:black" href="./mb_logout.php">
                        <button type="button" class="btn" title="登出">
                            <i class="fa fa-sign-out navbar_fa" aria-hidden="true"></i>
                        </button>
                    </a>

                </div>
            </div>
        </nav>

    </div>
    <!-- r側邊鈕/飲食 -->
    <!-- <div id="mySidenavr" class="sidenavr">
        <a href="./fd_idx.php" id="Sidenavr">
            <img class="my-auto sideImgr " src="../AI/FOOD.png" alt="">
            <div class=" float-left iconcenterr  my-auto">
                <i class="fa fa-chevron-circle-lef fa-3x   " aria-hidden="true"></i>
            </div>
        </a>
    </div> -->
    <!-- l側邊鈕/運動 -->
    <div id="mySidenavl" class="sidenavl">

        <a href="./sp_idx.php" id="Sidenavl" class="">

            <img class="my-auto sideImg1 " src="../img/SP _bw.png" alt="">
            <div class=" float-right iconcenter1  my-auto">
                <i class="fa fa-chevron-circle-right fa-3x   " aria-hidden="true"></i>
            </div>

        </a>
    </div>


    <!-- 中間文字框 -->
    <div class="">
        <div class="" style="width: 100%; height :75px;"></div>
        <div class="container mt-4 " data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">飲食Tip</h3>
                <hr>
                <div class=" row">
                    <div class="col-6 ">
                        <a href="hhttps://www.i-fit.com.tw/context/1727.html" class="stretched-link" target="_blank">
                            <figure class="figure ">
                                <img src="../img/fd_introduce/f7.png" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="300">
                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">為什麼瘦身要吃低脂、高蛋白？</p>
                                    <p class="pr-3">你一定聽過一句話：「減肥七分靠飲食、三分靠運動。」
                                        <br>
                                        減肥時期因為熱量被限制，所吃的每一口食物都是重點，但為什麼要吃「低脂、高蛋白」的食物呢？</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">

                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1763.html" target="_blank"
                                    class="boxcolor2">忘東忘西？長白頭髮？原來是腎氣不足！？
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1613.html" target="_blank"
                                    class="boxcolor2">自助餐主菜區包你肥前三名！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1231.html" target="_blank"
                                    class="boxcolor2">維他命 C 助瘦身 芭樂更勝奇異果
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1039.html" target="_blank"
                                    class="boxcolor2">拳頭量大小 輕鬆算營養
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/95.html" target="_blank"
                                    class="boxcolor2">蛤蜊南瓜濃湯_低卡減肥食譜
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1837.html" target="_blank"
                                    class="boxcolor2">夏日常見七水果，評比大會開始！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1928.html" target="_blank"
                                    class="boxcolor2">致肥果糖不在水果裡？
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1685.html" target="_blank"
                                    class="boxcolor2">香蕉 5 妙用，助瘦助眠又消腫！
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
                <div>
                    <a href="../html/fd_introduce.php<?php echo $url; ?>" class="text-right font-weight-light">
                        <p class=""> 觀看更多文章...</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="container mt-4" data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">Mini game</h3>
                <hr>
                <img class='m-3' src="../img/minigame.jpg">
                <h5 class="boxcolor1">用BMI小遊戲，做個遠離高熱量食物的想像訓練吧 ( ﾟдﾟ)▄︻┻┳═一</h5>
            </div>
        </div>

        <div class="container mt-4" data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">飲食小食</h3>
                <hr>
                <div class=" row">
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/food/popcron03.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">飽米花‧椒鹽</h5>
                                    <p class="">淡淡鹽味，清爽少負擔</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/food/fruitwater02.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">好好果乾水‧好心情</h5>
                                    <p class="">柑橘香，喝水好心情</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/food/jelly03.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">飽飽凍</h5>
                                    <p class="">午後時光必備零食</p>
                                </figcaption>
                            </figure>
                        </a>

                    </div>
                </div>

                <div class="">
                    <a href="../html/goods_index.php<?php echo $url; ?>" class="text-right font-weight-light">
                        <p class=""> 更多小食商品...</p>
                    </a>
                </div>
            </div>

        </div>




    </div>
    <!-- 腳 -->
    <div class="footerpage"></div>


    <script>
        AOS.init();
    </script>

</body>

<script src="../_js/main.js"></script>


</html>