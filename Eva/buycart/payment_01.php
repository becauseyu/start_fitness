<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>(1)購物車結帳-購物車</title>

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
    <div class="mt-4">
      <div class="progress-container">
        <!-- 進度條本體 -->
        <div class="progress" id="progress"></div>
        <!-- 進度條的圈圈（Steps） -->
        <div class="circle active">1</div>
        <div class="circle">2</div>
        <div class="circle">3</div>
      </div>
    </div>

  </section>

  <!--購物表格-->
  <section class="container mt-5 shopping-cart">
    <div class="table-01 " id="car">
      <div class=" table-header text-center  row">
        <div class="col-8 col-sm-4 col-md-4">商品資料</div>
        <div class="col-4 col-sm-2 col-md-2">單件價格</div>
        <div class="col-6 col-sm-3 col-md-3">數量</div>
        <div class="col-5 col-sm-2 col-md-2">小計</div>
        <div class="col-1 col-sm-1 col-md-1"></div>
      </div>
      <!--每一列-->
      <div id="car_content">
    </div>
  </section>

  <form method="post" action="./payment_02.php" class="container ">
    <div class="row">
      <!--左:付款方式-->
      <section class="col-sm-7 col-md-8">
        <p class="h5 section-header">
          選擇送貨及付款方式
        </p>
        <div class="order-form-content">
          <form name="cartForm">
            <div class="form-group">
              <label for="order-delivery-method" class="h5 pt-1">送貨方式</label>
              <select name="deliver" id="order-delivery-method" class="form-control">
                <option  value="新竹物流宅配" selected="">
                  新竹物流宅配</option>
              </select>
              <p class="pt-2">．如訂單量較大或是有缺貨狀況，寄出時間將有所延遲，敬請見諒<br>
                ．若收到商品外箱有明顯破損，可以拒收並錄影存留，當下也請聯絡我們，謝謝<br>
                ．一般狀況訂單將於下單後隔天寄出(不包含例假日)<br>
                ．寄出後２－３天會送達指定地點，【週末不配送】<br>
            </div>

            <div class="form-group pt-2">
              <label for="order-payment-method" class="h5">付款方式</label>
              <span class="select-cart-form">
                <select name="payment" id="order-payment-method" class="form-control">
                  <option value="貨到付款" ng-non-bindable="">貨到付款</option>
                    虛擬代碼繳費（需持代碼至實體ATM或網路銀行繳費）</option>
                </select>
              </span>
            </div>
          </form>
        </div>


      </section>
      <!--右:訂單資訊-->
      <section class="col-sm-5 col-md-4">
        <div class="h5 section-header">
          訂單資訊
        </div>
        <div class="order-form-content">
          <div>
            <div class="">
              <span class="">合計: &nbsp;NT$
                <span class="total02">0</span>
              </span>
            </div>

            <div class="pt-1">
              <span class="">
                運費:&nbsp;
              </span>
              <span class="fee">NT$60</span>
            </div>

            <div class="pt-1">
              <span class="font-red">
                *滿NT$2000免運費
              </span>
            </div>



            <hr class="">
            <p class="pull-left">訂單總金額
              (<span class="total_count"></span>件):&nbsp;NT$
              <span class="pull-right total03">0</span>
            </p>


          </div>
          <input type="submit" class="mt-3 btn button01" value="前往結帳" ></input>
        </div>

      </section>
    </div>
  </form>>



  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../js/cart-01.js"></script>



</body>

</html>