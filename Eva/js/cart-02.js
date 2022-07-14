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

//------------------驗證內容-----------------------------//
var r_name = $('#re_name')
var r_email = $("#re_email")
var tips = $('#validUpdate')
//email的認證條件另外放
emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//檢查帳號
$("#re_account").on('input', function () {
    var valid = true;
    valid = valid && checkLength(r_account, "帳號", 6, 16);
    valid = valid && checkRegexp(r_account, /^([0-9a-zA-Z])+$/, "帳號僅能使用英文或數字");
    console.log(valid)
    if (valid === true) {
        $('#cor_account').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    } else {
        $('#cor_account').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
    }

})

//檢查密碼
$("#re_password").on('input', function () {
    var valid = true;
    valid = valid && checkLength(r_password, "密碼", 6, 16);
    valid = valid && checkRegexp(r_password, /^(?=.*[A-Z])/, "請至少含一個大寫英文字母");
    valid = valid && checkRegexp(r_password, /^([0-9a-zA-Z])+$/, "密碼僅能使用英文或數字");
    if (valid === true) {
        $('#cor_password').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    } else {
        $('#cor_password').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
    }

})

//檢查email
$("#re_email").on('input', function () {
    var valid = true;
    valid = valid && checkLength( r_email, "電子信箱", 6, 80 );
    valid = valid && checkRegexp( r_email, emailRegex, "格式應為abc@defg.com" );
    console.log(valid)
    if (valid === true) {
        $('#cor_email').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    } else {
        $('#cor_email').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
    }

})


//加入錯誤提示文字
function updateTips(t) { 
    tips.text(t);
}

//檢查字串長度
function checkLength(o, n, min, max) { //物件,物件名稱,長度範圍
    if (o.val().length > max || o.val().length < min) {
        updateTips(n + "輸入內容必須符合" + min + " 到 " + max + "字元");
        return false;
    } else {
        updateTips('');
        return true;
    }
}

//檢查拼字
function checkRegexp(o, regexp, n) { //物件,規則,名字
    if (!(regexp.test(o.val()))) {
        updateTips(n)
        return false;
    } else {
        updateTips('')
        return true;
    }
}
//input
//is-invalid =>bootstrap的驗證樣式(不通過)
//is-valid =>bootstrap的驗證樣式(通過)
//span
//invalid-feedback =>bootstrap的驗證樣式(不通過)
//valid-feedback =>bootstrap的驗證樣式(通過)

//實現勾選同意轉換顏色
$('input[type=checkbox]').trigger('click'); 
