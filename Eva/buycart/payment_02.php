<?php
include('./mysqli.php');
//確認是否為會員
if (isset($_REQUEST['mid'])) {
  //得到會員帳號與密碼進行驗證
  $mid = $_REQUEST['mid'];
  $psw = $_REQUEST['password'];
  //得到付款方式與寄件方式
  $pay = $_REQUEST['payment'];
  $del = $_REQUEST['deliver'];

  //帶入會員資料
  $sql_member = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
  $result = $mysqli->query($sql_member);
  $data = $result->fetch_array();
  $email = $data['email'];
  $name = $data['name'];
  $tel = $data['tel'];
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
  <title>(2)送貨資訊-購物車</title>

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
          <button class="btn btn-cart" data-toggle="dropdown">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
          </button>
        </div>
      </div>
    </nav>
  </div>
  <!--  進度條  -->
  <section class="container progress-size">
    <div class="progress-container">
      <!-- 進度條本體 -->
      <div class="progress" id="progress" style="width: 50%;"></div>
      <!-- 進度條的圈圈（Steps） -->
      <div class="circle active">1</div>
      <div class="circle active">2</div>
      <div class="circle">3</div>
    </div>
  </section>
  <form method="post" action="http://localhost:3000/Eva/buycart/payment_03.php?mid=<?php echo $mid; ?>&password=<?php echo $psw; ?>" class="p-3 mb-5 container form-box box-shadow">
    <div class="row">
      <!-- 購買資訊 -->
      <!-- 隱藏欄位 -->
      <input name='del_method' value="<?php echo $del; ?>" style="display:none" />
      <input name='pay_method' value="<?php echo $pay; ?>" style="display:none" />
      <section class="col-sm-5 col-md-6">
        <p class="h5 section-header">
          1. <span>購買人資料</span>
        </p>
        <div class="order-form-content">
          <div name="guest-info-form">
            <div class="form-group">
              <label for="order-customer-name" class="control-label">購買人<span class='notice'>*必填</span></label>
              <input id="order-customer-name" type="text" class="form-control" name="customer_name" value="<?php echo $name; ?>" required="">
            </div>
            <div class="form-group">
              <label for="order-customer-email" class="control-label">購買人信箱<span class='notice'>*必填</span></label>
              <input id="order-customer-email" type="text" class="form-control" name="customer_email" value="<?php echo $email; ?>" required="">
              <div class="vaild_div ">
              </div>
            </div>
            <div class="form-group">
              <label for="order-customer-phone" class="control-label">購買人電話<span class='notice'>*必填</span></label>
              <input id="order-customer-phone" type="tel" name="customer_tel" required value="<?php echo $tel; ?>" auto-padding-to-flag="true" class="form-control">
              <div class="vaild_div ">
              </div>
            </div>
          </div>
        </div>
        <!-- 訂單備註 -->
        <section class="">
          <p class="h5 section-header">
            2. <span>訂單備註</span>
          </p>
          <div class="order-form-content">
            <div name="remarksForm" class="">
              <div class="form-group">
                <textarea id="order-remarks" class="form-control" name="order_memo" placeholder="有注意事項想告訴我們嗎？" rows="3"></textarea>
              </div>
            </div>
          </div>
        </section>
      </section>
      <!-- 送貨地址 -->
      <section class="col-sm-7 col-md-6">
        <p class="h5 section-header">
          3. <span>送件地址</span>
        </p>
        <div class=" order-form-content">
          <div class="form-row">
            <div class=" col-md-12 mb-3">
              <label for="validationServer01"> 收件人<span class='notice'>*必填</span></label>
              <input id='deliver-customer-name' name='del_name' type="text" class="form-control vaild_input " placeholder="ex: 蔡小華小姐" value="" required>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationServer02">收件人手機<span class='notice'>*必填</span></label>
              <input id='deliver-customer-phone' name='del_tel' type="text" class="form-control vaild_input " placeholder="09xxxxxxxx" required>
              <div class="vaild_div">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationServer03">收件人地址<span class='notice'>*必填</span></label>
              <input id='deliver-customer-addr' name='del_addr' type="text" class="form-control  vaild_input" placeholder="請輸入地址" required>
              <div class="vaild_div">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input id='ischecked' class="form-check-input is-invalid" type="checkbox" value="" required name='isAgree'>
              <label class="form-check-label" for="invalidCheck3">
                我已閱讀並同意相關服務規則
              </label>
              <div class="">
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 justify-content">
          
          <a class="mr-4" style="color:white" href="http://localhost:3000/Eva/buycart/payment_01.php?mid=
          <?php echo $mid; ?>&password=<?php echo $psw; ?>">
            <input type="button" class="m-1 btn button10" value="回上一頁"></input>
          </a>
          <input type="submit" class="m-1 btn button09" value="確認繳交"></input>
        </div>
        <div id='goodsList'>
        </div>
      </section>
    </div>
  </form>


  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../js/cart-02.js"></script>



</body>

</html>