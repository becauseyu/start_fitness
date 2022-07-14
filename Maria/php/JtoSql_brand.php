<?php 
include('./mysqli.php');

//將JSON放入資料庫
$JSON=file_get_contents('../JSON/goods_list.JSON');

$data2 = json_decode($JSON,false);
// var_dump($data2);

//把JSON加到 brandDetail
$sql="INSERT INTO branddetail(bname) 
        VALUES (?,?,?,?,?,?,?)";



?>