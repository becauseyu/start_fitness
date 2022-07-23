<?php

include('./mysqli.php');

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
    $user = '';
    $url = "?mid={$mid}&psw={$psw}";
    $memberPage = "./mb_update.php?mid={$mid}}&psw={$psw}";
} else {
    $user = '訪客';
    $url = '';
    $memberPage = "./mb_login.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>健身地圖與inbody預約 | 動吃動吃</title>
    <!--加入leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <!--加入leaflet js(一定要在css之後)-->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <!--加入bootstrap-->
    <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../_js/bootstrap/bootstrap.js"></script>
    <!--加入jquery-->
    <script src="../_js/jquery/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入jQuery ui(dialog)-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!--加入AOS-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- 插入自己的css -->
    <link rel="stylesheet" href="../_css/main.css">
    <link rel="stylesheet" href="../_css/gym_map.css">
    <!-- 插入favicon -->
    <link rel="icon" href="../img/favico.ico" type="image/x-icon">

</head>

<body>
    <!-- 頁首  -->
    <div class="headerpage">
        <nav class="fixed-top  navbar navbar-expand-lg navbar-light " style="background-color: #E5D9CE;">
            <a class="navbar-brand d-lg-none" href="#"><img width="60" height="60" style="display:block; margin:auto;" src="../img/LOGO.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbarToggler7" aria-controls="myNavbarToggler7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse mx-auto row " id="myNavbarToggler7">
                <div class=" col-2 col-sm-2 ">　</div>
                <ul class="navbar-nav  nav-justif justify-content-around col-8 col-sm-8  " style="align-items: end;">
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link " href="./sp_introduce.php<?php echo $url; ?>">運動Tip</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url; ?>">健身小物</a>
                    </li>
                    <li class="nav-iteml px-1 mx-auto">
                        <a class="nav-link" href="./gym_map.php<?php echo $url; ?>">健身地圖</a>
                    </li>
                    <a class="d-none d-lg-block px-4" href="./openindex.php<?php echo $url; ?>"><img width="60" height="60" style="display:block; margin:auto;" src="../img/LOGO.png"></a>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./fd_introduce.php<?php echo $url; ?>">飲食Tip</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="./goods_index.php<?php echo $url; ?>">飲食小食</a>
                    </li>
                    <li class="nav-itemr px-1 mx-auto">
                        <a class="nav-link" href="#">Mini game</a>
                    </li>
                </ul>
                <div class=" col-2 col-sm-2 d-flex justify-content-end ">
                    <a href="<?php echo $memberPage; ?>">
                        <button type="button" class="btn ">
                            <i class="fa fa-user navbar_fa" aria-hidden="true"> <span id='user' style="color: #495057"><?php echo $user; ?></span> </i>
                        </button>
                    </a>

                    <a href="./payment_01.php<?php echo $url; ?>">
                        <button type="button" class="btn btn-cart">
                            <i class="fa fa-shopping-cart navbar_fa" aria-hidden="true"></i>
                            <span id="cartQuantity" class="badge badge-pill badge-danger">0</span>
                        </button>
                    </a>
                    <a id='userlogout' style="color:black" href="./mb_logout.php">
                        <button type="button" class="btn" title="登出">
                            <i class="fa fa-sign-out navbar_fa" aria-hidden="true"></i>
                        </button>
                    </a>

                </div>
            </div>
        </nav>

    </div>


    <!-- 地圖的放置位置 -->
    <div id="content">
        <div class="row m-5">
            <div class="col table-responsive" id="gym_data">
                <h2>健身地圖</h2>
                <div class="areaList">
                    <select class=' mb-3' aria-label=".form-select-lg example">
                        <option disabled selected>請選擇所在縣市</option>
                        <option selected>台中市</option>
                    </select>
                    <select name="" id="" class="townList  mb-3">
                    </select><br />
                    <select name="" id="" class="gymList mb-3">
                    </select>
                </div>
                <table border="2px" class='gym_table'>
                    <tr>
                        <th class='gymTitle' colspan="2"></th>
                    </tr>
                    <tr>
                        <td colspan="2"><img class="gympic" src=''></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">地址：</td>
                        <td class='gymaddr'></td>
                    </tr>
                    <tr>
                        <td>電話：</td>
                        <td class='gymtel'></td>
                    </tr>
                    <tr>
                        <td>營業時間</td>
                        <td class='gymopen'></td>
                    </tr>
                    <tr>
                        <td>介紹：</td>

                        <td class='gymintr' style='text-align: left'></td>
                    </tr>
                </table>
                <div class='inbody'>

                </div>
            </div>
            <div class="col">

                <div class="intrMark" align='left'>
                    inbody預約的剩餘數量：
                    <img class='markicon' src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png'>31以上
                    <img class='markicon' src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png'>16~30
                    <img class='markicon' src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png'>1~15
                    <img class='markicon' src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png'>0
                </div>

                <div id="mapid"></div>

            </div>

        </div>
    </div>
    <!-- 頁尾 -->
    <div class='footerpage'>
    </div>
    <!----------------------------------Dialog area-------------------------------------------->
    <div id="dialog_div" title="立即預約您的inbody檢測!！">
        <form method="post" id='inbodyRes' action="../php/inbody.php">
            <span class="con_title">您欲預約的健身房:</span>
            <br />
            <input id='resGym' type='text' class='form-control' disabled></input>
            <input id='resGym2' name='resGym' type='text' class='form-control hidden'></input>
            <span class="con_title">尚可預約數量:</span><span id='resCount'> 0 </span>
            <hr>
            <span class="con_title">
                <label for='resName'>
                    預約大名（真實姓名）：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_name'></span>
            </span>
            <br />
            <input required id='resName' name='resName' type="text" class='form-control'>
            <span class="con_title">
                <label for='restel'>
                    聯絡電話(僅供手機)：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_tel'></span>
            </span>
            <input required id='resTel' name='resTel' type="text" class='form-control'>
            <span class="con_title">
                <label for='resEmail'>
                    聯絡信箱：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_email'></span>
            </span>
            <input required id='resEmail' name='resEmail' type="email" class='form-control'>
            <span class="con_title"><label for='resDate'>預約日期</label><span class='memo'>*必填</span></span>
            <input id='resDate' name='resDate' type="date">
            <br />
            <span class="con_title"><label for='resTime'>預約時段</label><span class='memo'>*必填</span></span>
            <select id='resTime' name='resTime' value='0'>
                <option value="0" disabled selected>請選擇時段</option>
            </select>
            <br />
            <input type="submit" value="送出">
        </form>


    </div>


</body>

<?php
include('../php/mysqli.php');
$sql = "SELECT * FROM taichung_gym";
$result = $mysqli->query($sql); //傳回物件

$data = [];
$i = 0;
while ($row = $result->fetch_object()) { //將資料轉為物件後，丟到data陣列裡
    $data[$i] = $row;
    $i++;
}

//設定初始值(以後從這裡改即可)
$center = "SELECT * FROM taichung_gym WHERE name = 'Anytime Fitness 台中公益店'  ";
$resCenter = $mysqli->query($center); //傳回物件
$rowCenter = $resCenter->fetch_object();

?>
<script src="../js/main.js"></script>
<script>
    //將php匯出的資料先以JSON傳送

    //全部data
    var data = '<?php echo json_encode($data); ?>'
    dataList = JSON.parse(data);
    // console.log(dataList) //得到陣列資料

    //初始值data(之後可以連動map與table資料)
    var center = '<?php echo json_encode($rowCenter); ?>'
    centerList = JSON.parse(center)
    // console.log(centerList) //得到物件
</script>
<script src="../_js/main.js"></script>
<script src="../_js/gym_map.js"></script>


</html>