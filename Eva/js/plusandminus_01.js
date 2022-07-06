


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

	//總金額
	//(1)找到欄位:
	//(2)裡面的每一個(轉成數字整數),加入到總額裡面


	$('#car div').find('total').each(function (idx, elm) {
	alert(`1: ${total.value}`);
	alert(`2: ${elm.innerText}`);

		if (elm.innerText.length == 0) {
			elm.innerText = 0;
		}
		total.value = parseInt(total.value) + parseInt(elm.innerText);
	})



	


});

// 當輸入事件發生
// 抓到 輸入的值 與 小計
$('.qty').on('change', function () {

	var price = $(this).closest('.table-content').find('.price').val();
	var qty = $(this).val();

	$(this).closest('.table-content').find('.total').html(qty * price);
	// console.log(qty);
	// console.log(price);




});



	// total.value = 0;
	// $('#car').find('.total').each(function (idx, elm) {
	// 	console.log(`1: ${total.value}`);
	// 	console.log(`2: ${elm.innerText}`);
	// 	// if (elm.innerText.length == 0) {
	// 	// 	elm.innerText = 0;
	// 	// }
	// 	// total3.value = parseInt(total3.value) + parseInt(elm.innerText);
	// })














