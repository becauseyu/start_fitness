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

   
}else{
    $user = '訪客';
    $url = '';
    header("Location:./mb_login.php");
    $memberPage = "./mb_login.php";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>購物車 | 動吃動吃</title>

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
  <link rel="stylesheet" href="../_css/payment.css">
  <!-- 插入favicon -->
  <link rel="icon" href="../img/favico.ico" type="image/x-icon">



</head>

<body>
<div class="headerpage">
        <nav class="fixed-top  navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;"
                    src="../img/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7"
                aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-2 col-sm-2 ">　</div>
                <ul class="navbar-nav  nav-justif justify-content-around col-8 col-sm-8  " style="align-items: end;">
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link " href="./sp_introduce.php<?php echo $url ;?>">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url ;?>">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./gym_map.php<?php echo $url ;?>">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="./openindex.php<?php echo $url ;?>"><img width="60" height="60"
                            style="display:block; margin:auto;" src="../img/LOGO.png"></a>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./fd_introduce.php<?php echo $url ;?>">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url ;?>">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-2 col-sm-2 d-flex justify-content-end ">
                    <a href="<?php echo $memberPage; ?>">
                        <button type="button" class="btn ">
                            <i class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user ;?></span> </i>
                        </button>
                    </a>

                    <a href="#" >
                        <button type="button" class="btn btn-cart">
                            <i class="fa fa-shopping-cart navbar_fa" aria-hidden="true"></i>
                            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                        </button>
                    </a>
                    <a id='userlogout'style="color:black" href="./mb_logout.php">
                    <button type="button" class="btn" title="登出">
                        <i class="fa fa-sign-out navbar_fa" aria-hidden="true"></i>
                    </button>
                    </a>

                </div>
            </div>
        </nav>

    </div>
  <!--  進度條  -->
  <section class="container  progress-size">
    <div class="">
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
  <section class="container shopping-cart" style="margin-top:20px ;">
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

  <form method="post" action="./payment_02.php?mid=<?php echo $mid;?>&password=<?php echo $psw;?>" class="container ">
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
          <input type="submit" class="mt-3 btn button09" value="前往結帳" onclick="totalStorage()" ></input>
        </div>

      </section>
    </div>
  </form>>



  <!-- 頁尾 -->
  <div class='footerpage'>
  </div>

  <!-- script 放body尾 -->
  <script src="../_js/payment_01.js"></script>
  <!-- script 主要 -->
  <script src="../_js/main.js"></script>



</body>

</html>