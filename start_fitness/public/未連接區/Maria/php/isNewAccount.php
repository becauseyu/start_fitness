<?php

include('../php/mysqli.php');

//取得帳號做驗證
$acc = $_GET['account'];

if (isset($acc)) {
    //判定帳號密碼是否正確
    $sql = "SELECT * FROM member WHERE account = '{$acc}'";
    $result = $mysqli->query($sql);
    //輸出畫面(代表有重複)
    echo $result->num_rows;

}

?>