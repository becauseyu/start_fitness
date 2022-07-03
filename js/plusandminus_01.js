
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

