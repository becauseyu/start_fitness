<?php
$mysqli = new mysqli('localhost','root','','',3306);
if ($mysqli){echo 'OK';}else{echo 'sad';}; // 其實存取失敗也會回傳，所以永遠ok
echo '<hr />';
$mysqli->set_charset('utf8');



// create startfitness database

    $sql = "CREATE DATABASE IF NOT EXISTS startfitness";
    $result = $mysqli->query($sql);
    var_dump($result);
    $result = $mysqli->query($sql);
if ($result) { echo 'database startfitness is created';}else{echo 'Have error when create table startfitness, or it is exist';};
echo "<br / > \n";

$mysqli->close();

?>
