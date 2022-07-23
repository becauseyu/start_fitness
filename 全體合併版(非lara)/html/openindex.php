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
   
}else{
    $user = '訪客';
    $url = '';
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>動吃  |   動吃</title>
    <!--加入jquery-->
    <script src="../_js/jquery/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!--加入bootstrap-->
    <link href="../_css/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="../_js/bootstrap/bootstrap.js"></script>
    <!--加入Font Awesome-->
    <script src="https://kit.fontawesome.com/587cbd6750.js" crossorigin="anonymous"></script>
    <!--加入AOS-->
    <link rel="stylesheet" href="../magic/magic.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .index {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(to right,
                    #8EB4E3 0%,
                    #8EB4E3 50%,
                    #FBC65C 50%,
                    #FBC65C 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            position: absolute;

        }

        .logo {
            z-index: 999;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fd {
            position: absolute;
            z-index: 101;
            background: white;
            width: 50%;
            left: 50%;
            top: 0px;
            height: 100%;
            opacity: 0.6;
        }

        .fd:hover {
            opacity: 0;
        }

        .sp {
            position: absolute;
            z-index: 101;
            background: white;
            width: 50%;
            right: 50%;
            top: 0px;
            height: 100%;
            opacity: 0.6;
        }

        .sp:hover {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="row"></div>
    <a href="./sp_idx.php<?php echo $url ;?>">
        <div class="sp "></div>
    </a>
    <a href="./fd_idx.php<?php echo $url ;?>">
        <div class="fd "></div>
    </a>
    <div class="index "><img src="../img/LOGO.png" height="300vh" alt=""></div>
    <img class="logo" src="../img/LOGO.png" height="300vh">


</body>

</html>