<?php

include_once('../php/mysqli.php');

//從網址得到會員帳號
$acc = $_REQUEST['account'];
$psw = $_REQUEST['psw'];


//找出所有會員的資料放進去
$sql = "SELECT * FROM member WHERE account = '{$acc}' AND psw = '{$psw}'";
$result = $mysqli->query($sql);
$data = $result->fetch_array();
//抓全部的東西出來
$acc = $data['account'];
$pws = $data['psw'];
$email = $data['email'];
$status = $data['staId'];
if ($status == 1) {
    $status = '一般會員';
} else if ($status == 2) {
    $status = '管理員';
}
$tel = $data['tel'];
//還沒解決tel的放入 0710
if ($tel == '') {
    //如果手機尚未設定，文字丟在placeholder
    $tel = '新增您的手機號碼 ex:0912345678';
    $tel2 = '';
} else {
    //如果有存在，內容會放value
    $tel2 = $tel;
    $tel = '';
    // echo $tel;
    // echo $te2;
}
$name = $data['name'];
$point = $data['point'];

// echo "{$acc};{$pws};{$status};{$name};{$point}";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--加入jquery-->
    <script src="../js/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入bootstrap-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!-- 頁首頁尾的css -->
    <link href="/MengYing/大專/_css/head.css" rel="stylesheet">
    <!-- 插入自己的css -->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/mb_update.css" rel="stylesheet">




    <title>修改會員資料</title>
    <style>

    </style>

</head>

<body>
    <!-- 頁首  -->
    <div class="headerpage">
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <ul class="nav nav-tabs">
                            <li class="nav-li selected" id="li_update">修改會員資料</li>
                            <li class="nav-li" id="li_renewPsw">修改密碼</li>
                            <li class="nav-li" id="li_point">會員購物金</li>
                            <li class="nav-li" id="li_order">訂單管理</li>

                        </ul>
                        <form id='update_form' class="m-5" action="../php/updateData.php" method="post">
                            <p align="left"><i class="fa fa-id-card-o" aria-hidden="true"></i>
                                <span id="who"><?php echo $acc; ?></span>
                                <span class='mb_status'><?php echo $status; ?></span>
                            </p>
                            <p align="left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                修改會員資料：
                            </p>
                            <p class="validUpdate"></p>
                            <div class="input-group mb-3">
                                <span>姓名：</span>
                                <input id="up_name" name="up_name" type="text" class="form-control ml-5 mr-5" value="<?php echo $name; ?>" aria-label="Username" aria-describedby="basic-addon1" required>
                                <span id='cor_name' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <span>手機：</span>
                                <input id="up_tel" name="up_tel" type="text" class="form-control ml-5 mr-5" value="<?php echo $tel2; ?>" placeholder="<?php echo $tel; ?>" aria-label="Username" aria-describedby="basic-addon1" >
                                <span id='cor_tel' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <span>信箱：</span>
                                <input id="up_email" name="fg_email" type="text" class="form-control ml-5 mr-5" value="<?php echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1"  disabled>
                                <span id='cor_email' class="confirmSpan"></span>
                                <input name="up_account" type="text" class="hidden" value="<?php echo $acc; ?>">

                            </div>

                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="修改會員資料">
                            </div>
                        </form>
                        <form id='renewPsw_form' class="m-5 hidden" action="../php/updatePsw.php" method="post">
                        <p align="left"><i class="fa fa-key" aria-hidden="true"></i>
                        修改密碼
                        </p>
                        <p class="validUpdate"></p>
                        <div class="input-group mb-3 ">
                                <input id="old_password" name="old_password" type="text"
                                    class="password2 form-control ml-5 mr-5" placeholder="舊密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required onchange= confirmPsw()>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='old_password' class="confirmSpan"></span>
                            </div>
                        <p id="message"></p>
                        <span class="memo ml-5 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>
                            <div class="input-group mb-1">
                                <input id="up_password" name="fg_password" type="text"
                                    class="password2 form-control ml-5 mr-5" placeholder="新密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password' class="confirmSpan"></span>

                            </div>
                            <div class="input-group mb-3 ">
                                <input id="new_password2" name="new_password2" type="text"
                                    class="password2 form-control ml-5 mr-5" placeholder="請再次輸入新密碼" aria-label="Password"
                                    aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password2' class="confirmSpan"></span>
                            </div>
                            <input id="fg_email" name="fg_email" type="text" class="form-control ml-5 mr-5 hidden" value="<?php echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1"  >
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="更新密碼">
                            </div>
                        </form>
                        <form id='point_form' class="m-5 hidden" action="../php/updateData.php" method="post">
                        購物金
                        </form>
                        <form id='order_form' class="m-5 hidden" action="../php/updateData.php" method="post">
                        訂單管理
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 頁尾 -->
    <div class='footerpage'>

    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/mb_update.js"></script>


</html>