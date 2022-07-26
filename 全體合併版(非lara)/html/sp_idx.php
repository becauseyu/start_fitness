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
    <title>動 動起來阿! | 動吃動吃</title>
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
    <link rel="stylesheet" href="../_css/sp_idx.css">
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
                             <i  id="user_icon" class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user; ?></span> </i>
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


    <!-- 中間文字框 -->
    <div class="" style="width: 100%; height :75px;"></div>
    <div class="">
        <div class="container mt-4 " data-aos="fade-right">
        <div class="boxsp">
                <h3 class="boxcolor2">運動Tip</h3>
                <hr>
                <div class=" row">
                    <div class="col-6 ">
                        <a href="https://www.womenshealthmag.com/tw/fitness/fitness-club/g33373736/how-to-use-inbody/"
                            target="_blank" class="stretched-link">
                            <figure class="figure ">
                                <img src="../img/sp_introduce/sp09.jpg" height="250"
                                    class="figure-img img-fluid rounded shadow-sm">

                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">減肥前必測InBody!教你看懂inbody數據</p>
                                    <p class="pr-3">
                                         InBody體脂機透過電流通過人體，測出體脂、肌肉量與含水量等數據，教練說：「開始減肥前一定要測！」了解自己的身體組成，調整運動飲食才能對症下藥！</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">
                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34458540/deadlift-training/"
                                    target="_blank" class="boxcolor2">硬舉幫助減脂，女生更要練！教你正確姿勢
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://tw.news.yahoo.com/%E9%99%8D10-%E7%99%8C%E7%97%87%E6%AD%BB%E4%BA%A1%E7%8E%87-%E9%81%8B%E5%8B%959%E5%A4%A7%E5%A5%BD%E8%99%95%E6%9B%9D-043542688.html"
                                    target="_blank" class="boxcolor2">9大運動幫助降10%癌症死亡率
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/"
                                    target="_blank" class="boxcolor2">初學者必讀「深蹲」教學！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/workoutroutine/g31719522/5-iger-glute-workout-routine/"
                                    target="_blank" class="boxcolor2">「蜜桃臀養成」運動懶人包
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/workoutroutine/g31719522/5-iger-glute-workout-routine/"
                                    target="_blank" class="boxcolor2">硬舉幫助減脂，女生得練！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.youtube.com/channel/UCFd-9jAfbuUjwDZjisOwv1w/featured"
                                    target="_blank" class="boxcolor2">在美國Shuai Li 「帥」
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.youtube.com/channel/UCCgLoMYIyP0U56dEhEL1wXQ" target="_blank"
                                    class="boxcolor2">來自澳洲的Chloe Ting
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://heho.com.tw/archives/59008" target="_blank"
                                    class="boxcolor2">哈佛醫師!推薦的4個運動
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                <div>
                    <a href="../html/sp_introduce.php<?php echo $url; ?>" class="text-right font-weight-light">
                        <p class=""> 觀看更多文章...</p>
                    </a>
                </div>
            </div>
        </div>


        <div class="container mt-4" data-aos="fade-right">
            <div class="boxsp">
                <h3 class="boxcolor2">健身地圖</h3>
                <hr>
                <div class=" row ">
                    <table border="2px" class='gym_table col m-3'>
                        <tr>
                            <th class='gymTitle' colspan="2">Anytime Fitness 台中公益店</th>
                        </tr>
                        <tr>
                            <td colspan="2"><img class="gympic"
                                    src='https://lh5.googleusercontent.com/p/AF1QipNH3rmkgnaBQ55rdZHW8HXb01sNpcnNmd4Wqan8=w408-h272-k-no'>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:100px;">地址：</td>
                            <td class='gymaddr'>台中市南屯區公益路二段51號B1</td>
                        </tr>
                        <tr>
                            <td>電話：</td>
                            <td class='gymtel'>04-2327-0866</td>
                        </tr>
                        <tr>
                            <td>營業時間</td>
                            <td class='gymopen'>00:00-24:00</td>
                        </tr>
                        <tr>
                            <td>介紹：</td>

                            <td class='gymintr' style='text-align: left'>Anytime
                                Fitness——目前在全世界已經擁有超過5,000間分店，台中首家24小時健身中心，我們打造出輕鬆自在、沒有壓力的運動環境，歡迎所有人來運動。</td>
                        </tr>
                    </table>
                    <div id="mapid" class="col m-3"></div>
                </div>
                <div class="">
                    <a href="../html/gym_map.php<?php echo $url; ?>" class="text-right font-weight-light">
                        <p class=""> 解鎖更多健身房...</p>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="container mt-4" data-aos="fade-right">
            <div class="boxsp">
                <h3 class="boxcolor2">健身小物</h3>
                <hr>
                <div class=" row">
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/gym/bottle01.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">我不是胖虎冰壩杯(特別版)</h5>
                                    <p class="">氣萌團子</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/gym/foamroller00.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">植纖瑜珈運動滾筒</h5>
                                    <p class="">舒緩肌肉的好夥伴</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="../img/gym/resistanceband00.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">環狀延展彈力帶</h5>
                                    <p class="">一條帶子 練遍全身</p>
                                </figcaption>
                            </figure>
                        </a>

                    </div>
                </div>

                <div class="">
                    <a href="../html/goods_index.php<?php echo $url; ?>" class="text-right font-weight-light">
                        <p class=""> 更多健身小物...</p>
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
<script src="../_js/sp_idx.js"></script>

</html>