$('.headerpage').load('/MengYing/大專/LAB/header.html')
$('.footerpage').load('/MengYing/大專/LAB/footer.html')


// 數量條 
$('[data-quantity="plus"]').on('click', function () {
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

	// 當按加時 重新抓數值
	var qty = $(who).val();
	var price = $(this).closest('.table-content').find('.price').val();
	$(this).closest('.table-content').find('.total').html(qty * price);


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


});

//發生事情的按鈕
$('[data-quantity="minus"]').on('click', function () {

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

	// 當按減時 重新抓數值
	var qty = $(who).val();
	var price = $(this).closest('.table-content').find('.price').val();
	$(this).closest('.table-content').find('.total').html(qty * price);

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
	

	// 判斷運費
	if (bigTotal <= 2000) {
		$('.fee').html('NT$60');
		$('.total03').html(bigTotal + 60);
	} else {
		$('.fee').html('免運');
		$('.total03').html(bigTotal);
	};

});









