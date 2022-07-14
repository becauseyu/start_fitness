<?php

//從資料庫取出產品放到畫面
include('/start_fitness/Maria/php/mysqli.php');

$sql_f = "SELECT * FROM goodsdetail WHERE ptype = 'food'";
$resultFood = $mysqli->query($sql_f);

$sql_g = "SELECT * FROM goodsdetail WHERE ptype = 'gym'";
$resultGym = $mysqli->query($sql_g);


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>goods_index</title>
  <!--    Stylesheets-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <!-- My.css -->
  <link rel="stylesheet" href="../css/goods_index.css">
  <!-- main.css -->
  <link rel="stylesheet" href="../css/main.css">

  <!-- icon -->
  <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>

  <!-- 插入頁首css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="/MengYing/大專/_css/head.css" rel="stylesheet">
</head>

<body class="" style="overflow-x:hidden">
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

  <!--  carousel-item -->
  <div class="mt-1 fadeinimg">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <div class="dd carousel-inner  ">
        <div class="carousel-item active">
          <img src="../asset/saleitem/carousal/02.webp" class="placeholder-img img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="../asset/saleitem/carousal/04.webp" class="placeholder-img  img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="../asset/saleitem/carousal/002.jpg" class="placeholder-img  img-fluid" role="img">
        </div>

      </div>
    </div>

  </div>

  <div class="mb-5 container ">
    <div class="row">
      <!--  飲食 -->
      <section class="mt-3 p-3 food-box col-md-12 " id="foodsell">
        <div class="mt-3 mb-4 food-title d-flex">
          <img src="../asset/saleitem/FOOD.png" class="icon-box" />
          <img src="../asset/saleitem/foodname.png" class="ml-2 icon-name" />

          <!-- <h2 class="header-font">&ensp;吃的健康!</h2> -->
        </div>
        <div class="center-box mt-3">
          <div class=" row">
            <!--  每個食品 -->
            <?php
            while ($good = $resultFood->fetch_object()) {
              echo   "<div class='col-md-3 col-sm-6 col-6'>";
              echo   "<div class='m-2 image-sale'>";
              echo   "<a  href='/Eva/buycart/goods_data.php?pid={$good->pid}'>";
              echo   "<img src='../asset/saleitem/food/{$good->ppic}' class='food photoshadow imgee img-fluid mx-auto rounded'>";
              echo   "</a>";
              echo   "</div>";
              echo   "<div class=' '>";
              echo   "<div class='cen-brand head-font01'>";
              $sql = "SELECT bname FROM branddetail WHERE bid = '{$good->bid}' ";
              $result = $mysqli->query($sql);
              $row = $result->fetch_array();
              echo   "<div>{$row['bname']}</div>";
              echo   "</div>";
              echo   "<p class='head-font'>{$good->pname}<i class='mx-2 fa-solid fa-cart-shopping'></i></p>";
              echo   "<p class='price-font'>NT$<span id='single_price'>{$good->pprice}</span></p>";
              echo   "</div>";
              echo   "</div>";

            }
            ?>
          </div>
      </section>


      <!--  健身器材 -->
      <section class="mt-5 p-3 SP-box col-md-12" id="gymsell">
        <div class="mt-3 mb-4 SP-title d-flex">
          <img src="../asset/saleitem/SP.png" class="icon-box" />
          <img src="../asset/saleitem/SPtitle-01.png" class="mr-4 icon-name" />
          <!-- <h2 class="header-font">&ensp;動起來啊!</h2> -->
        </div>

        <div class="center-box mt-3">
          <div class="row">
            <!--  每一項 -->
            <?php
            while ($good = $resultGym->fetch_object()) {
              echo   "<div class='col-md-3 col-sm-6 col-6'>";
              echo   "<div class='m-2 image-sale'>";
              echo   "<a  href='/Eva/buycart/goods_data.php?pid={$good->pid}'>";
              echo   "<img src='../asset/saleitem/gym/{$good->ppic}' class='food photoshadow imgee img-fluid mx-auto rounded'>";
              echo   "</a>";
              echo   "</div>";
              echo   "<div class=' '>";
              echo   "<div class='cen-brand head-font01'>";
              $sql = "SELECT bname FROM branddetail WHERE bid = '{$good->bid}' ";
              $result = $mysqli->query($sql);
              $row = $result->fetch_array();
              echo   "<div>{$row['bname']}</div>";
              echo   "</div>";
              echo   "<p class='head-font'>{$good->pname}<i class='mx-2 fa-solid fa-cart-shopping'></i></p>";
              echo   "<p class='price-font'>NT$<span id='single_price'>{$good->pprice}</span></p>";
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
      <a href="/Maria/html/mb_login.php"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


    </div>

  </div>

  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../js/goods_index.js"></script>
  <!-- script 主要 -->
  <script src="../js/main.js"></script>

</body>

</html>