<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    @include('front_side_frame.link')
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
   
    <!-- 插入自己的css -->
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/mb_update.css" rel="stylesheet">




    <title>修改會員資料</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class='headerpage'>
        @include('front_side_frame.header')
    </div>
    <div id="content" class="mt-5">
        <div class="container_mb">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <ul class="nav nav-tabs">
                            <li class="nav-li selected" id="li_update">修改會員資料</li>
                            <li class="nav-li" id="li_renewPsw">修改密碼</li>
                            <!-- <li class="nav-li" id="li_point">會員購物金</li> -->
                            <li class="nav-li" id="li_order">訂單管理</li>

                        </ul>
                        <form id='update_form' class="m-5" action="/member/updateData" method="post">
                            @csrf
                            <p align="left"><i class="fa fa-id-card-o" aria-hidden="true"></i>
                                <span id="who">{{$member->account}}</span>
                                <span class='mb_status'>{{$member->staId}}</span>
                            </p>
                            <p align="left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                修改會員資料：
                            </p>
                            <p class="validUpdate"></p>
                            <div class="input-group mb-3">
                                <span>姓名：</span>
                                <input id="up_name" name="up_name" type="text" class="form-control ml-5 mr-5" value="{{$member->name}}" aria-label="Username" aria-describedby="basic-addon1" required>
                                <span id='cor_name' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <span>手機：</span>
                                <input id="up_tel" name="up_tel" type="text" class="form-control ml-5 mr-5" value="{{$member->tel}}" placeholder="{{$member->tel_text}}" aria-label="Username" aria-describedby="basic-addon1">
                                <span id='cor_tel' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <span>信箱：</span>
                                <input id="up_email" name="fg_email" type="text" class="form-control ml-5 mr-5" value={{$member->email}} aria-label="Username" aria-describedby="basic-addon1" disabled>
                                <span id='cor_email' class="confirmSpan"></span>
                                <input name="up_account" type="text" class="hidden" value="a echo $acc; ?>">

                            </div>

                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="修改會員資料">
                            </div>
                        </form>
                        <form id='renewPsw_form' class="m-5 hidden" action="/member/updatePsw" method="post">
                            @csrf
                            <p align="left"><i class="fa fa-key" aria-hidden="true"></i>
                                修改密碼
                            </p>
                            <p class="validUpdate"></p>
                            <div class="input-group mb-3 ">
                                <input id="old_password" name="old_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="舊密碼" aria-label="Password" aria-describedby="basic-addon1" required onchange=confirmPsw()>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='old_password' class="confirmSpan"></span>
                            </div>
                            <span class="memo ml-5 mt-2 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>
                            <div class="input-group mb-1">
                                <input id="up_password" name="fg_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="新密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password' class="confirmSpan"></span>

                            </div>
                            <div class="input-group mb-3 ">
                                <input id="new_password2" name="new_password2" type="text" class="password2 form-control ml-5 mr-5" placeholder="請再次輸入新密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password2' class="confirmSpan"></span>
                            </div>
                            <input id="fg_email" name="fg_email" type="text" class="form-control ml-5 mr-5 hidden" value="a echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1">
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="更新密碼">
                            </div>
                            <input name="id" type="text" class="hidden" value="{{$member->mid}}" />
                            <input name="view" type="text" class="hidden" value="mb.updateData" />
                        </form>
                        <!-- <form id='point_form' class="m-5 hidden" action="../php/updateData.php" method="post">
                            購物金
                        </form> -->
                        <form id='order_form' class="m-3 hidden " action="../php/updateData.php" method="post">
                            <!-- 訂單時間<input type="date" class="m-2" />至<input type="date" class="m-2" />
                            <input type="button" value="搜尋">
                            <i class="fa fa-search" aria-hidden="true"></i><span class="memo">請輸入欲查詢的區間，訂單效期為6個月</span> -->
                            <table align="center" class="table order_tb">
                                <tr>
                                    <th scope="col">訂單編號</th>
                                    <th scope="col">下單時間</th>
                                    <th scope="col">配送方式</th>
                                    <th scope="col">付款方式</th>
                                    <th scope="col">訂單金額</th>
                                </tr>
                            </table>
                            
                        </form>

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
</body>
<script src="/js/main.js"></script>
<script src="/js/mb_update.js"></script>


</html>