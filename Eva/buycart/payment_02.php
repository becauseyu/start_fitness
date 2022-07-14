<?php
include('/start_fitness/Maria/php/mysqli.php');
//得到會員帳號與密碼進行驗證
$acc = $_REQUEST['account'];
$psw = $_REQUEST['password'];
//得到付款方式與寄件方式
$pay = $_REQUEST['payment'];
$del = $_REQUEST['deliver'];

//帶入會員資料
$sql_member = "SELECT * FROM member WHERE account = '{$acc}' AND psw = '{$psw}'";
$result = $mysqli->query($sql_member);
$data = $result->fetch_array();
$email = $data['email'];
$name = $data['name'];
$tel = $data['tel'];


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
  <form method="post" action='./payment_03.php' class="p-3 mb-5 container form-box box-shadow">

    <div class="row">
      <!-- 購買資訊 -->
      <section class="col-sm-5 col-md-6">
        <p class="h5 section-header">
          1. <span>購買人資料</span>
        </p>
        <div class="order-form-content">
          <form name="guest-info-form">
            <div class="form-group">
              <label for="order-customer-name" class="control-label">購買人</label>
              <input id="order-customer-name" type="text" class="form-control" name="customer_name" value="<?php echo $name; ?>" required="">
            </div>
            <div class="form-group">
              <label for="order-customer-email" class="control-label">購買人信箱</label>
              <input id="order-customer-email" type="text" class="form-control" name="customer_email" value="<?php echo $email; ?>" required="">
            </div>

            <div class="form-group">
              <label for="order-customer-phone" class="control-label">購買人電話</label>
              <input id="order-customer-phone" type="tel" name="customer_tel" required value="<?php echo $tel; ?>" auto-padding-to-flag="true" class="form-control" ng-pattern="/^\+?[\(\)\-\#\.\s\d]{6,20}$/" ng-minlength="6" ng-maxlength="20">
            </div>
          </form>
        </div>

        <!-- 訂單備註 -->
        <section class="">
          <p class="h5 section-header">
            2. <span>訂單備註</span>
          </p>
          <div class="order-form-content">
            <form name="remarksForm" class="">
              <div class="form-group">
                <textarea id="order-remarks" class="form-control" name="order_memo" placeholder="有注意事項想告訴我們嗎？" rows="3"></textarea>
              </div>
            </form>
          </div>
        </section>
      </section>

      <!-- 送貨地址 -->
      <section class="col-sm-7 col-md-6">
        <p class="h5 section-header">
          3. <span>送件地址</span>
        </p>

        <div class=" order-form-content">
          <form action="">
            <div class="form-row">
              <div class=" col-md-12 mb-3">
                <label for="validationServer01"> 收件人</label>
                <input name='del_name' type="text" class="form-control " id="validationServer01" placeholder="ex: 蔡小華小姐" value="" required>
                <div class="">
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationServer02">收件人電話</label>
                <input name='del_tel' type="text" class="form-control " id="validationServer02" placeholder="09-xxxx-xxxx" required>
                <div class="">
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationServer03">收件人地址</label>
                <input name='del_addr' type="text" class="form-control " id="validationServer03" placeholder="請輸入地址" required>
                <div class="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required name='isAgree'>
                <label class="form-check-label" for="invalidCheck3">
                  我已閱讀並同意相關服務規則
                </label>
                <div class="">
                </div>
              </div>
            </div>


          </form>
        </div>
  </form>
  <div class="mt-3 row justify-content">
    <a href="http://localhost:3000/Eva/buycart/payment_01.php?account=<?php echo $acc; ?>&password=<?php echo $psw; ?>"><input type="button" class="col-6 btn button01" value="返回上一頁" ></input></a>
    <input type="submit" class="col-4 btn button01" value="確認繳交"></input>
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