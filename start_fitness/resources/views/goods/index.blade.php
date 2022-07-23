<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$text->title}}</title>
 

  
  @include('front_side_frame.link')
  
  <!-- My.css -->
  <link rel="stylesheet" href="/css/goods_index.css">
  <!-- main.css -->
  <link rel="stylesheet" href="/css/main.css">

  <!-- icon -->
  <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>


</head>

<body class="" style="overflow-x:hidden">
  <!-- 頁首  -->
  <div class='headerpage'>
    @include('front_side_frame.header')
  </div>

  <!--  carousel-item -->
  <div class="mt-3 fadeinimg">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <div class="dd carousel-inner  ">
        <div class="carousel-item active">
          <img src="/image/asset/saleitem/carousal/02.webp" class="placeholder-img img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="/image/asset/saleitem/carousal/04.webp" class="placeholder-img  img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="/image/asset/saleitem/carousal/002.jpg" class="placeholder-img  img-fluid" role="img">
        </div>

      </div>
    </div>

  </div>

  <div class="mb-5 container ">
    <div class="row">
      <!--  飲食 -->
      <section class="mt-3 p-3 food-box col-md-12 " id="foodsell">
        <div class="mt-3 mb-4 food-title d-flex">
          <img src="/image/asset/saleitem/FOOD.png" class="icon-box" />
          <img src="/image/asset/saleitem/foodname.png" class="ml-2 icon-name" />
        </div>
        <div class="center-box mt-3 mb-3">
          <div class="row">
            <!--  每個食品 -->
            @foreach ($foodList as $food)
            
                <div class='col-md-3 col-sm-6 col-6'>
                <div class='m-2 image-sale'>
                <a  href='/Eva/buycart/goods_data.php?pid={{$food->pid}}'>
                <img src='/image/asset/saleitem/food/{{$food->ppic}}' class='good_img food photoshadow imgee img-fluid mx-auto rounded'>
                </a>
                </div>
                <div class=' '>
                <div class='cen-brand head-font01'>
                <div>{{$food->branddetail->bname}}</div>
                </div>
                <p class='head-font'>{{$food->pname}}-{{$food->pstyle}}</p>
                <p class='price-font'>NT$<span id='single_price'>{{$food->pprice}}</span><i class='mx-2 fa-solid fa-cart-shopping'></i></p>
                </div>
                </div>
  
            @endforeach
        
          </div>
      </section>


      <!--  健身器材 -->
      <section class="mt-5 p-3 SP-box col-md-12" id="gymsell">
        <div class="mt-3 mb-4 SP-title d-flex">
          <img src="/image/asset/saleitem/SP.png" class="icon-box" />
          <img src="/image/asset/saleitem/SPtitle-01.png" class="mr-4 icon-name" />
          <!-- <h2 class="header-font">&ensp;動起來啊!</h2> -->
        </div>

        <div class="center-box mt-3 mb-3">
          <div class="row">
            <!--  每一項 -->
            
            @foreach ($gymList as $gym)
            
                <div class='col-md-3 col-sm-6 col-6'>
                <div class='m-2 image-sale'>
                <a  href='/Eva/buycart/goods_data.php?pid={{$gym->pid}}'>
                <img src='/image/asset/saleitem/gym/{{$gym->ppic}}' class='good_img gym photoshadow imgee img-fluid mx-auto rounded'>
                </a>
                </div>
                <div class=' '>
                <div class='cen-brand head-font01'>
                <div>{{$gym->branddetail->bname}}</div>
                </div>
                <p class='head-font'>{{$gym->pname}}-{{$gym->pstyle}}</p>
                <p class='price-font'>NT$<span id='single_price'>{{$gym->pprice}}</span><i class='mx-2 fa-solid fa-cart-shopping'></i></p>
                </div>
                </div>
  
            @endforeach
          </div>

        </div>

      </section>
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
    @include('front_side_frame.footer')
  </div>

  <!-- script 放body尾 -->
  <script src="/js/goods_index.js"></script>
  <!-- script 主要 -->
  <script src="/js/main.js"></script>

</body>

</html>