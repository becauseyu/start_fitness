<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>吃得健康｜動吃動吃</title>



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


    <div class="">

        <div class="container mt-4 " data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">飲食Tip</h3>
                <hr>
                <div class=" row">
                    <div class="col-6 ">
                        <a href="hhttps://www.i-fit.com.tw/context/1727.html" class="stretched-link" target="_blank">
                            <figure class="figure ">
                                <img src="/image/fd_introduce/f7.png" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="300">
                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">為什麼瘦身要吃低脂、高蛋白？</p>
                                    <p class="pr-3">你一定聽過一句話：「減肥七分靠飲食、三分靠運動。」
                                        <br>
                                        減肥時期因為熱量被限制，所吃的每一口食物都是重點，但為什麼要吃「低脂、高蛋白」的食物呢？</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">

                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1763.html" target="_blank"
                                    class="boxcolor2">忘東忘西？長白頭髮？原來是腎氣不足！？
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1613.html" target="_blank"
                                    class="boxcolor2">自助餐主菜區包你肥前三名！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1231.html" target="_blank"
                                    class="boxcolor2">維他命 C 助瘦身 芭樂更勝奇異果
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1039.html" target="_blank"
                                    class="boxcolor2">拳頭量大小 輕鬆算營養
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/95.html" target="_blank"
                                    class="boxcolor2">蛤蜊南瓜濃湯_低卡減肥食譜
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1837.html" target="_blank"
                                    class="boxcolor2">夏日常見七水果，評比大會開始！
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1928.html" target="_blank"
                                    class="boxcolor2">致肥果糖不在水果裡？
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.i-fit.com.tw/context/1685.html" target="_blank"
                                    class="boxcolor2">香蕉 5 妙用，助瘦助眠又消腫！
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
                <div>
                    <a href="food/introduce" class="text-right font-weight-light">
                        <p class=""> 觀看更多文章...</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="container mt-4" data-aos="fade-right">
            <div class="boxfd">
                <h3 class="boxcolor2">Mini game</h3>
                <hr>
                <img class='m-3' src="/image/minigame.jpg">
                <h5 class="boxcolor1">用BMI小遊戲，做個遠離高熱量食物的想像訓練吧 ( ﾟдﾟ)▄︻┻┳═一</h5>
                <div class="">
                    <a href="food/minigame" class="text-right font-weight-light">
                        <p class=""> 點我前往小遊戲...</p>
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
                                <img src="/image/food/popcron03.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
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
                                <img src="/image/food/fruitwater02.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
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
                                <img src="/image/food/jelly03.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">飽飽凍</h5>
                                    <p class="">午後時光必備零食</p>
                                </figcaption>
                            </figure>
                        </a>

                    </div>
                </div>

                <div class="">
                    <a href="goods/index" class="text-right font-weight-light">
                        <p class=""> 更多小食商品...</p>
                    </a>
                </div>
            </div>

        </div>




    </div>

    <!-- 購物車標誌 -->
    <div id="slide_buycart">
        @include('front_side_frame.buyCartIcon')
    
      </div>


    <!-- 腳 -->
    <div class="footerpage">
        @include('front_side_frame.footer')
    </div>



    <script>
        AOS.init();
    </script>
    <!-- script 主要 -->
  <script src="/js/main.js"></script>
</body>



</html>
