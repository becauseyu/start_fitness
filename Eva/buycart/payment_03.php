<?php
include('/start_fitness/Maria/php/mysqli.php');
if (isset($_REQUEST['mid'])) {
  //確認是否為會員
  $mid = $_REQUEST['mid'];
  $psw = $_REQUEST['password'];
  $sql_member = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
  $result = $mysqli->query($sql_member);
  $count = $result->num_rows;
  //確認會員帳號密碼正確
  if ($count > 0) {
    $del_name = $_REQUEST['del_name'];
    $del_tel = $_REQUEST['del_tel'];
    $del_addr = $_REQUEST['del_addr'];
    $memo = $_REQUEST['order_memo'];
    $del_method = $_REQUEST['del_method'];
    $pay_method = $_REQUEST['pay_method'];

    //確認付款與寄送的代號
    $sql_pay= "SELECT paid FROM payment WHERE payment ='{$pay_method}'";
    $result = $mysqli->query($sql_pay);
    $row = $result->fetch_array();
    $pay_method = $row['paid'];
    $sql_del= "SELECT did FROM deliver WHERE deliver ='{$del_method}'";
    $result = $mysqli->query($sql_del);
    $row = $result->fetch_array();
    $deliver_method = $row['did'];

    //寫入資料庫



  } else {
    header("Location:/Maria/html/mb_login.php");
  }
} else {
  header("Location:/Maria/html/mb_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>(3)已送出-購物車</title>

  <!--    Stylesheets-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>

  <!-- My.css -->
  <link rel="stylesheet" href="../css/buycart.css">

  <!-- icon -->
  <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>

  <!-- 插入頁首css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="/MengYing/大專/_css/head.css" rel="stylesheet">
</head>

<body>
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
          <button class="btn btn-cart" data-toggle="dropdown" >
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
          </button>
        </div>
      </div>
    </nav>
  </div>
  <!--  進度條  -->
  <section class="container progress-size">
    <div class="">
      <div class="progress-container">
        <!-- 進度條本體 -->
        <div class="progress" id="progress" style="width: 100%;"></div>
        <!-- 進度條的圈圈（Steps） -->
        <div class="circle active">1</div>
        <div class="circle active">2</div>
        <div class="circle active">3</div>
      </div>
    </div>
  </section>

  <div class="p-4 mb-5 container">
    <!-- 成功訂貨 -->
    <section class="center-box pt-1 row">
      <div class="col-9">
        <div class="order-form-content1">
          <div class="section-header1"></div>
          <div class="checkicon">
            <i class="fa-solid fa-circle-check checkiocn1"></i>
            <p class="check-text">
              您的訂單已成功送出
            </p>
          </div>
          <div class="text-size">
            訂單編號: 202207020088
          </div>
          <div class="text-size1">
            <p>請妥善保管此編號，如需取消或更改訂單，請您撥打客服或是線上詢問</p>
          </div>

        </div>


      </div>



    </section>
  </div>


  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../js/cart-01.js"></script>


</body>

</html>