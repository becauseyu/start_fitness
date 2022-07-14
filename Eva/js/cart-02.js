$('.footerpage').load('/MengYing/大專/LAB/footer.html')
//把localStorage放進內容
//確認localStorage是否有東西
var myStorage = localStorage
goodstList = myStorage.getItem('wantList') //得到目前有被放進購物車的物品清單
//------------------如果wantList是空值，直接清空localStorage-----------------------------//
if (goodstList == '') {
	myStorage.clear()
}

//在購物車icon放入數量
var count = myStorage.getItem('cartQuantity')
$('#cartQuantity').html(count)