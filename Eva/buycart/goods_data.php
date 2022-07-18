<?php
include('.mysqli.php');

$goods = $_REQUEST['pid'];
if (isset($goods)) {
  //取得商品資訊
  $sql = "SELECT * FROM goodsdetail WHERE pid = '$goods'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_array();
  $id = $row['bid'];
  $sql2 = "SELECT bname FROM branddetail WHERE bid = '{$id}' ";
  $result2 = $mysqli->query($sql2);
  $row1 = $result2->fetch_array();
} else {
  header("Location:goods_index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>saleDetail</title>
  <!--    Stylesheets-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <!-- My.css -->
  <link rel="stylesheet" href="../css/goods_data.css">
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
  <div class="mb-5 mt-3 container">
    <div class="row pt-3">

      <!--  小圖列 -->
      <div class="b1 col-lg-2 col-sm-3 col-3 ">
        <div class="sm-box">
          <div class="smallImage">
            <img src="../asset/saleitem/item/01.webp" class="smallImage01 img-fluid spicy">
          </div>
          <div class="image-top smallImage ">
            <img src="../asset/saleitem/item/02.webp" class="smallImage01 img-fluid ">
          </div>
          <div class="image-top smallImage">
            <img src="../asset/saleitem/item/03.webp" class="smallImage01 img-fluid salt">
          </div>
          <div class="image-top smallImage">
            <img src="../asset/saleitem/item/04.webp" class="smallImage01 img-fluid black">
          </div>
          <div class="image-top smallImage">
            <img src="../asset/saleitem/item/05.webp" class="smallImage01 img-fluid mocha">
          </div>

        </div>
      </div>
      <!--  大圖列 -->
      <div class="col-lg-5 col-sm-9 col-9 bigImage">
        <div>
          <img src="../asset/saleitem/food/<?php echo $row['ppic']; ?>" id="bigImage" class="bigImage01 img-fluid">
        </div>
      </div>
      <!--  文字敘述 -->
      <div class="col-lg-5 col-sm-12 col-12">
        <div class="pt-3">
          <h2 class="head-font"><?php echo $row['pname']; ?> </h2>
          <p class="head-font01 "><?php echo $row1['bname']; ?></p>
          <hr class="header-hr" />

        </div>
        <div>
          <h4 class="mb-3">NT$198</h4>
          <h5>口味 | 一盒12入:&ensp;<span class="flaver">麻辣</span></h5>
          <div class="d-flex item-box">
            <button class="item-icon spicy">麻辣</button>
            <button class="item-icon salt">椒鹽</button>
            <button class="item-icon black">黑糖</button>
            <button class="item-icon mocha">抹茶</button>
          </div>
          <div class="mt-4">
            <h5>數量</h5>
            <div class="input-group plus-minus-input qty-cen">
              <div class="input-group-button">
                <button type="button" class="btn btn-number" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
              <input class="input-group-field input-width qty" type="text" name="quantity" value="0">
              <div class="input-group-button">
                <button type="button" class="btn btn-number plus" data-quantity="plus" data-field="quantity">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 mb-3">
            <a class="btn button01" href="#">加入購物車</a>
          </div>
        </div>
      </div>
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
      <a href="#"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


    </div>

    <!-- 頁尾 -->
    <div class='footerpage'>
    </div>

    <script>
      $('.footerpage').load('/MengYing/大專/LAB/footer.html')
    </script>

    <script script src="../js/goods_data.js"></script>
    <!-- script 主要 -->
    <script src="../js/main.js"></script>


</html>