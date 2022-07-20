<?php 

// copy from a20220702_sql_functions ， not edit yet


// 新創會員
function insertMember($name , $email , $tel , $account , $password , $status = 1, $permission = 'member') {
    include('mysql.php');
    $sql = "INSERT INTO member (`name`, `email`, `tel`, `account`, `password`, `status`, `permission` ) VALUES (?,?,?,?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssis',$name,$email,$tel,$account,$password,$status,$permission);
    $stmt->execute();

    echo 'member insert complete';
    return;
}
   

?>
