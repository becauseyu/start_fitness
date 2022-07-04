<meta charset="UTC-8">
<?php
include('./mysqli.php');


if (isset($_REQUEST['resName'])) {
    $name = $_REQUEST['resName'];
    $tel = $_REQUEST['resTel'];
    $gym = $_REQUEST['resGym'];
    //用健身房名稱抓現在數量
    $sqlCount = "SELECT name,res FROM `taichung_gym` WHERE name = '{$gym}' ";
    // $hasGym = $result->num_rows; //傳回select語句後的筆數結果，之後可以做判斷
    $result = $mysqli->query($sqlCount);
    $row = $result->fetch_array();

    // echo " {$row['res']} "; //得到現在的數量;
    $count = $row['res'];
    $count--;
    
    //每次預約後數量-1並更新
    $sqlMinus = "UPDATE `taichung_gym` SET res = '{$count}'  WHERE name = '{$gym}'";
    $result2 = $mysqli->query($sqlMinus);
    echo 'ok';

    //傳入訂單資料
    // $sqlRes = "INSERT INTO taichung_gym(name,tel,email,gym,date,time) VALUES ('{$name}','{$tel}','{$email}','{$gym}','{$date}','{$time}')";

    header('Location:gym_map.php');

} 
?>