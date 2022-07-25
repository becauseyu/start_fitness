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
  <title>產品詳情 | 動吃動吃</title>
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
  <link rel="stylesheet" href="../_css/goods_data.css">
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
               <i  id="user_icon" class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user; ?></span> </i>
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
  <div class="text-border mb-5 py-2 container " style="margin-top: 100px;">
    <div class="row pt-3">

      <!--  小圖列 -->
      
      <div class="small-border col-lg-2 col-sm-3 col-3 ">
        <div class="sm-box center">
          <?php
          $sql_flavor = "SELECT * FROM goodsdetail WHERE pname ='{$row->pname}'";
          $result_flavor = $mysqli->query($sql_flavor);
          while ($flavor = $result_flavor->fetch_object()) {
            echo   '<div class="smallImage mb-3">';
            echo   '<img data-name='.$flavor->pstyle.' data-price='.$flavor->pprice.' src="../img/'. $flavor->ptype . "/" . $flavor->ppic . '" class="smallImage01 img-fluid ">';
            echo '</div>';
          }

          ?>


        </div>
      </div>
      <!--  大圖列 -->
      <div class="center col-lg-5 col-sm-9 col-9">
        <div>
          <img src="../img/<?php echo $row->ptype; ?>/<?php echo $row->ppic; ?>" id="bigImage" class="bigImage01 img-fluid">
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
          <h5 class="mt-1">
            <?php  
            $style = $row->ptype;
            if($style == 'food'){
              echo '口味|';
            }
            else{
              echo '種類|';

            } ?>
          <span id='product_flaver' class="flaver"><?php echo $row->pstyle; ?></span></h5>
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
      <a href="./payment_01.php<?php echo $url; ?>"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


    </div>
  </div>
  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 主要 -->
  <script src="../_js/main.js"></script>
  <script src="../_js/goods_data.js"></script>





</html>