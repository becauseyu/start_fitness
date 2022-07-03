jQuery(document).ready(function () {
	// This button will increment the value
	$('[data-quantity="plus"]').click(function (e) {
		// Stop acting like a button
		e.preventDefault();
		// Get the field name
		fieldName = $(this).attr('data-field');
		// Get its current value
		var currentVal = parseInt($('input[name=' + fieldName + ']').val());
		// If is not undefined
		if (!isNaN(currentVal)) {
			// Increment
			$('input[name=' + fieldName + ']').val(currentVal + 1);
		} else {
			// Otherwise put a 0 there
			$('input[name=' + fieldName + ']').val(0);
		}
	});
	// This button will decrement the value till 0
	$('[data-quantity="minus"]').click(function (e) {
		// Stop acting like a button
		e.preventDefault();
		// Get the field name
		fieldName = $(this).attr('data-field');
		// Get its current value
		var currentVal = parseInt($('input[name=' + fieldName + ']').val());
		// If it isn't undefined or its greater than 0
		if (!isNaN(currentVal) && currentVal > 0) {
			// Decrement one
			$('input[name=' + fieldName + ']').val(currentVal - 1);
		} else {
			// Otherwise put a 0 there
			$('input[name=' + fieldName + ']').val(0);
		}
	});
});




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



//進度條v2
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function () {
	if (animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({ opacity: 0 }, {
		step: function (now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50) + "%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
				'transform': 'scale(' + scale + ')',
				'position': 'absolute'
			});
			next_fs.css({ 'left': left, 'opacity': opacity });
		},
		duration: 800,
		complete: function () {
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function () {
	if (animating) return false;
	animating = true;

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();
	//hide the current fieldset with style
	current_fs.animate({ opacity: 0 }, {
		step: function (now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1 - now) * 50) + "%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({ 'left': left });
			previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity });
		},
		duration: 800,
		complete: function () {
			current_fs.hide();
			animating = false;
		},
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function () {
	return false;
})
