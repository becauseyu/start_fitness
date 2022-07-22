
//點選登入/註冊顯示內容及標籤變色
$('#login').on('click', function () {
    $('#login_form').removeClass('hidden')
    $('#login').addClass('selected')
    $('#register_form').addClass('hidden')
    $('#register').removeClass('selected')

})

$('#register').on('click', function () {
    $('#login_form').addClass('hidden')
    $('#login').removeClass('selected')
    $('#register_form').removeClass('hidden')
    $('#register').addClass('selected')
})

$('#change_login').on('click', function () {
    $('#login_form').removeClass('hidden')
    $('#login').addClass('selected')
    $('#register_form').addClass('hidden')
    $('#register').removeClass('selected')
})


//記住我
//頁面初始化時，如果cookie有抓到帳號密碼就先填入
var c_user = $.cookie('user')
var c_password = $.cookie('pswd')
// console.log(user)
if (c_user) {
    $('#lg_account').val(c_user)
    $('#lg_password').val(c_password)
    $("#remember").attr('checked', "checked")
}
//核取方塊勾選狀態發生改變時，如果未勾選則清除cookie
$('#remember').on('change', function () {
    if (!this.checked) {
        $.removeCookie('user');
        $.removeCookie('pswd');
    }
});
//表單提交事件觸發時，如果核取方塊是勾選狀態則儲存cookie
$('form').on('submit', function () {
    var account = $('#lg_account').val()
    var password = $('#lg_password').val()
    if ($("#remember").prop("checked")) {
        //預設存在cookie 15天
        $.cookie('user', account, { expires: 15 });
        $.cookie('pswd', password, { expires: 15 });
    }
});



//實現點取眼睛可以看到密碼
//登入
$("#checkEye").click(function () {
    if ($(this).hasClass('fa-eye-slash')) {
        $("#lg_password").attr('type', 'text');
    } else {
        $("#lg_password").attr('type', 'password');
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
$('#re_password2').on('input',function(){
    var re_password = $('#re_password').val();
    var re_password2 = $('#re_password2').val();
    if(re_password == re_password2){
        $('#cor_password2').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
        updateTips('')
        
    }else{
        $('#cor_password2').html('<i style="color:red" class="fa fa-times-circle" aria-hidden="true"></i>')
        updateTips('再次輸入密碼錯誤')

    }

})


//=========================註冊驗證區域===========================//
var r_account = $("#re_account")
var r_password = $('#re_password')
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

//=========================檢查申請帳號是否重複===========================//

    var xhttp = new XMLHttpRequest();
    //如果當xhttp發生改變時，發生後面的callback(回乎函式) //閉包
    function ckdNewAccount() {
        var account = $('#re_account').val();

        if (!account) {return};

        var psw = $('#old_password').val();
        xhttp.onreadystatechange = function() {
            //200 :畫面載入成功(404是失敗)
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                console.log(xhttp.responseText);
                if (xhttp.responseText != 0) { //帳號無重複 //xhttp.responseText 來自後端
                    $('#message').html('<span style="color:red">✘該帳號已存在</sapn>') 
                } else {
                    $('#message').html('<span style="color:green">✔該帳號可使用</sapn>') 
                }
            }
        };
        //抓輸入的account內容
        //ajax中，打開請求對象，並送入資料
        // console.log('媽，我在HTTPrequest');

        var url = window.location.origin + '/member/login/' + account;

        xhttp.open('GET', url , true);
        //send請求
        xhttp.send();
    }