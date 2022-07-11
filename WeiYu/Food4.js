// 抓繪圖canvas
export class GameCanvas {
    constructor() {
        this.canvas = document.getElementById('canvas');
        this.context = canvas.getContext('2d');

    }
}


// -------所有食物雛形，裡面包含-----------
// 預設參數
// showlocation() 畫布畫下去
// move() 移動方法
// imDead 死亡
// action() 動起來 
// eat() 如何判定被吃到
// changeWeight() 對目標的影響
// ----------------------------------------
export class Food extends GameCanvas {

    constructor(x = 100, y = 200, chaseWho = '', foodName) {
        // foodName = {
        //     radius :,
        //     weight :,
        //     speed  :,
        //     liveTime :,
        //     image :,
        // }

        super();
        this.isLive = true;

        this.chaseWho = chaseWho;

        this.radius = foodName.radius;
        this.weight = foodName.weight;
        this.speed = foodName.speed;
        this.liveTime = foodName.liveTime;
        this.image = foodName.image;


        this.x = x;
        this.y = y;
        if (x > this.canvas.with - this.radius) { this.x = this.canvas.with - this.radius; }
        if (x < this.radius) { this.x = this.radius; }
        if (y > this.canvas.height - this.radius) { this.y = this.canvas.height - this.radius; }
        if (y < this.radius) { this.y = this.radius; }






        this.action();


    }

    showLocation() {
        if (this.image == undefined) {

            this.context.beginPath();
            this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
            this.context.fillStyle = 'white';
            this.context.fill();
            this.context.fillStyle = 'black';
        } else {
            this.context.beginPath();
            this.context.save();


            //------------包含旋轉，那這個等有需要再做---------------------
            // this.context.translate(this.x, this.y);
            // this.context.rotate(Math.PI * 0.1);
            // this.context.arc(0, 0, this.radius, 0, Math.PI * 2, true);
            // this.context.clip();
            // this.context.drawImage(this.image, -this.radius, -this.radius , 2*this.radius , 2*this.radius);
            //-----------------------------------------------------------


            //------------圖片切成圓形-----------------------------------
            this.context.arc(this.x, this.y, this.radius * 0.9, 0, Math.PI * 2, true);
            this.context.clip();
            this.context.drawImage(this.image, this.x - this.radius, this.y - this.radius, 2 * this.radius, 2 * this.radius);


            //---------只繪出不切圓
            // this.context.drawImage(this.image, this.x-this.radius, this.y-this.radius , 2*this.radius , 2*this.radius);
            //------------------

            this.context.restore();

        }


    }

    move() {

    }

    imDead() {
        this.isLive = false;
        clearInterval(this.aa);
    }


    //  開始行動
    action() {
        this.aa = setInterval(() => {
            this.move();
            this.eat();

        }, 40)
        this.showLocation();

        setTimeout(() => {
            this.imDead();
        }, this.liveTime * 1000);
    }


    // 吃到判定
    eat() {
        var dx = this.chaseWho.x - this.x;
        var dy = this.chaseWho.y - this.y;

        if ((dx * dx + dy * dy) < Math.pow((this.radius + this.chaseWho.radius - 2), 2)) {
            this.changeWeight();
            this.imDead();
        }
    }


    // 被吃到要做甚麼
    changeWeight() {

    }

}


// -------健康食物------------------------
//
export class HealthFood extends Food {

    // showLocation() {

    //     this.context.beginPath();
    //     this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
    //     this.context.fillStyle = 'green';
    //     this.context.fill();
    //     this.context.fillStyle = 'black';

    // }


    move() {
        //------抖動
        var dx = Math.random() - 0.5;
        var dy = Math.random() - 0.5;
        var speedX = dx / Math.sqrt(dx * dx + dy * dy);
        var speedY = dy / Math.sqrt(dx * dx + dy * dy);

        this.x += speedX;
        this.y += speedY;


        // 往目標方向緩速逃離
        dx = this.chaseWho.x - this.x;
        dy = this.chaseWho.y - this.y;

        speedX = dx / Math.sqrt(dx * dx + dy * dy) * this.speed;
        speedY = dy / Math.sqrt(dx * dx + dy * dy) * this.speed;

        this.x += speedX;
        this.y += speedY;
    }




    changeWeight() {
        this.chaseWho.weight -= this.weight;
    }


}

// -------垃圾食物------------------------
export class JunkFood extends Food {
    constructor(x, y, chaseWho, foodName) {
        super(x, y, chaseWho, foodName);
        this.dx = (Math.random() - 0.5);
        this.dy = (Math.random() - 0.5);
        this.speedX = this.dx / Math.sqrt(this.dx * this.dx + this.dy * this.dy) * this.speed;
        this.speedY = this.dy / Math.sqrt(this.dx * this.dx + this.dy * this.dy) * this.speed;





    }


    // showLocation() {

    //     this.context.beginPath();
    //     this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
    //     this.context.fillStyle = 'black';
    //     this.context.fill();
    //     this.context.fillStyle = 'black';

    // }


    move() {
        this.speedX = this.speedX / Math.sqrt(this.speedX * this.speedX + this.speedY * this.speedY) * this.speed;
        this.speedY = this.speedY / Math.sqrt(this.speedX * this.speedX + this.speedY * this.speedY) * this.speed;
        if (this.x - this.radius <= 0) { this.speedX = Math.abs(this.speedX); this.dx = Math.abs(this.dx) }
        if (this.x + this.radius >= this.canvas.width) { this.speedX = -1 * Math.abs(this.speedX); }
        if (this.y - this.radius <= 0) { this.speedY = Math.abs(this.speedY); }
        if (this.y + this.radius >= this.canvas.height) { this.speedY = -1 * Math.abs(this.speedY); }

        this.x += this.speedX;
        this.y += this.speedY;

        // 會加速
        this.speed += 0.01;
        // this.radius *= 1.002;
    }


    changeWeight() {
        this.chaseWho.weight += this.weight;
    }
}




// -------玩家所有設定-----------
// 預設參數
// showlocation() 畫布畫下去
// move() 移動方法
// imDead 死亡
// action() 動起來 
// move_controll_mode1()用滑鼠控制玩家
// ----------------------------------------


//---------玩家---------------------------
export class Player extends GameCanvas {

    constructor(playerData) {
        // playerData = {
        //     x: ,
        //     y: ,
        //     weight: ,
        //    image: ,
        // }
        super();
        this._weight = 0;
        this.weight = playerData.weight;
        this.height = playerData.height;
        this.radius = this.weight / 2;
        this.speed = 500 / this.weight;
        this.x = playerData.x;
        this.y = playerData.y;
        this.targetX = this.x;
        this.targetY = this.y;
        this.image = playerData.image;
        this.speed = playerData.speed;
        
        // this.showLocation();
        this.move_controll_mode1();


        var aa = setInterval(() => {
            this.move();
        }, 20)

    }

    showLocation() {
        this.radius = this.weight;

        this.context.beginPath();
        this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
        this.context.fillStyle = 'white';
        this.context.fill();
        this.context.fillStyle = 'black';
        if (this.image != undefined) {
            this.context.beginPath();
            this.context.save();
            this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
            this.context.clip();
            this.context.drawImage(this.image, this.x - this.radius, this.y - this.radius, 2 * this.radius, 2 * this.radius);
            this.context.restore();

        }
    }


    move() {
        // 往目標方向緩速移動
        // this.speed = 500 / this.weight;      // 減速懲罰太高了，先不要

        var dx = this.targetX - this.x;
        var dy = this.targetY - this.y;
        if (dx * dx + dy * dy <= this.speed * this.speed) { return };
        var speedX = dx / Math.sqrt(dx * dx + dy * dy) * this.speed;
        var speedY = dy / Math.sqrt(dx * dx + dy * dy) * this.speed;

        this.x += speedX;
        this.y += speedY;

    }

    move_controll_mode1() {
        this.canvas.addEventListener('mousemove', (e) => {

            // 讓移動方向指向滑鼠位置
            this.targetX = e.offsetX/this.canvas.offsetWidth*this.canvas.width;
            this.targetY = e.offsetY/this.canvas.offsetHeight*this.canvas.height;
        })

    }




    // 體重控制: 因為小於零會有bug，避免遊戲掛掉的防線
    get weight() {
        return this._weight;
    }

    set weight(weightValue) {
        // if ((this._weight - weightValue) >= 20){
        //     alert('你是不是減重太快了? 不要亂改數值好嗎?')
        //     return;
        // }
        if (weightValue > 0) {
            this._weight = weightValue;
        }else{
            this._weight = 1;
        }
    }


    imDead() {
        this.isLive = false;
    }





}
