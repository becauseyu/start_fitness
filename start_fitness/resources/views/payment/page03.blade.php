<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>完成訂單 |動吃動吃</title>

  
  @include('front_side_frame.link')
  <!-- My.css -->
  <link rel="stylesheet" href="/css/buycart.css">

  
</head>

<body>
  <!-- 頁首  -->
  <div class='headerpage'>
    @include('front_side_frame.header')
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
            訂單編號: <php echo "{$order_date}{$id}" ;?>
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
    @include('front_side_frame.link')
  </div>

  <!-- script 放body尾 -->
  <script src="/js/cart-01.js"></script>


</body>
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
        name = name.replace(' ','+');
        let style = (fullname.split('－'))[1];
        style = style.replace(' ','+');
        let count = data.count
        let oid = <php echo $id ;?>;
        let xhttp = new XMLHttpRequest;
        // console.log('http://localhost:3000/Eva/buycart/addOrder.php?name='+name+"&style="+style+'&count='+count+'&oid='+oid+'&total='+total)
        xhttp.open('GET', 'http://localhost:3000/Eva/buycart/addOrder.php?name='+name+"&style="+style+'&count='+count+'&oid='+oid+'&total='+total, true);
        // //send請求
        xhttp.send();
    }

  //訂單完成後，清除localStorage
  myStorage.clear();
  $('#cartQuantity').html(0)
</script>

</html>