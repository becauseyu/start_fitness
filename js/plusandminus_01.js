

$(function () {
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

	});


	// 當輸入事件發生
	// 抓到 輸入的值 與合計
	$('#qty').on('change', function () {

		var price = $('#qty').closest('.table-content').find('.price').val();
		var qty = $(this).val();
		$(this).closest('.table-content').find('.total').html(qty * price);

		console.log(qty);
		console.log(price);

	});

});












