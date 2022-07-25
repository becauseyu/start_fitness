<?php
include('./mysqli.php');

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
    $user = '登入';
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
    <title>運動tips | 動吃動吃</title>

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
                        <a class="nav-link" href="./gym_map.php<?php echo $url; ?>">預約地圖</a>
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
                            <i id="user_icon" class="fa  navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user; ?></span> </i>
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
    <div id="mySidenavr" class="sidenavr">
        <a href="./fd_idx.php" id="Sidenavr">
            <img class="my-auto sideImgr " src="../img/FOOD_bw.png" alt="">
            <div class=" float-left iconcenterr  my-auto">
                <i class="fa fa-chevron-circle-left fa-3x   " aria-hidden="true"></i>
            </div>
        </a>
    </div>
    <!-- l側邊鈕/運動 -->
    <!-- <div id="mySidenavl" class="sidenavl">

        <a href="./sp_idx.php" id="Sidenavl" class="">

            <img class="my-auto sideImg1 " src="../AI/SP.png" alt="">
            <div class=" float-right iconcenter1  my-auto">
                <i class="fa fa-chevron-circle-right fa-3x   " aria-hidden="true"></i>
            </div>

        </a>
    </div> -->

    <div class="album py-4 ">
        <div class="container">
            <div class="row center-box">
                <div class="col-md-6">
                    <div class="card mb-4 SP-box cen" data-aos="fade-up">
                        <div class="pt-4">
                            <a href="https://www.womenshealthmag.com/tw/fitness/fitness-club/g33373736/how-to-use-inbody/" target="_blank">
                                <img src="../img/sp_introduce/sp09.jpg" height="300" class="rounded img-shadow"></a>
                        </div>
                        <div class="card-body">
                            <p class="head-font01 cen-brand">@Women's Health</p>
                            <h5 class="ml-1 card-title">減肥前必測InBody!教你看懂inbody數據</h5>
                            <p class="card-text pl-2">
                                &ensp;InBody體脂機透過電流通過人體，測出體脂、肌肉量與含水量等數據，教練說：「開始減肥前一定要測！」了解自己的身體組成，調整運動飲食才能對症下藥！
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.womenshealthmag.com/tw/fitness/fitness-club/g33373736/how-to-use-inbody/" target="_blank">
                                    <button type="button" class="btn button-blue">View</button>
                                </a>
                                <small class="text-muted01">10 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 SP-box cen" data-aos="fade-up">
                        <div class="pt-4">
                            <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34458540/deadlift-training/" target="_blank">
                                <img src="../img/sp_introduce/sp04.jpg" height="300" class="rounded img-shadow"></a>
                        </div>
                        <div class="card-body">
                            <p class="head-font01 cen-brand">@Women's Health</p>
                            <h5 class="ml-1 card-title">硬舉幫助減脂，女生更要練！教你正確姿勢</h5>
                            <p class="card-text pl-2">
                                &ensp;實在是想不出來，有什麼比從健身房地板舉起50公斤、75公斤甚至100公斤更能炫耀自己的強壯身體了。這就是硬舉這麼帥的原因之一，同時也是非常有效的訓練！
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34458540/deadlift-training/" target="_blank">
                                    <button type="button" class="btn button-blue">View</button>
                                </a>
                                <small class="text-muted01">6 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 第二行 -->
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/" target="_blank">
                                <img src="../img/sp_introduce/sp03.jpg" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@Women's Health</p>
                            <h5 class="ml-1 card-title-row2">初學者必讀「深蹲」教學！</h5>
                            <p class="card-text pl-2">
                                &ensp;健美女大生Kelly認為「深蹲」是一個最好入門的動作項目，不僅不用器材、而且很簡單。如果今天只要挑一個動作，CP值最高還不用器材的選擇—那就是深蹲。
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">15 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.womenshealthmag.com/tw/fitness/workoutroutine/g31719522/5-iger-glute-workout-routine/" target="_blank">
                                <img src="../img/sp_introduce/sp02.webp" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@三立新聞網</p>
                            <h5 class="ml-1 card-title-row2">9大運動降10%癌症死亡率</h5>
                            <p class="card-text pl-2">
                                &ensp;大家都知道，人活著就是要動，最美營養師高敏敏表示，全台灣沒有規律運動習慣的人竟高達72%，「不運動的人死亡率較高、易減短壽命，就是這麼可怕！」
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34458540/deadlift-training/" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">15 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/" target="_blank">
                                <img src="../img/sp_introduce/sp05.png" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@Women's Health</p>
                            <h5 class="ml-1 card-title-row2">「蜜桃臀養成」運動懶人包</h5>
                            <p class="card-text pl-2">
                                &ensp;即便天生扁臀、下盤肥大，都可以透過臀部訓練找到自己的漂亮蜜桃臀！說到練臀不乏跟深蹲聯想一起，實際上有許多訓練方式，針對不同臀部肌群做加強訓練！
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">18 mins</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 第三行 教練推薦  shuaisoserious chole  Peeta -->
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.instagram.com/shuaisoserious/" target="_blank">
                                <img src="../img/sp_introduce/sp06.png" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@shuaisoserious</p>
                            <h5 class="ml-1 card-title-row2">在美國Shuai Li 「帥」</h5>
                            <p class="card-text pl-2">
                                &ensp;住在美國的Shuai Li，也開啟自己的YouTube健身頻道，有點潮潮的他穿衣顯瘦脫衣有肉，尤其是胸肌的部分，你們自己評價看看囉！
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.youtube.com/channel/UCFd-9jAfbuUjwDZjisOwv1w/featured" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">15 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.instagram.com/chloe_t/" target="_blank">
                                <img src="../img/sp_introduce/sp07.png" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@chloe_t</p>
                            <h5 class="ml-1 card-title-row2">來自澳洲的Chloe Ting</h5>
                            <p class="card-text pl-2">
                                &ensp;澳洲健身Youtuber ChloeTing超過 2200萬訂閱者，嬌小的已35歲，身材十分勻稱，有女生夢寐以求的11字腹肌和性感的蜜桃臀。
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.youtube.com/channel/UCCgLoMYIyP0U56dEhEL1wXQ" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">16 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 SP-box01 cen" data-aos="fade-up">
                        <div class="mt-3">
                            <a href="https://www.instagram.com/peeta.gege/" target="_blank">
                                <img src="../img/sp_introduce/sp08.png" height="250" class="rounded img-shadow">
                            </a>
                        </div>

                        <div class="card-body">
                            <p class="head-font-row02 cen-brand">@peeta.gege</p>
                            <h5 class="ml-1 card-title-row2">YT教練PEETA葛格</h5>
                            <p class="card-text pl-2">
                                &ensp;「PEETA葛格」經常在網上分享健身知識及體態改造等系列影片，也擁有自己的健身房及健康餐品牌，對健身及飲食都相當有研究。
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.youtube.com/channel/UCSSjn1X6yMBC3AyJ2azeG7A/videos" target="_blank">
                                    <button type="button" class="btn button-blue02">View</button>
                                </a>
                                <small class="text-muted01">10 mins</small>
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