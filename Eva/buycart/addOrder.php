<?php
include('/start_fitness/Maria/php/mysqli.php');

$oid = $_GET['oid'];
$name = $_GET['name'];
$count = $_GET['count'];
$style = $_GET['style'];

//先找到pid
$sql_pid = "SELECT pid FROM goodsdetail WHERE pname ='{$name}' AND pstyle = '{$style}' ";
$result = $mysqli->query($sql_pid);
$row = $result->fetch_array();
$pid= $row['pid'];

//更新訂單明細
$sql_update = "INSERT INTO orderdetail(pid,oid,amount) VALUES ('$pid','$oid','$count')";
$mysqli->query($sql_update);

?>
