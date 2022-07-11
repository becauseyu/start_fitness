<?php 
include('../php/mysqli.php');

//唯一不會被改變的資料，用來當作select條件
$acc = $_REQUEST['up_account'];
$name = $_REQUEST['up_name'];
$tel =$_REQUEST['up_tel'];
// echo "{$name};{$tel};{$email};{$acc}";

//已帳號為條件去更新資料
$sqlRenewData = "UPDATE member SET name='{$name}' ,tel ='{$tel}' WHERE account = '{$acc}'";
$mysqli->query($sqlRenewData);

header("Location:../html/mb_update.php?account={$acc}");



