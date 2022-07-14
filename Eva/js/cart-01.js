$('.footerpage').load('/MengYing/大專/LAB/footer.html')
//把localStorage放進內容
//確認localStorage是否有東西
var myStorage = localStorage
goodstList = myStorage.getItem('wantList') //得到目前有被放進購物車的物品清單
//------------------如果wantList是空值，直接清空localStorage-----------------------------//
if (goodstList == '') {
	myStorage.clear()
}

//如果有，先把東西放進購物車
//初始化資料
var count = 0;
var sum = 0;
var wantList = []
if (goodstList) {
	goodstList = goodstList.split(',') //得到目前有的清單
	wantList = goodstList
	goodstList.forEach(function (elm, idx) {
		var data = JSON.parse(myStorage.getItem(elm));//把JSON轉回物件
		var divs = `
	  <div class="table-item">
	  <div class="row table-content ">
		<div class="col-8 col-sm-4 col-md-4 text-center d-flex">
		  <div class="col-sm-6  cart-items"><img src="${data.img}" class="image float-right"></div>
		  <div class="col-sm-6  text-left">
			<h4>${data.name}</h4>
		  </div>
		</div>
		<div class="col-4 col-sm-2 col-md-2 text-center ">NT$${data.singlePrice}
		  <input class="price" type="hidden" value="${data.singlePrice}">
		</div>
		<div class="col-6 col-sm-3 col-md-3 text-center ">
		  <div class="input-group plus-minus-input qty-cen">
			<div class="input-group-button">
			  <button type="button" class="btn btn-number" data-quantity="minus" data-field="quantity">
				<i class="fa fa-minus"></i>
			  </button>
			</div>
			<input class="input-group-field input-width qty" type="text" name="quantity" value="${data.count}">
			<div class="input-group-button">
			  <button type="button" class="btn btn-number plus" data-quantity="plus" data-field="quantity">
				<i class="fa fa-plus"></i>
			  </button>
			</div>
		  </div>

		</div>
		<div class="col-5 col-sm-2 col-md-2 text-center">NT$ <span class="total">${data.totalPrice}</span></div>
		<div class="col-1 col-sm-1 col-md-1 text-center">
		  <a class="btn"><i class="fa fa-times" onclick='deleteGood(this)'></i></a>
		</div>
	  </div>


	</div>
	  
	  `
		$('#car_content').append(divs)
		sum += parseInt(data.totalPrice)
		count += parseInt(data.count)
	})
	//在購物車icon放入數量
	var count = myStorage.getItem('cartQuantity')
	$('#cartQuantity').html(count)
	//在總計放入內容
	$('.total02').html(sum)
	//放入件數
	$('.total_count').html(count)
	//計算總計
	var fee = 0
	if (sum <= 2000) {
		fee = 60;
	} else {
		fee = 0;
	};
	$('.total03').html(sum + fee)
}
//先抓數量

// 數量條 
$('[data-quantity="plus"]').on('click', function () {
	//發生事情的那區塊
	var total_count = parseInt($('.total_count').html())
	var who = $(this).closest('.qty-cen').find('input[name=quantity]');
	// input欄位的目前數值	
	currentVal = parseInt($(who).val());
	if (!isNaN(currentVal)) {
		// Increment
		$(who).val(currentVal + 1);
	} else {
		$(who).val(0);
	}
	//改變總計
	total_count += 1;
	$('.total_count').html(total_count)
	// //改變購物車數量
	$('#cartQuantity').html(total_count)
	// 當按加時 重新抓數值
	var qty = $(who).val();
	var price = $(this).closest('.table-content').find('.price').val();
	var total = qty*price
	$(this).closest('.table-content').find('.total').html(qty * price);
	// //改變下面合計()件


	// 總計
	// 抓每個小計
	// 每個小計加起來
	var bigTotal = 0;
	var sum = 0;
	$('#car').find('.total').each(function (idx, elm) {
		sum = parseInt(elm.innerText);
		bigTotal += sum;
	});
	$('.total02').html(bigTotal);

	// 判斷價錢
	// if 合計...else運費$60
	if (bigTotal <= 2000) {
		$('.fee').html('NT$60');
		$('.total03').html(bigTotal + 60);
	} else {
		$('.fee').html('免運');
		$('.total03').html(bigTotal);
	};
	//更改數量加入localStorage
	var good_name = $(this).closest('.table-item').find('h4').html()
	var myStorage = localStorage
	var goodJson = myStorage.getItem(good_name)
	var goodsData = JSON.parse(goodJson)
	goodsData.count=qty
	goodsData.totalPrice = total;
	myStorage.setItem(good_name, JSON.stringify(goodsData))
	//更改購物車localStorage
	myStorage.setItem("cartQuantity", total_count)

});

//發生事情的按鈕
$('[data-quantity="minus"]').on('click', function () {
	var total_count = parseInt($('.total_count').html())
	//發生事情的那區塊
	var who = $(this).closest('.qty-cen').find('input[name=quantity]');

	// input欄位的目前數值	
	currentVal = parseInt($(who).val());

	if (!isNaN(currentVal) && currentVal > 0) {
		// Decrement one
		$(who).val(currentVal - 1);
		total_count -= 1;

		//小於0自動刪除
	} else {
		//刪除畫面
		var delete_goods = $(this).closest('.table-item')
		delete_goods.remove()
	};
	//改變總計
	$('.total_count').html(total_count)
	// //改變購物車數量
	$('#cartQuantity').html(total_count)
	// 當按減時 重新抓數值
	var qty = $(who).val();
	var price = $(this).closest('.table-content').find('.price').val();
	var total = qty*price
	$(this).closest('.table-content').find('.total').html(total);

	// 總計
	var bigTotal = 0;
	var sum = 0;
	$('#car').find('.total').each(function (idx, elm) {

		sum = parseInt(elm.innerText);
		bigTotal += sum;
	});
	$('.total02').html(bigTotal);

	// 判斷運費
	if (bigTotal <= 2000) {
		$('.fee').html('NT$60');
		$('.total03').html(bigTotal + 60);
	} else {
		$('.fee').html('免運');
		$('.total03').html(bigTotal);
	};
	//更改數量加入localStorage
	var good_name = $(this).closest('.table-item').find('h4').html()
	var myStorage = localStorage
	var goodJson = myStorage.getItem(good_name)
	var goodsData = JSON.parse(goodJson)
	goodsData.count=qty
	goodsData.totalPrice = total;
	myStorage.setItem(good_name, JSON.stringify(goodsData))
	//更改購物車localStorage
	myStorage.setItem("cartQuantity", total_count)

});


// 當輸入事件發生
// 抓到 輸入的值 與 小計
$('.qty').on('change', function () {

	var price = $(this).closest('.table-content').find('.price').val();
	var qty = $(this).val();

	$(this).closest('.table-content').find('.total').html(qty * price);

	// 總計
	var bigTotal = 0;
	var sum = 0;
	$('#car').find('.total').each(function (idx, elm) {
		sum = parseInt(elm.innerText);
		bigTotal += sum;
	});
	$('.total02').html(bigTotal);
	//抓全部的數量
	var count = 0;
	$('#car').find('.qty').each(function (idx, elm) {
		count += parseInt(elm.value)
	});


	//改變總計
	$('.total_count').html(count)
	// //改變購物車數量
	$('#cartQuantity').html(count)
	// 當按減時 重新抓數值
	var qty = $(who).val();
	var price = $(this).closest('.table-content').find('.price').val();
	$(this).closest('.table-content').find('.total').html(qty * price);

	// 判斷運費
	if (bigTotal <= 2000) {
		$('.fee').html('NT$60');
		$('.total03').html(bigTotal + 60);
	} else {
		$('.fee').html('免運');
		$('.total03').html(bigTotal);
	};

});

// 刪除商品
function deleteGood(btn) {
	var now_price = $('.total02').html()
	var now_count = $('#cartQuantity').html()
	var order_count = $('.total_count').html()
	var order_price = $('.total03').html()
	var delete_price = $(btn).closest('.table-item').find('.total').html()
	var delete_count = $(btn).closest('.table-item').find('.qty').val()
	var change_count1 = parseInt(now_count) - parseInt(delete_count)
	if (change_count1 < 0) {
		change_count1 = 0
	}
	var change_count2 = parseInt(order_count) - parseInt(delete_count)
	if (change_count2 < 0) {
		change_count2 = 0
	}
	// console.log(delete_count)
	$('.total02').html(parseInt(now_price) - parseInt(delete_price))
	$('#cartQuantity').html(change_count1)
	$('.total03').html(parseInt(order_price) - parseInt(delete_price))
	$('.total_count').html(change_count2)
	var myStorage = localStorage
	myStorage.setItem('cartQuantity', parseInt(now_count) - parseInt(delete_count))

	var delete_goods = $(btn).closest('.table-item')
	delete_goods.remove()

	//把品項從localStroage移除
	var btn_name = $(btn).closest('.table-item').find('h4').html()
	myStorage.removeItem(btn_name)
	wantList = myStorage.getItem('wantList').split(',')
	wantList = wantList.filter(deleteGoods);
	function deleteGoods(name) {
		return name != btn_name;
	}
	myStorage.setItem('wantList', wantList)
}