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
    $memberPage = "./mb_update.php?mid={$mid}}&psw={$psw}";
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
    <title>飲食tips | 動吃動吃</title>

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
    <link rel="stylesheet" href="../_css/sp_intr.css">
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
            <div class=" float-lef iconcenterr  my-auto">
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

    <div class="card-deck card-group"></div>
    <div class="album py-5 ">
        <div class="container">
            <div class="row ">

                <div class="card-deck">
                    <div class="col-md-6 card mb-4 border-warning shadow-sm " data-aos="fade-up">

                        <img src="../img/fd_introduce/f3.png" alt="" class="img-fluid rounded ">

                        <div class="card-body">
                            <h5 class="card-title">夏日常見七水果，評比大會開始！</h5>
                            <p class="card-text">熱浪來襲，夏天終於來臨囉！炎炎夏日是吃水果的大好季節，編編已經準備大飽口福了呢。(*ﾟ∀ﾟ*)
                                <br>
                                當令水果都富含營養，有些更具備美白、抗老、抗水腫等妙用，究竟有哪些「夏季好果」不該錯過呢？這些水果佳麗各有特色，就讓編編為大家一一點評
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1837.php" target="_blank">
                                    <button type="button" class="btn button01">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-06-23</small>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="col-md-6 card mb-4 border-warning shadow-sm " data-aos="fade-up">

                        <img src="../img/fd_introduce/f4.png" alt="" class="img-fluid rounded ">

                        <div class="card-body ">
                            <h5 class="card-title">忘東忘西？長白頭髮？原來是腎氣不足！？</h5>
                            <p class="card-text">熱「最近腦袋一直記不住東西，是不是年紀真的變大了...」(〒︿〒)
                                <br>
                                有這個煩惱的團員們，先和編編一起做個小測驗，看看下面情況你是否不陌生？
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1763.php" target="_blank">
                                    <button type="button" class="btn button01">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-06-03</small>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card-deck">
                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f1.jpg" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">自助餐主菜區包你肥前三名！</h5>
                            <p class="card-text">自助餐可算是外食一族的均衡補給站，但若想避免熱量超標，挑選菜色時就得特別小心。否則每餐都爆卡，體重當然會跟著一路攀升啊！</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1613.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2016-08-22</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f2.png" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">維他命 C 助瘦身 芭樂更勝奇異果</h5>
                            <p class="card-text">
                                酸酸甜甜的奇異果，相信是很多團員瘦身期間的最愛～奇異果因其高密度的營養價值，在歐美被譽為超級水果之一，不過奇異果不便宜捏，若想天天吃還挺傷本的... </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1231.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2014-10-08</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f8.jpg" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">致肥果糖不在水果裡？</h5>
                            <p class="card-text">
                                欸欸，聽說水果的果糖進入身體會直接變成脂肪，瘦身是不是少碰水果為妙？
                                會有這樣的說法，最好先了解醣類在體內的代謝狀況。(≖＿≖)✧</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1928.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2018-02-19</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-deck">

                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f6.jpg" class="img-fluid rounded " alt="">


                        <div class="card-body">
                            <h5 class="card-title">蛤蜊南瓜濃湯_低卡減肥食譜</h5>
                            <p class="card-text">
                                蛤蜊和南瓜都是營養價值極高的食材，加上了牛奶令味道更顯香濃，巧妙運用電鍋好幫手，只需簡簡單單三步驟，營養滿分的濃湯就能輕鬆上桌囉！</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/95.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2013-01-04</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f7.png" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">為什麼瘦身要吃低脂、高蛋白？</h5>
                            <p class="card-text">
                                你一定聽過一句話：「減肥七分靠飲食、三分靠運動。」

                                減肥時期因為熱量被限制，所吃的每一口食物都是重點，但為什麼要吃「低脂、高蛋白」的食物呢？</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1727.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-11-16</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="../img/fd_introduce/f5.jpg" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">拳頭量大小 輕鬆算營養</h5>
                            <p class="card-text">
                                六大類食物又要怎樣吃才夠？一份究竟是多少咧？

                                告訴大家一個小祕密，其實只要伸出拳頭，就能簡單測量食物的「份量」，現在就讓小編將技巧通通傳授給你吧！</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1039.php" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2014-03-11</small>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>
    <!-- 腳 -->
    <div class="footerpage"></div>
    <script src="../_js/main.js"></script>

    <script>
        AOS.init();
    </script>
</body>



</html>