<?php 
include('../php/mysqli.php');

//唯一不會被改變的資料，用來當作select條件
$mid = $_REQUEST['mid'];
$name = $_REQUEST['up_name'];
$tel =$_REQUEST['up_tel'];
// echo "{$name};{$tel};{$mid}";
//找回密碼
$sql_match="SELECT psw FROM member WHERE mid='{$mid}'";
$result= $mysqli->query($sql_match);
$row = $result->fetch_array();
$psw = $row['psw'];


//已帳號為條件去更新資料
$sqlRenewData = "UPDATE member SET name='{$name}' ,tel ='{$tel}' WHERE mid = '{$mid}'";
$mysqli->query($sqlRenewData);

header("Location:../html/mb_update.php?mid={$mid}&psw={$psw}");
?>





