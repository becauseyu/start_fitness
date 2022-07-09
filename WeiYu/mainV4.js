import { Food, Player, HealthFood, JunkFood } from './Food4.js';


// 執行必要參數
var foodContainer = [];
var JunkFoodContainer = [];
var HealthFoodContainer = [];

var player = [];
var game = '';
var isPlaying = false;


// -------遊戲參數(s)--------------------------------------------------
var gameTime = 60;  // 時間
var canvas_update_time = 0.02; // canvas刷新頻率(秒)

// 大小設置
var canvas_width = 1000;
var canvas_height = 1000;
var start_button_width = '100px';



//  食物參數 : 半徑、重量、目標、速度
//------------以下好食物區-------------------------
var defaultHealthFood = {
    radius: 30,
    weight: 1,
    speed: 10,
    liveTime: 5

}

var healthFood_salmon = {
    radius: 50,
    weight: 3,
    speed: -1,
    liveTime: 10,
    image: new Image(),
}

var healthFood_cabbage = {
    radius: 35,
    weight: 2,
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
    weight: 5,
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
    radius: 50,
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
    image: new Image()
}

//--------------------------------------------

// 所有圖片載入
junkFood_fries.image.src = './gameIMG/bsd_01.png';
junkFood_burger.image.src = './gameIMG/bsd_02.png';
junkFood_pizza.image.src = './gameIMG/bsd_03.png';
healthFood_salmon.image.src = './gameIMG/good_01.png';
healthFood_cabbage.image.src = './gameIMG/good_02.png';
healthFood_apple.image.src = './gameIMG/good_03.png';
playerData.image.src = './gameIMG/girl_70.png';


// 關卡參數

var level1_data = {
    healthFood_total: 8,
    junkFood_total: 10,
    update_time: 0.2,

    healthFood: [{ name: 'healthFood_apple', cd: 1 },
    { name: 'healthFood_cabbage', cd: 3 },
    { name: 'healthFood_salmon', cd: 10 }],
    
    junkFood: [{ name: 'junkFood_fries', cd: 1 },
    { name: 'junkFood_burger', cd: 3 },
    { name: 'junkFood_pizza', cd: 10 }],
    junkFood_CD: [0, 2, 9]
}


window.onload = function () {


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


    // 抓到canvas 調整大小先
    var canvas = document.getElementById('canvas');
    canvas.width = canvas_width;
    canvas.height = canvas_height;
    var gameBox = document.getElementById('gameBox');

    document.getElementById('start_button').style.width = start_button_width;
    document.getElementById('start_button').style.top =  `calc(${gameBox.offsetHeight*0.7}px)`;
    document.getElementById('start_button').style.left = `calc(${gameBox.offsetWidth}px  / 2 - (${start_button_width}) / 2  )`;

    


    var context = canvas.getContext('2d');
    context.globalCompositeOperation = 'source-over';
    // ---- check if I really got it----
    // console.log(canvas)


    //-------------------------------------------------------------------------------------------
    // 隨機地點新增食物function

    function randomXY(chaseWho) {
        do {
            var x = Math.random() * canvas.width;
            var y = Math.random() * canvas.height;

            var dx = x - chaseWho.x;
            var dy = y - chaseWho.y;

            // 避開玩家位置，緩衝固定 20 
            if ((dx * dx + dy * dy) >= Math.pow(chaseWho.radius + 20, 2)) {
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
            if ((dx * dx + dy * dy) >= Math.pow(chaseWho.radius + 20, 2)) {
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
    function drawPlayer() {
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

    function animate() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        deleteDeadFoods(foodContainer);
        deleteDeadFoods(HealthFoodContainer);
        deleteDeadFoods(JunkFoodContainer);
        drawPlayer();
        drawFoods();
        showTitle()

        // document.getElementById('weight').innerText = `現在體重 : ${player.weight}`;
    }

    //------------------------------------------------------------------------------------------
    //  顯示參數
    function showText() {
        // 純粹測試用
        context.font="50px sans-serif";
        // context.textAlign = "center";
        // context.fillText("現在體重",10,50);
        context.fillText('剩餘時間 :',10,0.05*canvas_height);
    }



    function showTimeLeft(timeLeft) {
        context.font="50px sans-serif";
        context.textAlign = "left";
        context.fillText(`剩餘時間 : ${timeLeft.toFixed(2)} s`,10,0.05*canvas_height);
    }

    function showTitle() {
        context.font="50px sans-serif";
        context.textAlign = "right";
        context.fillText(`飲控遊戲`,canvas_width-10,0.05*canvas_height);
       
    }

    
    // 體重條
    function drawWeightBar(barPercent) {
        // 現在狀態
        context.fillStyle = 'black';
        context.fillRect(0,canvas_height*0.95,canvas_width*BarPercent,20);

        // 安全範圍
        save_percent = barPercent - 0.2
        454554565wdwdwdwdwwddwdwdwdwdwdwdwdwdwdwfwfwfw

        20220709 施工中

        context.fillStyle = 'green';
        context.fillRect(canvas_width*0.2,canvas_height*0.95,canvas_width*0.2,20);

        // 危險區間
        context.fillStyle = 'red';
        context.fillRect(canvas_width*0.8,canvas_height*0.95,canvas_width*0.2,20);

    }
    

drawWeightBar();


































    // 關卡設計

    function level_1() {

        var healthFood_selection = level1_data.healthFood;
        var junkFood_selection = level1_data.junkFood;

        //  產生食物(怪物)
        //  機制 : 隨機被選到的怪物會暫時離開選擇袋(進cd)，等到cd時間結束後會再回到袋子被選擇
        function generate_foods() {
            if (HealthFoodContainer.length < level1_data.healthFood_total) {
                if (healthFood_selection.length) {
                    var choose1 = healthFood_selection.splice(Math.floor(Math.random() * healthFood_selection.length), 1)[0];
                    addHealthFood(player, eval(choose1.name));
                    setTimeout(() => {
                        healthFood_selection.push(choose1);
                    }, choose1.cd * 1000)
                }
            }
            if (JunkFoodContainer.length < level1_data.junkFood_total) {
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

    function start() {
        clearInterval(game);
        isPlaying = true;
        player = new Player(playerData);
        var timeLeft = gameTime;
        level_1();
        game = setInterval(() => {
            if (!document.getElementById('canvas')) {
                isPlaying = false;
                clearInterval(game);
            }

            animate();
            timeLeft -= canvas_update_time;
            showTimeLeft(timeLeft);

        }, canvas_update_time*1000);
        setTimeout(gameover, gameTime * 1000);
    }


    function gameover() {
        isPlaying = false;
        clearInterval(game);
        killFoods(foodContainer);
        killFoods(HealthFoodContainer);
        killFoods(JunkFoodContainer);
        document.getElementById('start_button').style.display = 'block';
        alert('gameover');

    }

    //----------------------------------------------------------------------------
    // 綁定按鍵事件
    document.getElementById('start_button').addEventListener('click', (e) => {

        document.getElementById('start_button').style.display = 'none';
        start();
    });




}