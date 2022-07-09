<?php 
include('./mysqli.php');

//將JSON放入資料庫
$JSON=file_get_contents('./JSON/taichung_gym.JSON');
//將JSON轉為 true:陣列 // fales:物件
$data1 = json_decode($JSON,true);
// var_dump($data1);
$data2 = json_decode($JSON,false);
// var_dump($data2);

$sql="INSERT INTO  taichung_gym(name,town,addr,open,tel,lon,lat,pic,intr,res) 
        VALUES (?,?,?,?,?,?,?,?,?,?)";



foreach($data2 as $row){
    $stmt = $mysqli ->prepare($sql);
    $stmt ->bind_param('ssssssssss',$row->name,$row->town,$row->address,$row->open,$row->tel,$row->lon,$row->lat,$row->picture,$row->introduce,$row->reservation);
    //execute() 執行準備好的語句(prepare + parm)
    $stmt->execute();
    };

?>