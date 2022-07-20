<?php
$database = 'startfitness';
$mysqli = new mysqli('localhost','root','',$database,3306);
    if ($mysqli){echo "OK, $database is connected";}else{echo 'sad';}; // 其實存取失敗也會回傳，所以永遠ok
    echo '<hr />';
$mysqli->set_charset('utf8');
?>