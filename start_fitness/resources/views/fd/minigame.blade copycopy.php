<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="/js/minigame/mainV5.js"></script>
    <link rel="stylesheet" href="/css/minigame.css">


    <!-- 所有標頭需要的連結 -->
    @include('front_side_frame.link')

    <title>minigame</title>

    <style type="text/css">
        #container {
            display: flex;
        }

        #gameBox {
            /* position: absolute; */
            /* left: 100px; */
            /* margin: 0 auto; */
            /* min-width: 500px;
            min-height: 500px; */
            width: min(90vh, 90vw);
            height: min(90vh, 90vw);
            /* top: max(calc((90vh - 90vw) / 2), 5vh);
            left: max(calc((90vw - 90vh) / 2), 5vw); */
            margin-right: 0%; 

        }

        #rulePage,#resultPage {
            padding: 10%;
            flex-grow: 1;
        }

        /* 先隱藏結束頁 */
        #resultPage {
            margin: 0 auto;
            display: none;
            text-align: center;
            font-size: 30px;

        }

        #rulePage>* {

            position: relative;
            /* text-align: center; */
            font-size: 25px;


        }



        #rulePage .foodlist {
            font-size: 25px;
            margin-left: 5%;
        }


        #rulePage img {
            height: 20px;
        }

        canvas {

            width: 100%;
            height: 100%;
            border: 1px solid black;
            background-color: #8EB4E3;
            

        }

        #start_button, #again_button {
            position: relative;
            top: -20%;
            left: 50%;
            width: 100px;
            /* height: 50px; */
            /* line-height : 50px; */
            border: 1px solid black;
            cursor: pointer;
            align-items: center;
            text-align: center;
            font-size: 30px;
            border-radius: 20%;
            transform: translate(-50%, -50%);
        }
        #again_button {
            display: none;
        }

        #initialWeight,
        #initialHeight {
            width: 100px;
            height: 25px;
            font-size: 25px;



        }


        #div_weightButtom_bag>div {
            margin: 10px;
            border: 1px solid black;
            border-radius: 10%;
            width: 150px;
            float: left;
            padding: 5px;
            cursor: pointer;
        }

        #div_weightButtom_bag>div{
            font-size: 25px;
            width: 30%;
        }

        #div_weightButtom_bag>div:hover {
            background-color: #FBC65C;
        }

        #errorLog_height,
        #errorLog_weight {
            font-size: 20px;
            color: red;
        }

        /* 我自己加進去 */
        .b1 {
        border: 2px solid #5896f9;
        border-radius: 5px;
        height: fit-content;
        }

        .b2 {
        border: 2px solid #f9d158;
        border-radius: 5px;
        }

    </style>


</head>

<body>

    <!-- navbar -->
    <div class="headerpage">
        @include('front_side_frame.header')
    </div>

    <!-- l側邊鈕 -->
    @include('front_side_frame.sidebar_left')

    <div id="container">
        
        <div id="rulePage">
            <div><b>規則 : </b></div>
            <div>根據吃到的食物好壞會增重或減重，請於60秒內控制好您的體重 </div>
            <div>以下是健康食物</div>
            <div class='foodList'>
                <div> 蘋果 : <img src="/image/gameIMG/good_03.png" alt=""> - 1 kg </div>
                <div> 生菜 : <img src="/image/gameIMG/good_02.png" alt=""> - 5 kg</div>
                <div> 新鮮鮭魚 :<img src="/image/gameIMG/good_01.png" alt=""> - 20 kg，非常稀有，而且會緩緩離開</div>
            </div>
            <div>以下是不健康食物</div>
            <div class='foodList'>
                <div> 薯條 : <img src="/image/gameIMG/bsd_01.png" alt=""> + 3 kg </div>
                <div> 漢堡 : <img src="/image/gameIMG/bsd_02.png" alt=""> + 10 kg </div>
                <div> 披薩 : <img src="/image/gameIMG/bsd_03.png" alt=""> + 20 kg </div>
            </div>


            <div id="div_input">
                <label for="initialHeight">請先輸入身高 : </label><input type="number" id="initialHeight"><span> cm</span>
                <label for="initialWeight">，再輸入體重 : </label><input type="number" id="initialWeight" disabled><span>
                    kg</span>
            </div>
            <p id="errorLog_height"> </p>
            <p id="errorLog_weight"> </p>
            <div id="div_weightButtom_bag">
                <div class="initialWeight" id="easy"> 建議(簡單) kg </div>
                <div class="initialWeight" id="normal"> 建議(中等) kg </div>
                <div class="initialWeight" id="hard"> 建議(困難) kg </div>
            </div>

        </div>

        <div id="resultPage">
            <div><b>遊戲結束囉 : </b></div>
            <div>坐太久，該起來去喝水囉，下午茶點心選飽米花如何? </div>
            <a href="/food/introduce">
                <img src="/image/gameIMG/good_03.png" width="400" alt="">
            </a>
            <br />
            <a href="/food/introduce">點我前往商品頁</a>
            
        </div>


        <!--- 這邊是遊戲畫面 --->
        <div id='gameBox'>
            <canvas id="canvas"></canvas>
            <div id="start_button"><p>start</p></div>
            <div id="again_button"><p>again</p></div>
        </div>
        <!--- 這邊是遊戲畫面 --->
    </div>


    <!-- 腳 -->
    <div class="footerpage">
        @include('front_side_frame.footer')
    </div>

    <script>
        // 身高輸入值
        document.getElementById('initialHeight').addEventListener('change', () => {

            // 顯示體重相關標籤
            document.getElementById('initialWeight').disabled = false;


            // 身高判定
            var height = parseInt(document.getElementById('initialHeight').value, 10);
            // console.log(height);
            if (height > 200) {
                height = 200;
                document.getElementById('initialHeight').value = 200;
                document.getElementById('errorLog_height').innerHTML = '您太高了，我們只接受最高200公分';
            } else if (height < 100) {
                height = 100;
                document.getElementById('initialHeight').value = 100;
                document.getElementById('errorLog_height').innerHTML = '我不想歧視您，但不可以設定太矮';
            } else {
                document.getElementById('errorLog_height').innerHTML = '';
            }

            // 顯示建議體重
            if (height) {
                //bmi換算
                var bmi_18_weight = Math.floor(18 * height * height / 10000);
                var bmi_26_weight = Math.floor(26 * height * height / 10000);
                var bmi_40_weight = Math.floor(40 * height * height / 10000);

                // 畫面新增按鈕
                document.getElementById('easy').innerHTML = `建議(簡單) ${bmi_18_weight} kg`;
                document.getElementById('normal').innerHTML = `建議(中等) ${bmi_26_weight} kg`;
                document.getElementById('hard').innerHTML = `建議(困難) ${bmi_40_weight} kg`;


                // 3個按鈕點擊事件
                document.getElementById('easy').onclick = () => {
                    document.getElementById('initialWeight').value = bmi_18_weight;

                    // 相當於手動創造一個change事件
                    const event = new Event("change", {
                        bubbles: true,
                        cancelable: true,
                    });
                    document.getElementById('initialWeight').dispatchEvent(event);
                };
                document.getElementById('normal').onclick = () => {
                    document.getElementById('initialWeight').value = bmi_26_weight;

                    // 相當於手動創造一個change事件
                    const event = new Event("change", {
                        bubbles: true,
                        cancelable: true,
                    });
                    document.getElementById('initialWeight').dispatchEvent(event);
                };
                document.getElementById('hard').onclick = () => {
                    document.getElementById('initialWeight').value = bmi_40_weight;

                    // 相當於手動創造一個change事件
                    const event = new Event("change", {
                        bubbles: true,
                        cancelable: true,
                    });
                    document.getElementById('initialWeight').dispatchEvent(event);
                };

            }



            // 如果體重有輸入，自行判定一次體重
            var weight = parseInt(document.getElementById('initialWeight').value, 10);
            if (weight) {
                const event = new Event("change", {
                    bubbles: true,
                    cancelable: true,
                });
                document.getElementById('initialWeight').dispatchEvent(event);
            }

        });

        // 體重輸入值
        document.getElementById('initialWeight').addEventListener('change', () => {
            var height = parseInt(document.getElementById('initialHeight').value, 10);
            var weight = parseInt(document.getElementById('initialWeight').value, 10);
            var bmi = '';
            if (height && weight) {
                bmi = weight * 10000 / height / height;
            }
            console.log(bmi);

            // 體重判定

            if (bmi > 60) {
                var bmi_60_weight = Math.floor(60 * height * height / 10000);
                document.getElementById('initialWeight').value = bmi_60_weight;
                document.getElementById('errorLog_weight').innerText = '根據bmi計算，您重到不可思議，我們只好給您一個上限';
            } else if (bmi < 10  && bmi > 0) {
                var bmi_10_weight = Math.floor(10 * height * height / 10000);
                document.getElementById('initialWeight').value = bmi_10_weight;
                document.getElementById('errorLog_weight').innerText = '您太瘦了，我們只好給您一個建議下限';
            } else {
                document.getElementById('errorLog_weight').innerText = '';
            }
        });
    </script>



</body>

</html>
