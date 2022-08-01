<?php 

// 新創會員
function insertMember($name , $email , $tel , $account , $password , $point = 0, $staId = '1') {
    include('mysql.php');
    $sql = "INSERT INTO member (`account`, `psw`, `name`, `email`, `tel`, `point`, `staId` ) VALUES (?,?,?,?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssis',$name,$email,$tel,$account,$password,$status,$permission);
    $stmt->execute();

    echo 'member insert complete';
    return;
}
   

?>
