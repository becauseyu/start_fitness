<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <script src="/jQuery3.5.1/jquery.slim.js"></script>
    <script src="/bootstrap-4.6.1-dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <title>member</title>

    <!-- mycss -->
    <link rel="stylesheet" href="/css/ld/backhead.css">
    <link rel="stylesheet" href="/css/ld/member.css">

    <style>

    </style>
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

        <div class="collapse navbar-collapse row" id="myNavbarToggler7">
            <div class="col-3"></div>
            <ul class="col-6 navbar-nav justify-content-center">

                <li class="nav-iteml ">
                    <a class="nav-link font-nav" href="#">會員管理</a>
                </li>
                <li class="nav-iteml ">
                    <a class="nav-link font-nav" href="#">文章管理</a>
                </li>

                <div class="px-2 d-none d-lg-block ">
                    <img width="60" height="60" class="box-img" src="/image/ld/member/LOGO.png">
                </div>

                <li class="nav-itemr ">
                    <a class="nav-link font-nav" href="#">訂單管理</a>
                </li>
                <li class="nav-itemr ">
                    <a class="nav-link font-nav" href="#">庫存管理</a>
                </li>

            </ul>
            <div class="col-3 d-flex justify-content-end">
                <div class="font-nav01 mr-2">
                    網站活動紀錄
                </div>
                <div class="font-nav01">
                    登出
                </div>
            </div>


        </div>
    </nav>
    <div class="container">
        <h1 class="text-center header01"> 會員管理</h1>
        <div class="d-flex justify-content-center ">
            <a href="" class="button01 mr-3">上一頁</a>
            <a href="" class="button01">下一頁</a>
        </div>
        <!--  表格首欄  -->
        <section class="mb-0 h4">
            <div class="row table-color m-0">
                <div class="col-1 text-center">ID</div>
                <div class="col-4 text-center">姓名</div>
                <div class="col-4 text-center">帳號名稱</div>
                <div class="col-3 text-center">狀態</div>
            </div>
        </section>
        <!--  表格單筆  -->
        <div class="accordion" id="accordionExample">
            <!--  單筆會員資料  -->
            <div class="card">
                <div class="card-header01" id="heading1">
                    <button class="btn01 btn-block" type="button" data-toggle="collapse" data-target="#collapse1">
                        <div class="row">
                            <div class="col-1 text-center">1</div>
                            <div class="col-4 text-center">你好</div>
                            <div class="col-4 text-center">aaa123</div>
                            <div class="col-3 text-center">正常</div>
                        </div>
                    </button>
                </div>
                <div id="collapse1" class="collapse" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th> ID </th>
                                <td> 1 </td>
                            </tr>
                            <tr>
                                <th> 帳號 </th>
                                <td> aaa123 </td>
                            </tr>
                            <tr>
                                <th> 姓名 </th>
                                <td> 你好 </td>
                            </tr>
                            <tr>
                                <th> email </th>
                                <td> 不知道 </td>
                            </tr>

                            <tr>
                                <th> 電話 </th>
                                <td> 0912345678 </td>
                            </tr>
                            <tr>
                                <th> 登入狀況 </th>
                                <td> 最後登入 : 2022-07-01 </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

            <!--  單筆會員資料  -->
            <div class="card">
                <div class="card-header01" id="heading1">
                    <button class="btn01 btn-block" type="button" data-toggle="collapse" data-target="#collapse1">
                        <div class="row">
                            <div class="col-1 text-center">2</div>
                            <div class="col-4 text-center">我不好</div>
                            <div class="col-4 text-center">bbb456</div>
                            <div class="col-3 text-center">停權</div>
                        </div>
                    </button>

                </div>

                <div id="collapse2" class="collapse" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th> ID </th>
                                <td> 2 </td>
                            </tr>
                            <tr>
                                <th> 帳號 </th>
                                <td> bbb456 </td>
                            </tr>
                            <tr>
                                <th> 姓名 </th>
                                <td> 我不好 </td>
                            </tr>
                            <tr>
                                <th> email </th>
                                <td> OKOK@aa123.yaqoo.tp </td>
                            </tr>

                            <tr>
                                <th> 電話 </th>
                                <td> 0245874521 </td>
                            </tr>
                            <tr>
                                <th> 登入狀況 </th>
                                <td> 2022-07-02 停權 </td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <a href="" class="button01 mr-3">上一頁</a>
            <a href="" class="button01">下一頁</a>
        </div>

    </div>














</body>

</html>