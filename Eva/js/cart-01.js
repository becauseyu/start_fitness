//進度條
const process = document.getElementById('process');
// 前進按鈕
const prev = document.getElementById('prev');
// 後退按鈕
const next = document.getElementById('next');
// 進度圈圈
const circles = document.querySelectorAll('.circle');

// 首先設定變數現在的階段 currentActive 為 1
let currentActive = 1

//每當前進紐被點擊的時候， currentActive 就加一（往前進一步）
next.addEventListener('click', () => {
  currentActive++

  //判斷還能不能前進，如果不能前進了，就設為最大步數，也就是圈圈的個數
  if (currentActive > circles.length) {
    currentActive = circles.length
  }
  // 可以用 console.log 檢視 currentActive 有沒有照我們想要的跑
  // console.log(currentActive) 

  // 更新狀態（函式內容還沒定義）
  update()
})

//每當後退紐被點擊的時候， currentActive 就減一（往後退一步）
prev.addEventListener('click', () => {
  currentActive--

  //判斷還能不能前進，如果不能後退了，就設為初始值，也就是1
  if (currentActive < 1) {
    currentActive = 1
  }
  // console.log(currentActive)

  // 更新狀態（函式內容還沒定義）
  update()
})

function update() {
  // 第一件事：更新 .circle 元素的 .active class

  //遍歷一遍 circles
  circles.forEach((circle, idx) => {

    //如果現在的 circle 的 index 比 進度（currentActive） 小的話，就是一個已完成進度，加上 active
    if (idx < currentActive) {
      circle.classList.add('active')
    } else {
      //否則這個 circle 就是一個未完成進度，拿掉 active
      circle.classList.remove('active')
    }
  })

  // 第二件事：更新進度條元素的長度
  // 因為是進度條的長度，所以我們用（已完成距離（進度-1）)/間隔數(圈圈總數-1) *100 取得長度百分比
  length = ((currentActive - 1) / (circles.length - 1)) * 100
  // 把單位加回去
  progress.style.width = length + "%"


  // 第三件事：更新按鈕狀態
  if (currentActive === 1) {
    // 如果還在第一步，那就不能後退，後退鈕 disable
    prev.disabled = true
  } else if (currentActive === circles.length) {
    // 如果已經到了最後一步，那就不能前進，前進鈕 disable
    next.disabled = true
  } else {
    // 如果都不是的話，就不用 disable，disabled 設為 false
    prev.disabled = false
    next.disabled = false
  }
}




// 數量條 //

$(function () {


  //小計
  // 發生事情的那一列
  var row = $(this).find('.table-content');

  //數量&單價
  var price = $(row).find('.price').val();
  var qty = $(row).find('input').eq(1).val();


  // //(4)印在小計上
  $(row).find('span').text(qty * price);


  console.log(qty);
  console.log(price);


  // 數量條 
  $('[data-quantity="plus"]').click(function () {
    //發生事情的那區塊
    var who = $(this).closest('.qty-cen').find('input[name=quantity]');

    // input欄位的目前數值	
    currentVal = parseInt($(who).val());

    if (!isNaN(currentVal)) {
      // Increment
      $(who).val(currentVal + 1);
    } else {
      $(who).val(0);
    }
  });

  //發生事情的按鈕
  $('[data-quantity="minus"]').click(function () {

    //發生事情的那區塊
    var who = $(this).closest('.qty-cen').find('input[name=quantity]');

    // input欄位的目前數值	
    currentVal = parseInt($(who).val());

    if (!isNaN(currentVal) && currentVal > 0) {
      // Decrement one
      $(who).val(currentVal - 1);
    } else {
      $(who).val(0);
    };

  });









});
