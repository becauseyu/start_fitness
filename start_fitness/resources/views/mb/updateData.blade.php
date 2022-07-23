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
                        <div class="m-5">
                            {{$text->body}}
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
<script src="/js/mb_renewPsw.js"></script>


<script>

    // 跳轉寫在這裡
    setTimeout(() => {
        window.location = window.location.origin + '/member/update';
    }, 1000);
</script>



</html>