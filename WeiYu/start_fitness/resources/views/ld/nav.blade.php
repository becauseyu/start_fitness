<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

    @yield('head')

    @yield('title')

    @yield('style')



</head>

<body>
    <!-- 導覽列 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded justify-content-md-around row">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample10"
            aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <div class="col-2"></div>
        <div class="navbar-collapse  collapse col-8 " id="navbarsExample10">
            <ul class="navbar-nav nav-tabs mx-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/ld/member/list">會員管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">文章管理</a>
                </li>
                <li>這裡放LOGO</li>
                <li class="nav-item">
                    <a class="nav-link" href="#">訂單管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">庫存管理</a>
                </li>
            </ul>

        </div>
        <div class="navbar-nav col-2">
            <a class="nav-link float-right" href="/ld/log/list">網站活動紀錄</a>
            <a class="nav-link float-right" href="/ld/logout">登出</a>
        </div>

    </nav>



<!-- 大標題位置 -->
@yield('h1')




    <!-- 上一頁/下一頁/快速搜尋 -->
    <div class="d-flex justify-content-center">
        
        <a href=@yield('prevPageUrl')>上一頁</a>
        /
        <a href=@yield('nextPageUrl')>下一頁</a>
        /
        <form action="/ld/member/list/search" method="GET">
            @csrf
            <label for="search">快速搜尋</label>
            <input type="text" placeholder="Search.." name="search" id="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>


   


<!-- 本文位置(通常是表格) -->
    @yield('content')




    <!-- 上一頁/下一頁 -->
    <div class="d-flex justify-content-center">
        <a href=@yield('prevPageUrl')>上一頁</a>
        /
        <a href=@yield('nextPageUrl')>下一頁</a>
    </div>


</body>

</html>
