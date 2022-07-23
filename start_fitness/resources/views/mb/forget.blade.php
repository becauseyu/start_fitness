<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--加入jquery-->
    


    @include('front_side_frame.link')
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入bootstrap-->
    


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
    <div class="headerpage">
        @include('front_side_frame.header')
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <div id='forget' class="m-5">
                            <form action="/member/forget" method="POST">
                                @csrf
                                <p align="center">忘記密碼：</p>
                                <div class="input-group mb-3">
                                    <input id="fg_email" name="fg_email" type="text" class="form-control ml-5 mr-5" placeholder="請輸入註冊信箱" aria-label="Email" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="重設密碼">
                                    <span class='notice ml-5'>{{$text->body}}</span>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 頁尾 -->
    <div class='footerpage'>
        @include('front_side_frame.footer')
    </div>
</body>
<script src="/js/main.js"></script>

</html>