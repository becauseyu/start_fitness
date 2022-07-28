<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>動起來阿 |動吃動吃</title>

    <!--加入leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin="" />
    <!--加入leaflet js(一定要在css之後)-->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>

    <!-- 所有標頭需要的連結 -->
    @include('front_side_frame.link')
        <!-- 插入自己的css -->
        <link href="/css/sp_idx.css" rel="stylesheet">

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
                        <a href="https://www.womenshealthmag.com/tw/fitness/fitness-club/g33373736/how-to-use-inbody/"
                            target="_blank" class="stretched-link">
                            <figure class="figure ">
                                <img src="/image/sp_introduce/sp09.jpg" height="250"
                                    class="figure-img img-fluid rounded shadow-sm">

                                <figcaption class="figure-caption text-left">

                                    <p class="h5 font-weight-bold boxcolor1">減肥前必測InBody!教你看懂inbody數據</p>
                                    <p class="pr-3">
                                         InBody體脂機透過電流通過人體，測出體脂、肌肉量與含水量等數據，教練說：「開始減肥前一定要測！」了解自己的身體組成，調整運動飲食才能對症下藥！</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">
                        <ul class=" list-group list-group-flush boxcolor2">

                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://www.womenshealthmag.com/tw/fitness/work-outs/g34458540/deadlift-training/"
                                    target="_blank" class="boxcolor2">硬舉幫助減脂，女生更要練！教你正確姿勢
                                </a>
                            </li>
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
                                <a href="https://www.youtube.com/channel/UCCgLoMYIyP0U56dEhEL1wXQ" target="_blank"
                                    class="boxcolor2">來自澳洲的Chloe Ting
                                </a>
                            </li>
                            <li class=" list-group-item list-group-item-action ">
                                <a href="https://heho.com.tw/archives/59008" target="_blank"
                                    class="boxcolor2">哈佛醫師!推薦的4個運動
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                <div>
                    <a href="sport/introduce" class="text-right font-weight-light">
                        <p class=""> 觀看更多文章...</p>
                    </a>
                </div>
            </div>
        </div>


        <div class="container mt-4" data-aos="fade-right">
            <div class="boxsp">
                <h3 class="boxcolor2">預約地圖</h3>
                <hr>
                <div class=" row ">
                    <table border="2px" class='gym_table col m-3'>
                        <tr>
                            <th class='gymTitle' colspan="2">Anytime Fitness 台中公益店</th>
                        </tr>
                        <tr>
                            <td colspan="2"><img class="gympic"
                                    src='https://lh5.googleusercontent.com/p/AF1QipNH3rmkgnaBQ55rdZHW8HXb01sNpcnNmd4Wqan8=w408-h272-k-no'>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:100px;">地址：</td>
                            <td class='gymaddr'>台中市南屯區公益路二段51號B1</td>
                        </tr>
                        <tr>
                            <td>電話：</td>
                            <td class='gymtel'>04-2327-0866</td>
                        </tr>
                        <tr>
                            <td>營業時間</td>
                            <td class='gymopen'>00:00-24:00</td>
                        </tr>
                        <tr>
                            <td>介紹：</td>

                            <td class='gymintr' style='text-align: left'>Anytime
                                Fitness——目前在全世界已經擁有超過5,000間分店，台中首家24小時健身中心，我們打造出輕鬆自在、沒有壓力的運動環境，歡迎所有人來運動。</td>
                        </tr>
                    </table>
                    <div id="mapid" class="col m-3"></div>
                </div>
                <div class="">
                    <a href="sport/gymmap" class="text-right font-weight-light">
                        <p class=""> 解鎖更多健身房...</p>
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
                        
                            <figure class="figure ">
                                <img src="/image/gym/bottle01.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">我不是胖虎冰壩杯(特別版)</h5>
                                    <p class="">氣萌團子</p>
                                </figcaption>
                            </figure>
                        
                    </div>
                    <div class="col-4 ">
                        
                            <figure class="figure ">
                                <img src="/image/gym/foamroller00.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">植纖瑜珈運動滾筒</h5>
                                    <p class="">舒緩肌肉的好夥伴</p>
                                </figcaption>
                            </figure>
                        
                    </div>
                    <div class="col-4 ">
                        
                            <figure class="figure ">
                                <img src="/image/gym/resistanceband00.webp" class="figure-img img-fluid rounded shadow-sm" alt="..."
                                    height="250">
                                <figcaption class="figure-caption ">
                                    <h5 class="boxcolor1">環狀延展彈力帶</h5>
                                    <p class="">一條帶子 練遍全身</p>
                                </figcaption>
                            </figure>
                        

                    </div>
                </div>

                <div class="">
                    <a href="goods/index" class="text-right font-weight-light">
                        <p class=""> 更多健身小物...</p>
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
  <script src="/js/sp_idx.js"></script>



</body>



</html>
