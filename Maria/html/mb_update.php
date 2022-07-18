<?php

include_once('../php/mysqli.php');

//確認是否為會員
if (isset($_REQUEST['mid'])) {
    //從網址得到會員帳號
    $mid = $_REQUEST['mid'];
    $psw = $_REQUEST['psw'];
    //找出所有會員的資料放進去
    $sql_data = "SELECT * FROM member WHERE mid = '{$mid}' AND psw = '{$psw}'";
    $result = $mysqli->query($sql_data);
    $data = $result->fetch_array();
    //抓全部的東西出來
    $acc = $data['account'];
    $pws = $data['psw'];
    $email = $data['email'];
    $status = $data['staId'];
    if ($status == 2) {
        $status = '一般會員';
    } else if ($status == 3) {
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

    //放入訂單資訊
    $sql_order = "SELECT oid,mid,orderdate,payment,deliver FROM `memberorder` INNER JOIN payment ON memberorder.paid = payment.paid INNER JOIN deliver on memberorder.did = deliver.did ;";
    $result_order = $mysqli->query($sql_order);
    //確認訂單是否為空白
    $check = $result_order->num_rows;
    if ($check = 0) {
        die();
    }
} else {
    header("Location:/Maria/html/mb_login.php");
}

$start = 1 ;

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    <div class='headerpage'>
        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="/MengYing/大專/AI/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7" aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-1"></div>
                <ul class="navbar-nav mx-auto nav-justif justify-content-around " style="align-items: end;">
                    <li class="nav-iteml px-1">
                        <a class="nav-link " href="#">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1">
                        <a class="nav-link" href="#">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1">
                        <a class="nav-link" href="#">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="/MengYing/大專/AI/LOGO.png"></a>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-1 d-flex justify-content-end">
                    <button class="btn ">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-cart" data-toggle="dropdown" onclick="openbuycar()">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                    </button>
                </div>
            </div>
        </nav>
    </div>
    <div id="content" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-tabset">
                        <ul class="nav nav-tabs">
                            <li class="nav-li selected" id="li_update">修改會員資料</li>
                            <li class="nav-li" id="li_renewPsw">修改密碼</li>
                            <!-- <li class="nav-li" id="li_point">會員購物金</li> -->
                            <li class="nav-li" id="li_order">訂單管理</li>

                        </ul>
                        <form id='update_form' class="m-5 hidden" action="../php/updateData.php?mid=<?php echo $mid ?>" method="post">
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
                                <input id="up_tel" name="up_tel" type="text" class="form-control ml-5 mr-5" value="<?php echo $tel2; ?>" placeholder="<?php echo $tel; ?>" aria-label="Username" aria-describedby="basic-addon1">
                                <span id='cor_tel' class="confirmSpan"></span>
                            </div>
                            <div class="input-group mb-3">
                                <span>信箱：</span>
                                <input id="up_email" name="fg_email" type="text" class="form-control ml-5 mr-5" value="<?php echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1" disabled>
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
                                <input id="old_password" name="old_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="舊密碼" aria-label="Password" aria-describedby="basic-addon1" required onchange=confirmPsw()>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='old_password' class="confirmSpan"></span>
                            </div>
                            <span class="memo ml-5 mt-2 ">*請輸入6~16位英數字組合而成的密碼，請至少含一個英文大寫*</span>
                            <div class="input-group mb-1">
                                <input id="up_password" name="fg_password" type="text" class="password2 form-control ml-5 mr-5" placeholder="新密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password' class="confirmSpan"></span>

                            </div>
                            <div class="input-group mb-3 ">
                                <input id="new_password2" name="new_password2" type="text" class="password2 form-control ml-5 mr-5" placeholder="請再次輸入新密碼" aria-label="Password" aria-describedby="basic-addon1" required>
                                <i class="checkEye2 fas fa-eye"></i>
                                <span id='cor_password2' class="confirmSpan"></span>
                            </div>
                            <input id="fg_email" name="fg_email" type="text" class="form-control ml-5 mr-5 hidden" value="<?php echo $email; ?>" aria-label="Username" aria-describedby="basic-addon1">
                            <div class="input-group mb-3">
                                <input class='btn-block ml-5 mr-5 btn btn-success' type="submit" value="更新密碼">
                            </div>
                        </form>
                        <!-- <form id='point_form' class="m-5 hidden" action="../php/updateData.php" method="post">
                            購物金
                        </form> -->
                        <form id='order_form' class="m-2 " action="../php/updateData.php" method="post">
                            訂單時間<input type="date" class="m-2" />至<input type="date" class="m-2" /><span class="memo">請輸入欲查詢的區間，訂單效期為6個月</span>
                            <table align="center" class="table order_tb">
                                <tr>
                                    <th scope="col">訂單編號</th>
                                    <th scope="col">下單時間</th>
                                    <th scope="col">配送方式</th>
                                    <th scope="col">付款方式</th>
                                    <th scope="col">訂單金額</th>
                                </tr>
                            </table>
                            <?php
                            while ($order = $result_order->fetch_array()) {
                                $start ++;
                                echo '<div class="accordion" id="accordionExample">';
                                echo    '<div class="card">';
                                echo        '<div class="card-header" id="heading'.$start.'">';
                                echo            '<h2 class="mb-0">';
                                echo                '<button class="btn " type="button" data-toggle="collapse" data-target="#collapse'.$start.'" aria-expanded="true" aria-controls="collapse'.$start.'">';
                                echo '<table class="table order_tb">';
                                echo "<tr>";
                                //把訂單時間處理一下
                                $datetime = $order['orderdate'];
                                $date = (mb_split('\s', $datetime))[0];
                                $a = (mb_split('-', $date));
                                $date = "{$a[0]}{$a[1]}{$a[2]}";
                                echo "<td scope='row'>{$date}00{$order['oid']}</td>";
                                echo "<td scope='row'>{$order['orderdate']}</td>";
                                echo "<td scope='row'>{$order['deliver']}</td>";
                                echo "<td scope='row'>{$order['payment']}</td>";
                                echo "<td scope='row'>1200</td>";
                                echo "</tr>";
                                echo '</table>';
                                echo                '</button>';
                                echo           ' </h2>';
                                echo       ' </div>';
                                echo        '<div id="collapse'.$start.'" class="collapse" aria-labelledby="heading'.$start.'" data-parent="#accordionExample">';
                                echo            '<div class="card-body">';
                                echo            '</div>';
                                echo       ' </div>';
                                echo    '</div>';
                                echo '</div>';
                            }
                            ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 購物車-->
    <div id="slide_buycart">
        <i class="fa-solid fa-circle-xmark" onclick="closebuycar()"></i>
        <div id='slide_buycart_title' class="slide_buycart_title">
            　|您的購物清單|
        </div>
        <div id='slide_buycart_content' class="slide_buycart_content">
            <nav id='slide_buycart_goods'></nav>
        </div>

        <div id='slide_buycart_bottom' class="slide_buycart_bottom">
            <hr>
            <p id="totalCount" class="hide">0</p>
            <p class="slide_buycart_total">總計 NT$<span id="slide_buycart_accounttotal">0</span></p>
            <a href="/Eva/buycart/payment_01.php?mid=<?php echo $mid; ?>&password=<?php echo $psw; ?>"><button id="slide_buycart_bottom_btn">立即結帳</button></a>


        </div>

    </div>
    <!-- 頁尾 -->
    <div class='footerpage'>

    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/mb_update.js"></script>


</html>