<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <script src="/jQuery3.5.1/jquery.slim.js"></script>
    <script src="/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js"></script>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">

    {{-- my css --}}
    <link rel="stylesheet" href="/css/ld/backhead.css">

        {{--  favicon --}}
   <link rel="icon" href="/image/favico.ico" type="image/x-icon">


    @yield('head')

    @yield('title')

    @yield('style')

</head>

<body>
    <nav class="mb-5 fixed-top navbar navbar-expand-lg navbar-light nav-shadow " style="background-color: #daccbd;">
        <a class="navbar-brand d-lg-none" href="#">
            <img src="/image/ld/member/LOGO.png" width="60" height="60" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7"
            aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- 瀏覽列 --}}
        <div class=" collapse navbar-collapse row" id="myNavbarToggler7">
            <div class="col-10 navbar-nav ">
                <div class="ml-5 mr-3 d-none d-lg-block">
                    <img width="70" height="70" class="box-img  " src="/image/ld/member/LOGO.png">
                </div>
                <li class="nav-itemr ">
                    <a class="nav-link font-nav 
                    @if (Request::is('ld/member/list')) active @endif
                    "
                        href="/ld/member/list">會員管理</a>
                </li>
                <li class="nav-itemr">
                    <a class="nav-link font-nav
                    @if (Request::is('ld/goods/list')) active @endif
                    "
                        href="/ld/goods/list">庫存管理</a>
                </li>
                <li class="nav-itemr">
                    <a class="nav-link font-nav
                    @if (Request::is('/ld/log/list')) active @endif
                    "
                        href="/ld/log/list">網站活動紀錄</a>
                </li>
            </div>


            <div class="col-2 navbar-nav justify-content-end">
                <li class="nav-iteml">
                    <a class="nav-link font-nav
                    @if (Request::is('/ld/logout')) active @endif
                    "
                        href="/ld/logout">登出</a>
                </li>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- 大標題位置 -->
        @yield('h1')


       
      

        @yield('content')






    </div>


    @yield('script')






</body>

</html>