<?php

include('../php/mysqli.php');

//取得帳號做驗證
$email = $_GET['email'];
$psw =md5($_GET['psw']);

if (isset($email)) {
    //判定帳號密碼是否正確
    $sql = "SELECT * FROM member WHERE email = '{$email}' AND psw = '{$psw}'";
    $result = $mysqli->query($sql);
    //輸出畫面(代表有重複)
    echo $result->num_rows;

}

?>