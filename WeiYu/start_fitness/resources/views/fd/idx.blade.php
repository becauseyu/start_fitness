<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <!-- 所有標頭需要的連結 -->
    @include('front_side_frame.link')



    <style>
        img {
            object-fit: contain;
        }
    </style>

    <!-- <style>
        
    </style> -->
</head>


<body>
    <!-- navbar -->
    <div class="headerpage">
        @include('front_side_frame.header')
    </div>


    <!-- l側邊鈕/運動 -->
    @include('front_side_frame.sidebar_left')


    <!-- 中間文字框 -->
    <div class="">
        <div class="container mt-4 " data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">飲食Tip</h3>
                <hr>
                <div class=" row">
                    <div class="col-6 ">
                        <a href="" class="stretched-link">
                            <figure class="figure ">
                                <img src="/image/AI/f3.png" class="figure-img img-fluid rounded shadow-sm"
                                    alt="..." height="300">
                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">夏日常見七水果，評比大會開始！</p>
                                    <p class="pr-3">熱浪來襲，夏天終於來臨囉！炎炎夏日是吃水果的大好季節，編編已經準備大飽口福了呢。(*ﾟ∀ﾟ*)</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">
                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class="boxcolor2 list-group-item list-group-item-action ">
                                <a href="" class="link-warning">
                                    忘東忘西？長白頭髮？原來是腎氣不足！？
                                </a>
                            </li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">自助餐主菜區包你肥前三名！</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">維他命 C 助瘦身 芭樂更勝奇異果</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">拳頭量大小 輕鬆算營養</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">蛤蜊南瓜濃湯_低卡減肥食譜</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">為什麼瘦身要吃低脂、高蛋白？</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">致肥果糖不在水果裡？</li>
                            <li class="boxcolor2 list-group-item list-group-item-action ">香蕉 5 妙用，助瘦助眠又消腫！</li>
                        </ul>

                    </div>

                </div>
                <div>
                    <a href="./fd_introduce.html" class="text-right font-weight-light">
                        <p class=""> 觀看更多文章...</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="container mt-4" data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">飲食小食</h3>
                <hr>
                <div class=" row">
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="/image/AI/food/03.1.webp" class="figure-img img-fluid rounded shadow-sm"
                                    alt="..." height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">飽米花‧椒鹽</h5>
                                    <p class="">淡淡鹽味，清爽少負擔</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="/image/AI/food/00.1.webp" class="figure-img img-fluid rounded shadow-sm"
                                    alt="..." height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">好好果乾水‧好心情</h5>
                                    <p class="">柑橘香，喝水好心情</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="/image/AI/food/01.webp" class="figure-img img-fluid rounded shadow-sm"
                                    alt="..." height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">飽飽凍</h5>
                                    <p class="">午後時光必備零食</p>
                                </figcaption>
                            </figure>
                        </a>

                    </div>
                </div>

                <div class="">
                    <a href="./fd_introduce.html" class="text-right font-weight-light">
                        <p class=""> 更多小食商品...</p>
                    </a>
                </div>
            </div>

        </div>
        <div class="container mt-4" data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">Mini game</h3>
                <hr>
            </div>
        </div>

    </div>



    <!-- 腳 -->
    <div class="footerpage">
        @include('front_side_frame.footer')
    </div>



    <script>
        AOS.init();
    </script>
</body>



</html>
