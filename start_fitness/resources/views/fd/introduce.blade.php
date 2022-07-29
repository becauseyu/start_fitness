<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲食tips |動吃動吃</title>


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


    
    <!-- l側邊鈕 -->
    @include('front_side_frame.sidebar_left')

    <div class="card-deck card-group"></div>
    <div class="album py-4 ">
        <div class="container">
            <div class="row ">

                <div class="card-deck">
                    <div class="col-md-6 card mb-4 border-warning shadow-sm " data-aos="fade-up">
                        <img src="/image/fd_introduce/f1.jpg" alt="" class="img-fluid rounded ">

                        <div class="card-body ">
                            <h5 class="card-title">自助餐主菜區包你肥前三名！</h5>
                            <p class="card-text">自助餐可算是外食一族的均衡補給站，但若想避免熱量超標，挑選菜色時就得特別小心。(≖＿≖)✧
                                <br>
                                否則每餐都爆卡，體重當然會跟著一路攀升啊！
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1613.html" target="_blank">
                                    <button type="button" class="btn button01">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2016-08-22</small>
                                </div>
                            </div>

                        </div>


                    </div>



                    <div class="col-md-6 card mb-4 border-warning shadow-sm " data-aos="fade-up">
                        <img src="/image/fd_introduce/f7.png" alt="" class="img-fluid rounded ">

                        <div class="card-body">
                            <h5 class="card-title">為什麼瘦身要吃低脂、高蛋白？</h5>
                            <p class="card-text">你一定聽過一句話：「減肥七分靠飲食、三分靠運動。」
                                <br>
                                減肥時期因為熱量被限制，所吃的每一口食物都是重點，但為什麼要吃「低脂、高蛋白」的食物呢？
                            </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1727.html" target="_blank">
                                    <button type="button" class="btn button01">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-11-16</small>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>

                <div class="card-deck">
                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f3.png" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">夏日常見七水果，評比大會開始！</h5>
                            <p class="card-text">熱浪來襲，夏天終於來臨囉！炎炎夏日是吃水果的大好季節，編編已經準備大飽口福了呢。(*ﾟ∀ﾟ*)
                                <br>
                                當令水果都富含營養，有些更具備美白、抗老、抗水腫等妙用，究竟有哪些「夏季好果」不該錯過呢？這些水果佳麗各有特色，就讓編編為大家一一點評</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1837.html" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-06-23</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f2.png" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">維他命 C 助瘦身 芭樂更勝奇異果</h5>
                            <p class="card-text">
                                酸酸甜甜的奇異果，相信是很多團員瘦身期間的最愛～奇異果因其高密度的營養價值，在歐美被譽為超級水果之一，不過奇異果不便宜捏，若想天天吃還挺傷本的... </p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1231.html" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2014-10-08</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f8.jpg" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">致肥果糖不在水果裡？</h5>
                            <p class="card-text">
                                欸欸，聽說水果的果糖進入身體會直接變成脂肪，瘦身是不是少碰水果為妙？
                                會有這樣的說法，最好先了解醣類在體內的代謝狀況。(≖＿≖)✧</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1928.html" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2018-02-19</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-deck">

                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f6.jpg" class="img-fluid rounded " alt="">


                        <div class="card-body">
                            <h5 class="card-title">蛤蜊南瓜濃湯_低卡減肥食譜</h5>
                            <p class="card-text">
                                蛤蜊和南瓜都是營養價值極高的食材，加上了牛奶令味道更顯香濃，巧妙運用電鍋好幫手，只需簡簡單單三步驟，營養滿分的濃湯就能輕鬆上桌囉！</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/95.html" target="_blank">
                                    <button type="button" class="btn button01">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2013-01-04</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f4.png" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">忘東忘西？長白頭髮？原來是腎氣不足！？</h5>
                            <p class="card-text">
                                熱「最近腦袋一直記不住東西，是不是年紀真的變大了...」(〒︿〒)
                                <br>
                                有這個煩惱的團員們，先和編編一起做個小測驗，看看下面情況你是否不陌生？</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1763.html" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2017-06-03</small>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="card mb-4 border-warning shadow-sm col-md-4" data-aos="fade-up">

                        <img src="/image/fd_introduce/f5.jpg" class="img-fluid rounded " alt="">

                        <div class="card-body">
                            <h5 class="card-title">拳頭量大小 輕鬆算營養</h5>
                            <p class="card-text">
                                六大類食物又要怎樣吃才夠？一份究竟是多少咧？

                                告訴大家一個小祕密，其實只要伸出拳頭，就能簡單測量食物的「份量」，現在就讓小編將技巧通通傳授給你吧！</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="https://www.i-fit.com.tw/context/1039.html" target="_blank">
                                    <button type="button" class="btn button02">View</button>
                                </a>
                                <div class="text-right mb-2">
                                    <small class="text-muted ">2014-03-11</small>
                                </div>
                            </div>
                        </div>

                    </div>


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