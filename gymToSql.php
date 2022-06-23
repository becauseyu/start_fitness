<?php 
//連線mysql資料庫
$mysqli = new mysqli('localhost','root','','startfitness',3306);
//設定程式庫語言
$mysqli->set_charset('utf8') ;
//載入JSON內容
$JSON = file_get_contents('./taichung_gym.JSON');
// var_dump($JSON);
$data1 = json_decode($JSON,true);
// var_dump($data1);
$data2 = json_decode($JSON,false);
// var_dump($data2);

//把JSON資料放進資料庫
$sql="INSERT INTO  taichung_gym(`name`,town,intr,pic,`open`,tel,`add`,lat,lon) 
        VALUES (?,?,?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($sql);

foreach($data2 as $row){
    //執行JSON放到 database
    // $stmt ->bind_param('sssssssss',$row ->name,$row ->town,$row ->introduce,$row ->picture,$row ->open,$row ->tel,$row ->address,$row ->lat,$row ->lon);
    // $stmt ->execute();
};




?>