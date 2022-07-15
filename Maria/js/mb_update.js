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

//點選登入/註冊顯示內容及標籤變色
$('#li_update').on('click', function () {
    $('#li_update').addClass('selected')
    $('#li_renewPsw').removeClass('selected')
    $('#li_point').removeClass('selected')
    $('#li_order').removeClass('selected')
    $('#update_form').removeClass('hidden')
    $('#renewPsw_form').addClass('hidden')
    $('#point_form').addClass('hidden')
    $('#order_form').addClass('hidden')

    

})

$('#li_renewPsw').on('click', function () {
    $('#li_update').removeClass('selected')
    $('#li_renewPsw').addClass('selected')
    $('#li_point').removeClass('selected')
    $('#li_order').removeClass('selected')
    $('#update_form').addClass('hidden')
    $('#renewPsw_form').removeClass('hidden')
    $('#point_form').addClass('hidden')
    $('#order_form').addClass('hidden')
})

$('#li_point').on('click', function () {
    $('#li_update').removeClass('selected')
    $('#li_renewPsw').removeClass('selected')
    $('#li_point').addClass('selected')
    $('#li_order').removeClass('selected')
    $('#update_form').addClass('hidden')
    $('#renewPsw_form').addClass('hidden')
    $('#point_form').removeClass('hidden')
    $('#order_form').addClass('hidden')
})

$('#li_order').on('click', function () {
    $('#li_update').removeClass('selected')
    $('#li_renewPsw').removeClass('selected')
    $('#li_point').removeClass('selected')
    $('#li_order').addClass('selected')
    $('#update_form').addClass('hidden')
    $('#renewPsw_form').addClass('hidden')
    $('#point_form').addClass('hidden')
    $('#order_form').removeClass('hidden')
})
//實現點取眼睛可以看到密碼
$(".checkEye2").click(function () {
    if ($(this).hasClass('fa-eye-slash')) {
        $(".password2").attr('type', 'text');
    } else {
        $(".password2").attr('type', 'password');
    }
    $('.checkEye2').toggleClass('fa-eye').toggleClass('fa-eye-slash');
});
//檢查新舊密碼內容是否一樣
$('#up_password').on('input',function(){
    var old_password = $('#old_password').val();
    var new_password = $('#up_password').val();
    if(old_password == new_password){
        $('#cor_password').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
        updateTips('舊密碼與新密碼相同')
        
    }

})

//實現再次確認密碼
$('#new_password2').on('input',function(){
    var re_password = $('#up_password').val();
    var re_password2 = $('#new_password2').val();
    if(re_password == re_password2){
        $('#cor_password2').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
        updateTips('')
        
    }else{
        $('#cor_password2').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
        updateTips('再次輸入密碼錯誤')

    }

})
