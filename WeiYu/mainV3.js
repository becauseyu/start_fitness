import { Food, Player, HealthFood, JunkFood } from './Food3.js';


// 執行必要參數
var foodContainer = [];
var JunkFoodContainer = [];
var HealthFoodContainer = [];
var player = [];
var game = '';
var isPlaying = false;


// 遊戲長度(s)
var gameTime = 60;


// 大小設置
var canvas_width = 600;
var canvas_height = 500;
var start_button_width = '100px';



//  食物參數 : 半徑、重量、目標、速度
var defaultHealthFood = {
    radius: 10,
    weight: 1,
    speed: 10,
    liveTime: 5

}

var healthFood_apple = {
    radius: 20,
    weight: 1,
    speed: 1,
    liveTime: 5,
    image: new Image()
}
 
var defaultJunkFood = {
    radius: 30,
    weight: 5,
    speed: 10,
    liveTime: 20,
}



var junkFood_fries = {
    radius: 30,
    weight: 5,
    speed: 10,
    liveTime: 20,
    image: new Image()
}
junkFood_fries.image.src = './image/fries.jpg'; 
healthFood_apple.image.src = './image/apple.jfif';










var playerData = {
    x: canvas_width / 2,
    y: canvas_height / 2,
    weight: 70
}


// 關卡參數

var level1_data = {
    healthFood_total: 10,
    junkFood_total: 5,
    update_time: 1
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

    document.getElementById('start_button').style.width = start_button_width;
    document.getElementById('start_button').style.top = -canvas_height / 2 + 'px';
    document.getElementById('start_button').style.left = `calc(${canvas_width / 2}px - (${start_button_width}) / 2  )`;


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

        document.getElementById('weight').innerText = `現在體重 : ${player.weight}`;
    }

    //------------------------------------------------------------------------------------------
    // 關卡設計

    function level_1() {
        if (HealthFoodContainer.length < level1_data.healthFood_total) {
            addHealthFood(player,healthFood_apple);
        }
        if (JunkFoodContainer.length < level1_data.junkFood_total) {
            addJunkFoodBesideWall(player, junkFood_fries);
        }
        if (isPlaying) {
            setTimeout(level_1, level1_data.update_time * 1000);
        }

    }

    //-------------------------------------------------------------------------------
    // 實際開始與結束

    function start() {
        clearInterval(game);
        isPlaying = true;
        player = new Player(playerData);
        level_1();
        game = setInterval(() => {
            animate();
            if (!document.getElementById('canvas')) {
                isPlaying = false;
                clearInterval(game);
            }

        }, 20);
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