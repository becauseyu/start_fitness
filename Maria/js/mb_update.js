//=========================註冊驗證區域===========================//
var u_password = $('#up_password')
var u_email = $("#up_email")
var u_tel = $("#up_tel")
var tips = $('.validUpdate')

//email的認證條件另外放
emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//檢查密碼
$("#up_password").on('input', function () {
    var valid = true;
    valid = valid && checkLength(u_password, "密碼", 6, 16);
    valid = valid && checkRegexp(u_password, /^(?=.*[A-Z])/, "請至少含一個大寫英文字母");
    valid = valid && checkRegexp(u_password, /^([0-9a-zA-Z])+$/, "密碼僅能使用英文或數字");
    if (valid === true) {
        $('#cor_password').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    } else {
        $('#cor_password').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
    }

})

//檢查電話
$("#up_tel").on('input', function () {
    var valid = true;
    valid = valid && checkRegexp( u_tel, /09\d{8}/, "請輸入正確的手機號碼" );
    console.log(valid)
    if (valid === true) {
        $('#cor_tel').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    } else {
        $('#cor_tel').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
    }

})

//檢查email
$("#up_email").on('input', function () {
    var valid = true;
    valid = valid && checkLength( u_email, "電子信箱", 6, 80 );
    valid = valid && checkRegexp( u_email, emailRegex, "格式應為abc@defg.com" );
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

