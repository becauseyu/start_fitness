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
var order_email = $("#order-customer-email")
var order_tel = $('#order-customer-phone')
var del_tel = $('#deliver-customer-phone')
var del_addr = $('#deliver-customer-addr')

//email的認證條件另外放
emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//檢查信箱
$('#order-customer-email').on('input', function () {
    var valid = true;
    tips = $(this).closest('div').find('.vaild_div')
    valid = valid && checkLength(order_email, "電子信箱", 6, 80);
    valid = valid && checkRegexp(order_email, emailRegex, "格式應為abc@defg.com");
    // console.log(valid)
    if (valid === true) {
        tips.removeClass('invalid-feedback')
        tips.addClass('valid-feedback')
        $(this).removeClass('is-invalid')
        $(this).addClass('is-valid')

    } else {
        tips.removeClass('valid-feedback')
        tips.addClass('invalid-feedback')
        $(this).removeClass('is-valid')
        $(this).addClass('is-invalid')
    }

})

//檢查電話
$('#order-customer-phone').on('input', function () {
    var tel = order_tel.val()
    tips = $(this).closest('div').find('.vaild_div')
    //判定是否為手機(09) or (+886) 
    var tel_local = tel.substr(0, 2)
    var tel_foreign = tel.substr(0, 4)
    if (tel_local == '09') {
        if (tel.length == 10) {
            tips.removeClass('invalid-feedback')
            tips.addClass('valid-feedback')
            tips.text('')
            $(this).removeClass('is-invalid')
            $(this).addClass('is-valid')
        }
        else {
            tips.removeClass('valid-feedback')
            tips.addClass('invalid-feedback')
            tips.text('請輸入正確的手機號碼')
            $(this).removeClass('is-valid')
            $(this).addClass('is-invalid')
        }

    } else if (tel_foreign == '+886') {
        if (tel.length == 13 || tel.length == 14) {
            tips.removeClass('invalid-feedback')
            tips.addClass('valid-feedback')
            tips.text('')
            $(this).removeClass('is-invalid')
            $(this).addClass('is-valid')

        } else {
            tips.removeClass('valid-feedback')
            tips.addClass('invalid-feedback')
            tips.text('請輸入正確的手機號碼')
            $(this).removeClass('is-valid')
            $(this).addClass('is-invalid')
        }
    } else {
        tips.removeClass('valid-feedback')
        tips.addClass('invalid-feedback')
        tips.text('請輸入正確的手機號碼')
        $(this).removeClass('is-valid')
        $(this).addClass('is-invalid')

    }
})

$('#deliver-customer-phone').on('input', function () {
    var tel = del_tel.val()
    tips = $(this).closest('div').find('.vaild_div')
    //判定是否為手機(09) or (+886) 
    var tel_local = tel.substr(0, 2)
    var tel_foreign = tel.substr(0, 4)
    if (tel_local == '09') {
        if (tel.length == 10) {
            tips.removeClass('invalid-feedback')
            tips.addClass('valid-feedback')
            tips.text('')
            $(this).removeClass('is-invalid')
            $(this).addClass('is-valid')
        }
        else {
            tips.removeClass('valid-feedback')
            tips.addClass('invalid-feedback')
            tips.text('請輸入正確的手機號碼')
            $(this).removeClass('is-valid')
            $(this).addClass('is-invalid')
        }

    } else if (tel_foreign == '+886') {
        if (tel.length == 13 || tel.length == 14) {
            tips.removeClass('invalid-feedback')
            tips.addClass('valid-feedback')
            tips.text('')
            $(this).removeClass('is-invalid')
            $(this).addClass('is-valid')

        } else {
            tips.removeClass('valid-feedback')
            tips.addClass('invalid-feedback')
            tips.text('請輸入正確的手機號碼')
            $(this).removeClass('is-valid')
            $(this).addClass('is-invalid')
        }
    } else {
        tips.removeClass('valid-feedback')
        tips.addClass('invalid-feedback')
        tips.text('請輸入正確的手機號碼')
        $(this).removeClass('is-valid')
        $(this).addClass('is-invalid')

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

//檢查checkbox是否被勾選
$('#ischecked').on('change', function () {
    if($('#ischecked').prop('checked')=== true){
        $('#ischecked').removeClass('is-invalid')
        $('#ischecked').addClass('is-valid')
    }else{
        $('#ischecked').removeClass('is-valid')
        $('#ischecked').addClass('is-invalid')
    }


})
