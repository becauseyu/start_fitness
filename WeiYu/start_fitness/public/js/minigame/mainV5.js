import { Food, Player, HealthFood, JunkFood } from './Food5.js';


// 執行必要參數
var foodContainer = [];
var JunkFoodContainer = [];
var HealthFoodContainer = [];
var img_onload = 0;
var game = '';
var isPlaying = false;


// -------遊戲參數(s)--------------------------------------------------
var gameTime = 60;  // 單次總時間
var canvas_update_time = 0.02; // canvas刷新頻率(秒)

// 大小設置
var canvas_width = 1000;
var canvas_height = 1000;
var start_button_width = '100px';
var initialWeight_width = '50px';



//  食物參數 : 半徑、重量、目標、速度
//------------以下好食物區-------------------------
var defaultHealthFood = {
    radius: 30,
    weight: 2,
    speed: 10,
    liveTime: 5

}

var healthFood_salmon = {
    radius: 50,
    weight: 20,
    speed: -1,
    liveTime: 10,
    image: new Image(),
}

var healthFood_cabbage = {
    radius: 35,
    weight: 5,
    speed: 0,
    liveTime: 5,
    image: new Image(),
}

var healthFood_apple = {
    radius: 25,
    weight: 1,
    speed: 0,
    liveTime: 5,
    image: new Image(),
}



//------------以下壞食物區------------------------
// 
var defaultJunkFood = {
    radius: 50,
    weight: 5,
    speed: 10,
    liveTime: 20,

}



var junkFood_fries = {
    radius: 50,
    weight: 3,
    speed: 15,
    liveTime: 10,
    image: new Image(),
}

var junkFood_burger = {
    radius: 50,
    weight: 10,
    speed: 10,
    liveTime: 10,
    image: new Image(),
}

var junkFood_pizza = {
    radius: 70,
    weight: 20,
    speed: 8,
    liveTime: 10,
    image: new Image(),
}


//--------------------------------------------

// 玩家預設參數
var playerData = {
    x: canvas_width / 2,
    y: canvas_height / 2,
    weight: 70,
    height: 170,
    radius: 70,
    speed: 10,
    image: {
        w50: new Image(),
        w60: new Image(),
        w70: new Image(),
        w80: new Image(),
        w100: new Image(),
    }
}

//--------------------------------------------
// 所有圖片載入
junkFood_fries.image.onload = () => { isImageReady(11, gameBox) };
junkFood_burger.image.onload = () => { isImageReady(11, gameBox) };
junkFood_pizza.image.onload = () => { isImageReady(11, gameBox) };
healthFood_salmon.image.onload = () => { isImageReady(11, gameBox) };
healthFood_cabbage.image.onload = () => { isImageReady(11, gameBox) };
healthFood_apple.image.onload = () => { isImageReady(11, gameBox) };

playerData.image.w50.onload = () => { isImageReady(11, gameBox) };
playerData.image.w60.onload = () => { isImageReady(11, gameBox) };
playerData.image.w70.onload = () => { isImageReady(11, gameBox) };
playerData.image.w80.onload = () => { isImageReady(11, gameBox) };
playerData.image.w100.onload = () => { isImageReady(11, gameBox) };


// 用img_onload判斷圖片是不是載完了，如果載完(數量等於total)執行callbak function
function isImageReady(total, callback) {
    img_onload += 1;
    console.log(img_onload);
    if (img_onload == total) {

        callback();
    }
}



junkFood_fries.image.src = 'http://localhost:8000/image/gameIMG/bsd_01.png';
junkFood_burger.image.src = 'http://localhost:8000/image/gameIMG/bsd_02.png';
junkFood_pizza.image.src = 'http://localhost:8000/image/gameIMG/bsd_03.png';
healthFood_salmon.image.src = 'http://localhost:8000/image/gameIMG/good_01.png';
healthFood_cabbage.image.src = 'http://localhost:8000/image/gameIMG/good_02.png';
healthFood_apple.image.src = 'http://localhost:8000/image/gameIMG/good_03.png';

playerData.image.w50.src = 'http://localhost:8000/image/gameIMG/girl_50.png';
playerData.image.w60.src = 'http://localhost:8000/image/gameIMG/girl_60.png';
playerData.image.w70.src = 'http://localhost:8000/image/gameIMG/girl_70.png';
playerData.image.w80.src = 'http://localhost:8000/image/gameIMG/girl_80.png';
playerData.image.w100.src = 'http://localhost:8000/image/gameIMG/girl_100.png';



// 關卡參數

var level1_data = {
    healthFood_total: 8,
    junkFood_total: 10,
    update_time: 0.2,

    healthFood: [{ name: 'healthFood_apple', cd: 1 },
    { name: 'healthFood_cabbage', cd: 3 },
    { name: 'healthFood_salmon', cd: 10 }],

    junkFood: [{ name: 'junkFood_fries', cd: 2 },
    { name: 'junkFood_burger', cd: 3 },
    { name: 'junkFood_pizza', cd: 10 }],
    junkFood_CD: [0, 2, 9]
}


function gameBox() {


    // resize canvas 從別人抄來的，不能用
    // function resize() {
    //     let canvas = document.querySelector('canvas')
    //     let ww = window.innerWidth
    //     let wh = window.innerHeight
    //     let wRatio =  ww / wh
    //     let gameRatio = canvas_width / canvas_height
    //     if (wRatio < gameRatio) {
    //         canvas.style.width = ww + 'px'
    //         canvas.style.height = ( ww / gameRatio ) + 'px'
    //     } else {
    //         canvas.style.width = ( wh * gameRatio ) + 'px'
    //         canvas.style.height = wh + 'px'
    //     }
    // }
    // resize()
    // window.addEventListener('resize', resize, false)	// 偵聽事件 resize



    //*************************************************************************************** */
    //*************************************************************************************** */
    //*************************************************************************************** */
    //*************************************************************************************** */
    //*************************************************************************************** */
    //*************************************************************************************** */

    // 抓到canvas 調整大小先，所有起始畫面調整都在這裡
    var canvas = document.getElementById('canvas');
    canvas.width = canvas_width;
    canvas.height = canvas_height;
    var gameBox = document.getElementById('gameBox');
    var initialWeight = document.getElementById('initialWeight');
    var start_button = document.getElementById('start_button');

    // start_button.style.width = start_button_width;
    // start_button.style.top = `calc(${gameBox.offsetHeight * 0.7}px)`;
    // start_button.style.left = `calc(${gameBox.offsetWidth}px  / 2 - (${start_button_width}) / 2  )`;

    // initialWeight.style.width = initialWeight_width;
    // initialWeight.style.top = `calc(${gameBox.offsetHeight * 0.6}px)`;
    // initialWeight.style.left = `calc(${gameBox.offsetWidth}px  / 2 - (${initialWeight_width}) / 2  )`;



    var context = canvas.getContext('2d');
    context.globalCompositeOperation = 'source-over';
    // ---- check if I really got it----
    // console.log(canvas)


    // 刻起始畫面
    function startPage() {

        // 清畫面
        context.clearRect(0, 0, canvas.width, canvas.height);

        // 大標題
        context.font = "150px sans-serif ";
        context.textAlign = "center";
        context.fillText(`飲食控制遊戲`, canvas_width / 2, 0.2 * canvas_height);

        // 大頭
        context.drawImage(randomPicture(), canvas_width / 2 - 300, canvas_height / 2 - 100, 200, 200);
        context.drawImage(randomPicture(), canvas_width / 2 - 100, canvas_height / 2 - 100, 200, 200);
        context.drawImage(randomPicture(), canvas_width / 2 + 100, canvas_height / 2 - 100, 200, 200);


        document.getElementById('start_button').style.display = 'block';

    }


    startPage();

    function randomPicture() {
        switch (Math.floor(Math.random() * 5)) {
            case 0: return playerData.image.w50;
            case 1: return playerData.image.w60;
            case 2: return playerData.image.w70;
            case 3: return playerData.image.w80;
            case 4: return playerData.image.w100;
        }
    }

    //-------------------------------------------------------------------------------------------
    // 隨機地點新增食物function

    function randomXY(chaseWho) {
        do {
            var x = Math.random() * canvas.width;
            var y = Math.random() * canvas.height;

            var dx = x - chaseWho.x;
            var dy = y - chaseWho.y;

            // 避開玩家位置，緩衝固定 20 
            if ((dx * dx + dy * dy) >= Math.pow(chaseWho.radius + 100, 2)) {
                return [x, y];
            }

        } while (1);

    }

    function addFood(chaseWho, foodName = defaultHealthFood) {
        var [x, y] = randomXY(chaseWho);
        foodContainer = [...foodContainer, new Food(x, y, chaseWho, foodName)];
    }

    function addHealthFood(chaseWho, foodName = defaultHealthFood) {
        var [x, y] = randomXY(chaseWho);
        HealthFoodContainer = [...HealthFoodContainer, new HealthFood(x, y, chaseWho, foodName)];
    }

    function addJunkFood(chaseWho, foodName = defaultJunkFood) {
        var [x, y] = randomXY(chaseWho);
        JunkFoodContainer = [...JunkFoodContainer, new JunkFood(x, y, chaseWho, foodName)];
    }




    //-------------------------------------------------------------------------------------
    // 在邊界新增食物
    // 
    function borderRandomXY(chaseWho) {
        do {
            // switch 上右下左
            var whichSide = Math.floor(Math.random() * 4);
            var x = 0;
            var y = 0;
            switch (whichSide) {
                case 0: y = 0; x = Math.random() * canvas.width; return [x, y];
                case 1: y = Math.random() * canvas.height; x = canvas.width; return [x, y];
                case 2: y = canvas.width; x = Math.random() * canvas.width; return [x, y];
                case 3: y = Math.random() * canvas.width; x = 0; return [x, y];
            }


            // 避開玩家位置，緩衝固定 20
            if ((dx * dx + dy * dy) >= Math.pow(chaseWho.radius + 100, 2)) {
                return [x, y];
            }


        } while (1)

    }

    function addFoodBesideWall(chaseWho, foodName = defaultHealthFood) {
        var [x, y] = borderRandomXY();
        foodContainer = [...foodContainer, new Food(x, y, chaseWho, foodName)];

    }


    function addHealthFoodBesideWall(chaseWho, foodName = defaultHealthFood) {
        var [x, y] = borderRandomXY();
        HealthFoodContainer = [...HealthFoodContainer, new HealthFood(x, y, chaseWho, foodName)];

    }

    function addJunkFoodBesideWall(chaseWho, foodName = defaultJunkFood) {
        var [x, y] = borderRandomXY();
        JunkFoodContainer = [...JunkFoodContainer, new JunkFood(x, y, chaseWho, foodName)];

    }



    //-------------------------------------------------------------------------------------
    // 為了配合遊戲畫面刷新速度，寫在主程式比較好，不建議寫在物件裡

    // draw Food good or bad
    function drawFoods() {
        foodContainer.forEach((e) => {
            e.showLocation();
        })

        HealthFoodContainer.forEach((e) => {
            e.showLocation();
        })

        JunkFoodContainer.forEach((e) => {
            e.showLocation();
        })

    }

    // draw player
    function drawPlayer(player) {
        player.showLocation();
    }



    //-----------------------------------------------------------------------------------------
    // 有關食物(怪物) 的生命週期

    // Food has its liveTime,  after few second will die, then isLive = false
    function deleteDeadFoods(container) {
        let ii = 0;
        while (ii < container.length) {
            if (container[ii].isLive) {
                ii++;
            } else {
                // if Food is dead, delete it
                delete container[ii];
                container.splice(ii, 1);
            }
        }

    }

    //  kill foods buy hand , maybe when gameover or some event
    function killFoods(container) {
        container.forEach(food => {
            food.isLive = false;
        })
    }


    //-------------------------------------------------------------------------------------------------------
    // 刷新畫面時應該做哪些動作

    function animate(player) {
        context.clearRect(0, 0, canvas.width, canvas.height);
        deleteDeadFoods(foodContainer);
        deleteDeadFoods(HealthFoodContainer);
        deleteDeadFoods(JunkFoodContainer);
        drawPlayer(player);
        drawFoods();
        showTitle()
        showWeight(player)
        // document.getElementById('weight').innerText = `現在體重 : ${player.weight}`;
    }

    //------------------------------------------------------------------------------------------
    //  顯示參數
    function showText() {
        // 純粹測試用
        context.font = "50px sans-serif";
        // context.textAlign = "center";
        // context.fillText("現在體重",10,50);
        context.fillText('剩餘時間 :', 10, 0.05 * canvas_height);
    }



    function showTimeLeft(timeLeft) {
        context.font = "50px sans-serif";
        context.textAlign = "left";
        context.fillText(`剩餘時間 : ${timeLeft.toFixed(2)} s`, 10, 0.05 * canvas_height);
    }

    function showTitle() {
        context.font = "50px sans-serif";
        context.textAlign = "right";
        context.fillText(`飲控遊戲`, canvas_width - 10, 0.05 * canvas_height);

    }


    // 體重條
    function drawWeightBar(player, lockWeight = true) {
        // 換算BMI
        var playerWeight = player.weight;
        var playerHeight = player.height;

        var bmi = playerWeight / (playerHeight * 0.01) / (playerHeight * 0.01);
        var bar_max = 40.5;
        var bar_min = 13;

        // 是否鎖上下限
        if (lockWeight) {
            if (bmi < bar_min) { bmi = bar_min; player.weight = Math.floor(bar_min * playerHeight * playerHeight / 10000) };
            if (bmi > bar_max) { bmi = bar_max; player.weight = Math.floor(bar_max * playerHeight * playerHeight / 10000) };
        }

        var barPercent = (bmi - bar_min) / (bar_max - bar_min);



        // 現在狀態:全長 BMI = 13 ~ 40.5
        var now_bar = 0;
        if (barPercent >= 0) { now_bar = barPercent };
        if (barPercent > 1) { now_bar = 1 };

        // 安全範圍 BMI = 18.5~24

        var save_bar = 0;
        if (barPercent > 0.2) { save_bar = barPercent - 0.2 };
        if (barPercent > 0.4) { save_bar = 0.2 };


        // 危險區間 BMI = 35~40.5
        var danger_bar = 0;
        if (barPercent > 0.8) { danger_bar = barPercent - 0.8 };
        if (barPercent > 1) { danger_bar = 0.2 };



        // 畫出體重條
        context.beginPath();
        context.save();

        context.fillStyle = 'black';
        context.fillRect(0, canvas_height * 0.95, canvas_width * now_bar, 20);

        context.fillStyle = 'green';
        context.fillRect(canvas_width * 0.2, canvas_height * 0.95, canvas_width * save_bar, 20);

        context.fillStyle = 'red';
        context.fillRect(canvas_width * 0.8, canvas_height * 0.95, canvas_width * danger_bar, 20);

        context.fillStyle = 'black';
        context.restore();
    }


    function showWeight(player) {
        context.font = "40px sans-serif";
        context.textAlign = "left";
        context.fillText(`現在體重 : ${player.weight.toFixed(0)} kg`, 10, 0.9 * canvas_height);
    }




    //---------------------------------------------------------------------------------------------------------
    //
    //
    //---------------------------------------------------------------------------------------------------------



    // 關卡設計

    function setLevel(player, levelData = level1_data) {

        var healthFood_selection = levelData.healthFood;
        var junkFood_selection = levelData.junkFood;

        //  產生食物(怪物)
        //  機制 : 隨機被選到的怪物會暫時離開選擇袋(進cd)，等到cd時間結束後會再回到袋子被選擇
        function generate_foods() {
            if (HealthFoodContainer.length < levelData.healthFood_total) {
                if (healthFood_selection.length) {
                    var choose1 = healthFood_selection.splice(Math.floor(Math.random() * healthFood_selection.length), 1)[0];
                    addHealthFood(player, eval(choose1.name));
                    setTimeout(() => {
                        healthFood_selection.push(choose1);
                    }, choose1.cd * 1000)
                }
            }
            if (JunkFoodContainer.length < levelData.junkFood_total) {
                if (junkFood_selection.length) {
                    var choose2 = junkFood_selection.splice(Math.floor(Math.random() * junkFood_selection.length), 1)[0];
                    addJunkFoodBesideWall(player, eval(choose2.name));
                    setTimeout(() => {
                        junkFood_selection.push(choose2);
                    }, choose2.cd * 1000)
                }
            }


            // 確定遊戲還在運作
            if (isPlaying) {
                setTimeout(generate_foods, level1_data.update_time * 1000);
            }

        }

        generate_foods();



    }


    //-------------------------------------------------------------------------------
    // 實際開始與結束

    function start(height, weight, levelData = level1_data) {
        clearInterval(game);
        isPlaying = true;
        playerData.height = height;
        playerData.weight = weight;
        var player = new Player(playerData);
        var timeLeft = gameTime;
        setLevel(player, levelData);

        game = setInterval(() => {
            if (!document.getElementById('canvas')) {
                isPlaying = false;
                clearInterval(game);
            }

            animate(player);
            timeLeft -= canvas_update_time;
            if (timeLeft <= 0) { timeLeft = 0 };
            showTimeLeft(timeLeft);
            // drawWeightBar(player,true);
            drawWeightBar(player, false);


            if (timeLeft <= 0) { gameover(player) };

        }, canvas_update_time * 1000);


    }


    function gameover(player) {
        isPlaying = false;
        clearInterval(game);
        killFoods(foodContainer);
        killFoods(HealthFoodContainer);
        killFoods(JunkFoodContainer);
        startPage();
        endPage(player);


    }

    //----------------------------------------------------------------------------
    // 刻結束畫面
    function endPage(player) {
        // 清畫面
        context.clearRect(0, 0, canvas.width, canvas.height);

        // 刻出bmi值
        var bmi = Math.floor((player.weight * 10000 / player.height / player.height));
        context.font = "80px sans-serif";
        context.textAlign = "cneter";
        context.fillText(`您最後的bmi值為 : ${bmi}`, canvas_width / 2, 0.2 * canvas_height);


        // 根據bmi值寫一些勉勵人的話
        var resultHTML = ""
        if (bmi >= 40) {
            resultHTML = "你的體重似乎完全控制不下來，再接再厲";
        } else if (bmi >= 35) {
            resultHTML = "我知道你很努力，請再加油!";
        } else if ((bmi <= 24) && (bmi >= 18)) {
            resultHTML = "恭喜你，你是一個控制飲食達人";
        } else if (bmi <= 13) {
            resultHTML = "我知道你很厲害，但老實說太瘦也不是甚麼好事，之後努力增胖吧";
        } else {
            resultHTML = "很高興你把體重控制得不錯，但還可以更好";
        }
        context.font = "30px sans-serif";
        context.fillText(resultHTML, canvas_width / 2, 0.6 * canvas_height);


    }






    //----------------------------------------------------------------------------
    // 綁定按鍵事件
    document.getElementById('start_button').addEventListener('click', (e) => {


        console.log(document.getElementById('initialHeight').value)
        var height = parseInt(document.getElementById('initialHeight').value, 10);
        var weight = parseInt(document.getElementById('initialWeight').value, 10);


        // 符合條件才開始
        if (height && weight) {
            document.getElementById('start_button').style.display = 'none';
            start(height, weight);
        }

        // 補齊身高
        if (!height) {
            height = 165;
            document.getElementById('initialHeight').value = 165;

            // 相當於創造一個change事件
            const event = new Event("change", {
                bubbles: true,
                cancelable: true,
            });
            document.getElementById('initialHeight').dispatchEvent(event)
            document.getElementById('errorLog').innerText = '可能您沒輸入身高或體重或是有個數值怪怪的，所以我們給一個建議值';
        }

        // 補齊體重
        if (!weight) {
            weight = Math.floor(26 * height * height / 10000);
            document.getElementById('initialWeight').value = weight;
            document.getElementById('errorLog').innerText = '可能您沒輸入身高或體重或是有個數值怪怪的，所以我們給一個建議值';
        }



    });




}