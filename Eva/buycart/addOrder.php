<?php
include('./mysqli.php');

$oid = $_GET['oid'];
$name = $_GET['name'];
$count = $_GET['count'];
$style = $_GET['style'];
$total = $_GET['total'];

// echo $oid.'<br/>'.$name.'<br/>'.$count.'<br/>'.$style.'<br/>'.$total;

// //先找到pid
$sql_pid = "SELECT pid FROM goodsdetail WHERE pname ='{$name}' AND pstyle = '{$style}' ";
$result = $mysqli->query($sql_pid);
$row = $result->fetch_array();
$pid= $row['pid'];
// echo $pid;

//更新訂單明細
$sql_update = "INSERT INTO orderdetail(pid,oid,amount) VALUES ('$pid','$oid','$count')";
$mysqli->query($sql_update);

//更新訂單總金額
$sql_total = "UPDATE memberorder SET total = '{$total}' WHERE oid ='{$oid}' ";
$mysqli->query($sql_total);

?>
