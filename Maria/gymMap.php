
<?php
include('./mysqli.php');
$sql = "SELECT * FROM taichung_gym";
$result = $mysqli->query($sql); //傳回物件

$data = [];
$i = 0;
while ($row = $result->fetch_object()) { //將資料轉為物件後，丟到data陣列裡
    $data[$i] = $row;
    $i++;
}

//設定初始值(以後從這裡改即可)
$center = "SELECT * FROM taichung_gym WHERE name = 'Anytime Fitness 台中公益店'  ";
$resCenter = $mysqli->query($center); //傳回物件
$rowCenter = $resCenter->fetch_object();

//此時的$data 是抓出來的資料 $center是預設位置
//要以json_encode()送出，前端接回後佣JSON.parse()解回去

?>