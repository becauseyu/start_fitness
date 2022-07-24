<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    @include('front_side_frame.link')
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
   
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
 
    <!-- 插入自己的css -->
    <link href="/css/main.css" rel="stylesheet">
    <title>{{$text->title}}</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class='headerpage'>
        @include('front_side_frame.header')
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <div  class="m-5">
                            <form action="/member/updatePsw" method="POST">
                                @csrf
                                <p align="center">請輸入新密碼：</p>
                                <p align="center" id="validUpdate"></p>
                                <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>

                                <div class="input-group mb-1">
                                    <input id="fg_password" name="fg_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <i class="checkEye2 fas fa-eye"></i>
                                    <span id='cor_password' class="confirmSpan"></span>

                                </div>
                                <div class="input-group mb-3 ">
                                    <input id="fg_password2" name="fg_password2" type="text" class="password2 form-control ml-5 mr-5" placeholder="請再次輸入密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                    <i class="checkEye2 fas fa-eye"></i>
                                    <span id='cor_password2' class="confirmSpan"></span>
                                    <input name="id" type="text" class="hidden" value="{{$text->id}}" />
                                    <input name="verify" type="text" class="hidden" value="{{$text->verify}}" />
                                    <input name="view" type="text" class="hidden" value="mb.confirmAcc" />
                                </div>
                                <div class="input-group mb-3">
                                    <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="重設密碼">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 購物車標誌 -->
    <div id="slide_buycart">
        @include('front_side_frame.buyCartIcon.blade')
    
      </div>
    <!-- 頁尾 -->
    <div class='footerpage'>
        @include('front_side_frame.footer')
    </div>
</body>
<script src="/js/main.js"></script>
<script src="/js/mb_renewPsw.js"></script>



</html>