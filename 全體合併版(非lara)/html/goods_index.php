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
  $url = "?mid={$mid}&psw={$psw}&";
  $memberPage = "./mb_update.php?mid={$mid}}&psw={$psw}";
} else {
  $user = '訪客';
  $url = "?";
  $memberPage = "./mb_login.php";
}

//從資料庫取出產品放到畫面
include('./mysqli.php');

$sql_f = "SELECT * FROM goodsdetail WHERE ptype = 'food' AND ppic LIKE '%00%' ";
$resultFood = $mysqli->query($sql_f);

$sql_g = "SELECT * FROM goodsdetail WHERE ptype = 'gym' AND ppic LIKE '%00%'";
$resultGym = $mysqli->query($sql_g);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>產品推薦 | 動吃動吃</title>

  <!--加入jquery-->
  <script src="../_js/jquery/jquery.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <!--加入bootstrap-->
  <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
  <script src="../_js/bootstrap/bootstrap.js"></script>
  <!--加入Font Awesome-->
  <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
  <!-- 插入自己的css -->
  <link rel="stylesheet" href="../_css/main.css">
  <link rel="stylesheet" href="../_css/goods_index.css">
  <!-- 插入favicon -->
  <link rel="icon" href="../img/favico.ico" type="image/x-icon">


</head>

<body class="" style="overflow-x:hidden">
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

          <a href="#" onclick="openbuycar()">
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
  <!--  carousel-item -->
  <div class="fadeinimg carousel_div" style="margin-top:100px ;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <div class="dd carousel-inner  ">
        <div class="carousel-item active">
          <img src="../img/carousal/002.jpg" class="placeholder-img img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="../img/carousal/04.webp" class="placeholder-img  img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="../img/carousal/002.jpg" class="placeholder-img  img-fluid" role="img">
        </div>

      </div>
    </div>

  </div>

  <div class="mb-5 container ">
    <div class="row">
      <!--  飲食 -->
      <section class="mt-3 p-3 food-box col-md-12 " id="foodsell">
        <div class="mt-3 mb-4 food-title d-flex">
          <img src="../img/FOOD.png" class="icon-box" />
          <img src="../img/foodname.png" class="ml-2 icon-name" />
        </div>
        <div class="center-box mt-3">
          <div class="row">
            <!--  每個食品 -->
            <?php
            while ($good = $resultFood->fetch_object()) {
              echo   "<div class='col-md-3 col-sm-6 col-6'>";
              echo   "<div class='m-2 image-sale'>";
              echo   "<a  href='./goods_data.php{$url}pid={$good->pid}'>";
              echo   "<img src='../img/food/{$good->ppic}' class='good_img food photoshadow imgee img-fluid mx-auto rounded'>";
              echo   "</a>";
              echo   "</div>";
              echo   "<div class=' '>";
              echo   "<div class='cen-brand head-font01'>";
              $sql = "SELECT bname FROM branddetail WHERE bid = '{$good->bid}' ";
              $result = $mysqli->query($sql);
              $row = $result->fetch_array();
              echo   "<div>{$row['bname']}</div>";
              echo   "</div>";
              echo   "<p class='head-font'>{$good->pname}－{$good->pstyle}</p>";
              echo   "<p class='price-font'>NT$<span id='single_price'>{$good->pprice}</span><i class='mx-2 fa-solid fa-cart-shopping'></i></p>";
              echo   "</div>";
              echo   "</div>";
            }
            ?>
          </div>
      </section>


      <!--  健身器材 -->
      <section class="mt-5 p-3 SP-box col-md-12" id="gymsell">
        <div class="mt-3 mb-4 SP-title d-flex">
          <img src="../img/SP.png" class="icon-box" />
          <img src="../img/SPtitle-01.png" class="mr-4 icon-name" />
          <!-- <h2 class="header-font">&ensp;動起來啊!</h2> -->
        </div>

        <div class="center-box mt-3">
          <div class="row">
            <!--  每一項 -->
            <?php
            while ($good = $resultGym->fetch_object()) {
              echo   "<div class='col-md-3 col-sm-6 col-6'>";
              echo   "<div class='m-2 image-sale'>";
              echo   "<a  href='./goods_data.php?pid={$good->pid}'>";
              echo   "<img src='../img/gym/{$good->ppic}' class='good_img food photoshadow imgee img-fluid mx-auto rounded'>";
              echo   "</a>";
              echo   "</div>";
              echo   "<div class=' '>";
              echo   "<div class='cen-brand head-font01'>";
              $sql = "SELECT bname FROM branddetail WHERE bid = '{$good->bid}' ";
              $result = $mysqli->query($sql);
              $row = $result->fetch_array();
              echo   "<div>{$row['bname']}</div>";
              echo   "</div>";
              echo   "<p class='head-font'>{$good->pname}－{$good->pstyle}</p>";
              echo   "<p class='price-font'>NT$<span id='single_price'>{$good->pprice}</span><i class='mx-2 fa-solid fa-cart-shopping'></i></p>";
              echo   "</div>";
              echo   "</div>";
            }
            ?>
          </div>

        </div>

      </section>
    </div>
  </div>

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
      <a href="./payment_01.php?<?php echo $url; ?>"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


    </div>

  </div>

  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../_js/goods_index.js"></script>
  <!-- script 主要 -->
  <script src="../_js/main.js"></script>

</body>

</html>