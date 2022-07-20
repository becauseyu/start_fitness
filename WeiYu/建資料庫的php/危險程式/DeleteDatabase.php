<?php 
//注意會刪除資料庫，請小心使用不要點到

// 資料庫登入
$mysqli = new mysqli('localhost','root','','',3306);
    if ($mysqli){echo 'OK';}else{echo 'sad';}; // 其實存取失敗也會回傳，所以永遠ok
    echo '<hr />';
$mysqli->set_charset('utf8');



// delete database
function delete_startfitness_database($mysqli) {
    $sql = "DROP DATABASE IF EXISTS startfitness;";
    $result = $mysqli->query($sql);
    var_dump($result);
    if ($result) { echo 'database startfitness is deleted';}else{echo 'Have error ,please check out myphpadmin or php';};
    echo "<br / > \n";
}


//

//為了避免被點到，我包成function 需要的自己打開註解
//delete_startfitness_database();

//



$mysqli->close();



?>