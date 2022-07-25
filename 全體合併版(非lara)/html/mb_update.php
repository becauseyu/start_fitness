<?php

include_once('../php/mysqli.php');

//確認是否為會員
if (isset($_REQUEST['mid']) && $_REQUEST['psw']) {
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
    $sql_order = "SELECT * FROM `memberorder` INNER JOIN payment ON memberorder.paid = payment.paid INNER JOIN deliver on memberorder.did = deliver.did WHERE mid='{$mid}' ;";
    $result_order = $mysqli->query($sql_order);
    //確認訂單是否為空白
    $check = $result_order->num_rows;
    if ($check = 0) {
        die();
    }

    //填入導覽頁資料
    $user = '';
    $url = "?mid={$mid}&psw={$psw}";
} else {
    header("Location:./mb_login.php");
}

$start = 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員資料 | 動吃動吃</title>
    <!--加入jquery-->
    <script src="../_js/jquery/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <!--加入bootstrap-->
    <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../_js/bootstrap/bootstrap.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!-- 插入自己的css -->
    <link rel="stylesheet" href="../_css/main.css">
    <link rel="stylesheet" href="../_css/mb_update.css">
    <!-- 插入favicon -->
    <link rel="icon" href="../img/favico.ico" type="image/x-icon">


</head>

<body>
    <!-- 頁首  -->
    <div class="headerpage">
        <nav class="fixed-top  navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;"
                    src="../img/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7"
                aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-2 col-sm-2 ">　</div>
                <ul class="navbar-nav  nav-justif justify-content-around col-8 col-sm-8  " style="align-items: end;">
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link " href="./sp_introduce.php<?php echo $url ;?>">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url ;?>">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./gym_map.php<?php echo $url ;?>">預約地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="./openindex.php<?php echo $url ;?>"><img width="60" height="60"
                            style="display:block; margin:auto;" src="../img/LOGO.png"></a>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./fd_introduce.php<?php echo $url ;?>">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url ;?>">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-2 col-sm-2 d-flex justify-content-end ">
                    <a href="#">
                        <button type="button" class="btn ">
                            <i class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user ;?></span> </i>
                        </button>
                    </a>

                    <a href="./payment_01.php?<?php echo $url; ?>" >
                        <button type="button" class="btn btn-cart">
                            <i class="fa fa-shopping-cart navbar_fa" aria-hidden="true"></i>
                            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                        </button>
                    </a>
                    <a id='userlogout'style="color:black" href="./mb_logout.php">
                    <button type="button" class="btn" title="登出">
                        <i class="fa fa-sign-out navbar_fa" aria-hidden="true"></i>
                    </button>
                    </a>

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
                        <form id='update_form' class="m-5" action="../php/updateData.php?mid=<?php echo $mid ?>" method="post">
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
                        <form id='order_form' class="m-3 hidden " action="../php/updateData.php" method="post">
                            <!-- 訂單時間<input type="date" class="m-2" />至<input type="date" class="m-2" />
                            <input type="button" value="搜尋">
                            <i class="fa fa-search" aria-hidden="true"></i><span class="memo">請輸入欲查詢的區間，訂單效期為6個月</span> -->
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
                                $start++;
                                echo '<div class="accordion" id="accordionExample">';
                                echo    '<div class="card">';
                                echo        '<div class="card-header order_tr" id="heading' . $start . '">';
                                echo                '<div class="" data-toggle="collapse" data-target="#collapse' . $start . '" aria-expanded="true" aria-controls="collapse' . $start . '">';
                                echo '<table class="order_data" >';
                                echo "<tr>";
                                //把訂單時間處理一下
                                $datetime = $order['orderdate'];
                                $date = (mb_split('\s', $datetime))[0];
                                $a = (mb_split('-', $date));
                                $date = "{$a[0]}{$a[1]}{$a[2]}";
                                echo "<td >{$date}00{$order['oid']}</td>";
                                echo "<td >{$order['orderdate']}</td>";
                                echo "<td>{$order['deliver']}</td>";
                                echo "<td >{$order['payment']}</td>";
                                echo "<td >$<span class='total_per'>{$order['total']}</sapn></td>";
                                echo "</tr>";
                                echo '</table>';
                                echo                '</div>';
                                echo       ' </div>';
                                echo        '<div id="collapse' . $start . '" class="collapse" aria-labelledby="heading' . $start . '" data-parent="#accordionExample">';
                                echo            '<div class="card-body">';
                                echo '<table class="table order_data " border="1px">';
                                echo '<tr>';
                                echo "<td colspan='2'>收件人大名</td>";
                                echo "<td colspan='3'>{$order['delName']}</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td colspan='2'>收件人電話</td>";
                                echo "<td colspan='3'>{$order['delTel']}</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td colspan='2'>收件人地址</td>";
                                echo "<td colspan='3'>{$order['delAddr']}</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo '<th scope="col">產品圖示</th>';
                                echo '<th scope="col">產品名稱</th>';
                                echo '<th scope="col">產品單價</th>';
                                echo ' <th scope="col">購買數量</th>';
                                echo '<th scope="col">小計</th>';
                                echo ' </tr>';
                                //依照訂單編號找到對應的產品
                                $sql_detail = "SELECT * FROM orderdetail INNER JOIN goodsdetail ON orderdetail.pid = goodsdetail.pid WHERE oid={$order['oid']}";
                                $result_detail = $mysqli->query($sql_detail);
                                //把結果變成li
                                while ($orderDetail = $result_detail->fetch_object()) {
                                    echo '<tr>';
                                    echo "<td><img class='detail_img' src='../img/{$orderDetail->ptype}/{$orderDetail->ppic}' /></td>";
                                    echo "<td>{$orderDetail->pname}-<br/>{$orderDetail->pstyle}</td>";
                                    echo "<td>{$orderDetail->pprice}</td>";
                                    echo "<td>{$orderDetail->amount}</td>";
                                    $total = ($orderDetail->pprice) * ($orderDetail->amount);
                                    echo "<td>$ {$total}</td>";
                                    echo '</tr>';
                                }
                                echo '</table>';
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
<script src="../_js/main.js"></script>
<script src="../_js/mb_update.js"></script>


</html>