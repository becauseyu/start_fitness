<?php
include('./mysqli.php');
//設定時區
date_default_timezone_set('Asia/Taipei');

//得到網域名稱
$host = $_SERVER['HTTP_HOST'];

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
    $date = date('Y/m/d H:i:s'); //放入訂單的資訊
    $user = '';
    $url = "?mid={$mid}&psw={$psw}";
    $memberPage = "./mb_update.php?mid={$mid}&psw={$psw}";

    //確認付款與寄送的代號
    $sql_pay = "SELECT paid FROM payment WHERE payment ='{$pay_method}'";
    $result = $mysqli->query($sql_pay);
    $row = $result->fetch_array();
    $pay_method = $row['paid'];
    $sql_del = "SELECT did FROM deliver WHERE deliver ='{$del_method}'";
    $result = $mysqli->query($sql_del);
    $row = $result->fetch_array();
    $deliver_method = $row['did'];

    //寫入資料庫
    $sql_addOrder = "INSERT INTO memberorder(mid,orderdate,delAddr,delTel,delName,did,paid,memo) VALUES
     ('{$mid}','{$date}','{$del_addr}','{$del_tel}','{$del_name}','{$deliver_method}','{$pay_method}','{$memo}')";
    $mysqli->query($sql_addOrder);

    //得到訂單編號，準備傳入下一個狀態
    $sql_selectOrder = "SELECT oid FROM memberorder WHERE orderdate = '{$date}'";
    $result = $mysqli->query($sql_selectOrder);
    $row = $result->fetch_array();
    $id = $row['oid'];

    //放入介面的訂單編號
    $order_date = date('Y/m/d');
    //php的字串切割存入陣列
    $a = mb_split('/', "{$order_date}");
    $order_date = "$a[0]$a[1]$a[2]";
    if ($id <= 10) {
      $id = '00' . $id;
    } else if ($id <= 100) {
      $id = '0' . $id;
    }
  } else {
    $user = '訪客';
    $url = '';
    header("./mb_login.php");
  }
} else {
  header("./mb_login.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>訂購完成 | 動吃動吃</title>

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
  <!-- <link rel="stylesheet" href="../_css/main.css"> -->
  <link rel="stylesheet" href="../_css/payment.css">
  <!-- 插入favicon -->
  <link rel="icon" href="../img/favico.ico" type="image/x-icon">



</head>


<body>
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

          <a href="#">
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
  <!--  進度條  -->
  <section class="container progress-size" style="margin-top: 100px;">
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
            訂單編號: <?php echo "{$order_date}{$id}"; ?>
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



</body>
<!-- script 放body尾 -->
<script src="../_js/payment_01.js"></script>
<!-- script 主要 -->
<script src="../_js/main.js"></script>
<script>
  var myStorage = localStorage;
  var wantList = myStorage.getItem('wantList')
  wantList = wantList.split(',');

  var wantListData = []
  for (let i = 0; i < wantList.length; i++) {
    var data = myStorage.getItem(wantList[i])
    wantListData.push(data)

  }
  var total = myStorage.getItem('total')
  //透過ajax要求把localStorage的值送入資料庫建立檔案
  for (let j = 0; j < wantListData.length; j++) {
    let data = JSON.parse(wantListData[j]);
    let fullname = data.name;
    let name = (fullname.split('－'))[0];
    name = name.replace(' ', '+');
    let style = (fullname.split('－'))[1];
    style = style.replace(' ', '+');
    let count = data.count
    let oid = <?php echo $id; ?>;
    let xhttp = new XMLHttpRequest;
    // console.log('http://localhost:3000/Eva/buycart/addOrder.php?name='+name+"&style="+style+'&count='+count+'&oid='+oid+'&total='+total)
    xhttp.open('GET', 'http://<?php echo $host ?>/html/addOrder.php?name=' + name + "&style=" + style + '&count=' + count + '&oid=' + oid + '&total=' + total, true);
    // //send請求
    xhttp.send();
  }

  //訂單完成後，清除localStorage
  myStorage.clear();
  $('#cartQuantity').html(0)
</script>

</html>