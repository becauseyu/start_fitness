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


    <!-- r側邊鈕/飲食 -->
    @include('front_side_frame.sidebar_right')


    <!-- 中間文字框 -->
    <div class="">
        <div class="container mt-4 " data-aos="fade-right">
            <div class="boxsp">
                <h3 class="boxcolor2">運動Tip</h3>
                <hr>
                <div class=" row">
                    <div class="col-6 ">
                        <a href="https://heho.com.tw/archives/59008" target="_blank" class="stretched-link">
                            <figure class="figure ">
                                <img src="/image/sp_introduce/sp01.png" height="350" class="figure-img rounded shadow-sm">
                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">哈佛醫師!推薦的4個運動</p>
                                    <p class="pr-3">哈佛醫學院教授 I-Min Lee
                                        要來推薦４個他認為對身體最好的運動，這些運動的好處不僅可以減肥、增加，還能預防心血管疾病，保護心臟及大腦的健康喔！</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">
                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://tw.news.yahoo.com/%E9%99%8D10-%E7%99%8C%E7%97%87%E6%AD%BB%E4%BA%A1%E7%8E%87-%E9%81%8B%E5%8B%959%E5%A4%A7%E5%A5%BD%E8%99%95%E6%9B%9D-043542688.html"
                                    target="_blank" class="boxcolor2">9大運動幫助降10%癌症死亡率
                                </a> 
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34296726/how-to-squat-correctly/"
                                    target="_blank" class="boxcolor2">初學者必讀「深蹲」教學！
                                </a> 
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/workoutroutine/g31719522/5-iger-glute-workout-routine/"
                                    target="_blank" class="boxcolor2">「蜜桃臀養成」運動懶人包
                                </a> 
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/workoutroutine/g31719522/5-iger-glute-workout-routine/"
                                    target="_blank" class="boxcolor2">硬舉幫助減脂，女生得練！
                                </a> 
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.youtube.com/channel/UCFd-9jAfbuUjwDZjisOwv1w/featured"
                                    target="_blank" class="boxcolor2">在美國Shuai Li 「帥」
                                </a> 
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.youtube.com/channel/UCCgLoMYIyP0U56dEhEL1wXQ"
                                    target="_blank" class="boxcolor2">來自澳洲的Chloe Ting
                                </a> 
                            </li>
                            
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
            <div class="boxsp">
                <h3 class="boxcolor2">健身小物</h3>
                <hr>
                <div class=" row">
                    <div class="col-4 ">
                        <a href="#" class=" ">
                            <figure class="figure ">
                                <img src="/image/AI/food/03.1.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
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
                                <img src="/image/AI/food/00.1.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
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
                                <img src="/image/AI/food/01.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
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
                    <a href="./fd_introduce.html" class="text-right font-weight-light">
                        <p class=""> 更多健身小物...</p>
                    </a>
                </div>
            </div>

        </div>
        <div class="container mt-4" data-aos="fade-right">
            <div class="boxsp">
                <h3 class="boxcolor2">健身地圖</h3>
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