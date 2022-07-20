<?php
// 如果還沒建database及table需要先建一下
// include_once('./CreateDatabase.php');
// include_once('./mysqli_root.php');
// include_once('./CreateTables.php');



// login database
include_once('./mysqli_root.php');

createTrigger_tr_log_member_insert($mysqli);

// create inbody table 
function createTrigger_tr_log_member_insert($mysqli) {
    $sql = "DROP TRIGGER IF EXISTS tr_log_member_insert;";
    $mysqli->query($sql);
    
    $sql = "CREATE TRIGGER tr_log_member_insert 
    AFTER INSERT ON member FOR EACH ROW 
    BEGIN 
        SET @body = concat('新增會員，帳號 : ', new.account);
        INSERT INTO log(body) VALUES(@body);
    END;";
    $result = $mysqli->query($sql);
    if ($result) { echo 'trigger tr_log_member_insert is created';}else{echo 'Have error when create trigger';};
    echo "<br / > \n";
}




?>