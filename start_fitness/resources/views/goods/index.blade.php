<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>推薦好物 |動吃動吃</title>
 

  
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
          <img src="/image/carousal/02.webp" class="placeholder-img img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="/image/carousal/04.webp" class="placeholder-img  img-fluid" role="img">
        </div>
        <div class="carousel-item">
          <img src="/image/carousal/002.jpg" class="placeholder-img  img-fluid" role="img">
        </div>

      </div>
    </div>

  </div>

  <div class="mb-5 container ">
    <div class="row">
      <!--  飲食 -->
      <section class="mt-3 p-3 food-box col-md-12 " id="foodsell">
        <div class="mt-3 mb-4 food-title d-flex">
          <img src="/image/FOOD.png" class="icon-box" />
          <img src="/image/foodname.png" class="ml-2 icon-name" />
        </div>
        <div class="center-box mt-3 mb-3">
          <div class="row">
            <!--  每個食品 -->
            @foreach ($foodList as $food)
            
                <div class='col-md-3 col-sm-6 col-6'>
                <div class='m-2 image-sale'>
                <a  href='/goods/data/{{$food->pid}}'>
                <img src='/image/food/{{$food->ppic}}' class='good_img food photoshadow imgee img-fluid mx-auto rounded'>
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
          <img src="/image/SP.png" class="icon-box" />
          <img src="/image/SPtitle-01.png" class="mr-4 icon-name" />
          <!-- <h2 class="header-font">&ensp;動起來啊!</h2> -->
        </div>

        <div class="center-box mt-3 mb-3">
          <div class="row">
            <!--  每一項 -->
            
            @foreach ($gymList as $gym)
            
                <div class='col-md-3 col-sm-6 col-6'>
                <div class='m-2 image-sale'>
                <a  href='/goods/data/{{$gym->pid}}'>
                <img src='/image/gym/{{$gym->ppic}}' class='good_img gym photoshadow imgee img-fluid mx-auto rounded'>
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

  <!-- 購物車標誌 -->
  <div id="slide_buycart">
    @include('front_side_frame.buyCartIcon')

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