//實現點取眼睛可以看到密碼
//登入
$("#checkEye").click(function () {
    if ($(this).hasClass('fa-eye-slash')) {
        $("#fg_password").attr('type', 'text');
    } else {
        $("#fg_password").attr('type', 'password');
    }
    $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash');
});
//註冊
$(".checkEye2").click(function () {
    if ($(this).hasClass('fa-eye')) {
        $(".password2").attr('type', 'password');
    } else {
        $(".password2").attr('type', 'text');
    }
    $('.checkEye2').toggleClass('fa-eye').toggleClass('fa-eye-slash');
});

//實現再次確認密碼
$('#fg_password2').on('change',function(){
    var re_password = $('#fg_password').val();
    var re_password2 = $('#fg_password2').val();
    if(re_password == re_password2){
        $('#cor_password2').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
        updateTips('')
        
    }else{
        $('#cor_password2').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
        updateTips('再次輸入密碼錯誤')

    }

})

//=========================註冊驗證區域===========================//
var r_password = $('#fg_password')
var tips = $('#validUpdate')

//檢查密碼
$("#fg_password").on('input', function () {
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
