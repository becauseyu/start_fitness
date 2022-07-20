<?php
include('./mysqli.php');

$goods = $_REQUEST['pid'];
if (isset($goods)) {
  //取得商品資訊
  $sql = "SELECT * FROM goodsdetail INNER JOIN branddetail on goodsdetail.bid = branddetail.bid WHERE pid = '$goods'";
  $result = $mysqli->query($sql);
  $row = $result->fetch_object();
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
  <div class="text-border mb-5 mt-4 py-2 container">
    <div class="row pt-3">

      <!--  小圖列 -->
      
      <div class="small-border col-lg-2 col-sm-3 col-3 ">
        <div class="sm-box center">
          <?php
          $sql_flavor = "SELECT * FROM goodsdetail WHERE pname ='{$row->pname}'";
          $result_flavor = $mysqli->query($sql_flavor);
          while ($flavor = $result_flavor->fetch_object()) {
            echo   '<div class="smallImage mb-3">';
            echo   '<img data-name='.$flavor->pstyle.' data-price='.$flavor->pprice.' src="../asset/saleitem/' . $flavor->ptype . "/" . $flavor->ppic . '" class="smallImage01 img-fluid ">';
            echo '</div>';
          }

          ?>


        </div>
      </div>
      <!--  大圖列 -->
      <div class="center col-lg-5 col-sm-9 col-9">
        <div>
          <img src="../asset/saleitem/<?php echo $row->ptype; ?>/<?php echo $row->ppic; ?>" id="bigImage" class="bigImage01 img-fluid">
        </div>
      </div>
      <!--  文字敘述 -->
      <div class=" col-lg-5 col-sm-12 col-12 pl-5 ">
        <div class="pt-3">
          <h2 id='product_name' class="head-font"><?php echo $row->pname; ?> </h2>
          <p id='product_brand' class="head-font01 "><?php echo $row->bname; ?></p>
          <hr class="header-hr" />

        </div>
        <div>
          <h4 class="mb-3">NT$<span id='product_price' class='pprice'><?php echo $row->pprice; ?></span></h4>
          <h5 class="mt-1">口味 | <span id='product_flaver' class="flaver"><?php echo $row->pstyle; ?></span></h5>
          <div class="d-flex item-box">
            <?php
            $sql_flavor = "SELECT * FROM goodsdetail WHERE pname ='{$row->pname}'";
            $result_flavor = $mysqli->query($sql_flavor);
            while ($flavor = $result_flavor->fetch_object()) {
              if ($flavor->pstyle != '放圖用') {
                echo "<button data-price={$flavor->pprice} data-type={$flavor->ptype} data-pic={$flavor->ppic} class='item-icon m-1 '>{$flavor->pstyle}</button>";
              }
            }


            ?>


          </div>
          <div class="mt-4">
            <h5>數量</h5>
            <div class="input-group plus-minus-input qty-cen">
              <div class="input-group-button">
                <button type="button" class="btn btn-number minus" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
              <input id='product_count' class="input-group-field input-width qty" type="text" name="quantity" value="0">
              <div class="input-group-button">
                <button type="button" class="btn btn-number plus" data-quantity="plus" data-field="quantity">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 mb-3">
            <button class="btn button08" >加入購物車</button>
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
      <a href="/Maria/html/mb_login.php"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


    </div>
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