<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>付款與寄送詳情 |動吃動吃</title>

 

  @include('front_side_frame.link')
  <!-- My.css -->
  <link rel="stylesheet" href="/css/buycart.css">

 

</head>

<body>
  <!-- 頁首  -->
  <div class='headerpage'>
    @include('front_side_frame.header');
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
  <form method="post" action="/payment/page03" class="p-3 mb-5 container form-box box-shadow">
    @csrf
    <div class="row">
      <!-- 購買資訊 -->
      <!-- 隱藏欄位 -->
      <input name='del_method' value="{{$member->del}}" style="display:none" />
      <input name='pay_method' value="{{$member->pay}}" style="display:none" />
      <section class="col-sm-5 col-md-6">
        <p class="h5 section-header">
          1. <span>購買人資料</span>
        </p>
        <div class="order-form-content">
          <div name="guest-info-form">
            <div class="form-group">
              <label for="order-customer-name" class="control-label">購買人<span class='notice'>*必填</span></label>
              <input id="order-customer-name" type="text" class="form-control" name="customer_name" value="{{$member->name}}" required="">
            </div>
            <div class="form-group">
              <label for="order-customer-email" class="control-label">購買人信箱<span class='notice'>*必填</span></label>
              <input id="order-customer-email" type="text" class="form-control" name="customer_email" value="{{$member->email}}" required="">
              <div class="vaild_div ">
              </div>
            </div>
            <div class="form-group">
              <label for="order-customer-phone" class="control-label">購買人電話<span class='notice'>*必填</span></label>
              <input id="order-customer-phone" type="tel" name="customer_tel" required value="{{$member->tel}}" auto-padding-to-flag="true" class="form-control">
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
          
          <a class="mr-4" style="color:white" href="/payment/page01">
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
    @include('front_side_frame.footer');
  </div>

  <!-- script 放body尾 -->
  <script src="/js/cart-02.js"></script>



</body>

</html>