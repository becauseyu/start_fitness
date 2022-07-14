<?php 
include('./mysqli.php');

//將JSON放入資料庫
$JSON=file_get_contents('../JSON/goods_list.JSON');
//將JSON轉為 true:陣列 // fales:物件
$data1 = json_decode($JSON,true);
// var_dump($data1);
$data2 = json_decode($JSON,false);
// var_dump($data2);

$sql="INSERT INTO goodsdetail(ptype,bid,pstyle,pname,pcount,ppic,pprice) 
        VALUES (?,?,?,?,?,?,?)";

$count='100';


foreach($data2 as $row){
    $sql_brand = "SELECT bid FROM branddetail WHERE bname = '{$row->brand}'";
    $result = $mysqli->query($sql_brand);
    $data =  $result->fetch_array(); //確認是否有符合的
    $stmt = $mysqli ->prepare($sql);
    $stmt ->bind_param('sssssss',$row->type,$data['bid'],$row->style,$row->name,$count,$row->picture,$row->price);
    //execute() 執行準備好的語句(prepare + parm)
    $stmt->execute();
    };
?>