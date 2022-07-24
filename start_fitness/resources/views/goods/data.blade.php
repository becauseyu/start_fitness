<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$text->title}}</title>
  


  @include('front_side_frame.link')
  <!-- My.css -->
  <link rel="stylesheet" href="/css/goods_data.css">
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
  <div class="text-border mb-5 mt-4 py-2 container">
    <div class="row pt-3">

      <!--  小圖列 -->
      
      <div class="small-border col-lg-2 col-sm-3 col-3 ">
        <div class="sm-box center">
          @foreach ($flavorList as $flavor)
          
            <div class="smallImage mb-3">
            <img data-name='{{$flavor->pstyle}}' data-price='{{$flavor->pprice}}' src="/image/asset/saleitem/{{$flavor->ptype}}/{{$flavor->ppic}}" class="smallImage01 img-fluid">
            </div>
          @endforeach
          


        </div>
      </div>
      <!--  大圖列 -->
      <div class="center col-lg-5 col-sm-9 col-9">
        <div>
          <img src="/image/asset/saleitem/{{$good->ptype}}/{{$good->ppic}}" id="bigImage" class="bigImage01 img-fluid">
        </div>
      </div>
      <!--  文字敘述 -->
      <div class=" col-lg-5 col-sm-12 col-12 pl-5 ">
        <div class="pt-3">
          <h2 id='product_name' class="head-font">{{$good->pname}}</h2>
          <p id='product_brand' class="head-font01 ">{{$good->branddetail->bname}}</p>
          <hr class="header-hr" />

        </div>
        <div>
          <h4 class="mb-3">NT$<span id='product_price' class='pprice'>{{$good->pprice}}</span></h4>
          <h5 class="mt-1">口味 | <span id='product_flaver' class="flaver">{{$good->pstyle}}</span></h5>
          <div class="d-flex item-box">
            

            @foreach ($flavorList as $flavor)


            @if ($flavor->pstyle != '放圖用')
            <button data-price={{$flavor->pprice}} data-type={{$flavor->ptype}} data-pic={{$flavor->ppic}} class='item-icon m-1 '>{{$flavor->pstyle}}</button>
            @endif


    
            @endforeach
              


          </div>
          <div class="mt-4">
            <h5>數量</h5>
            <div class="input-group plus-minus-input qty-cen">
              <div class="input-group-button">
                <button type="button" class="btn btn-number minus" data-quantity="minus" data-field="quantity">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
              <input id='product_count' class="input-group-field input-width qty" type="text" name="quantity" value="0">
              <div class="input-group-button">
                <button type="button" class="btn btn-number plus" data-quantity="plus" data-field="quantity">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 mb-3">
            <button class="btn button08" >加入購物車</button>
          </div>
        </div>
      </div>
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

  

  <script script src="/js/goods_data.js"></script>
  <!-- script 主要 -->
  <script src="/js/main.js"></script>


</html>