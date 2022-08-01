<?php 

// 新創會員
function insertMember($name , $email , $tel , $account , $password , $point = 0, $staId = 2) {
    include('mysql.php');
    $sql = "INSERT INTO member (`account`, `psw`, `name`, `email`, `tel`, `point`, `staId` ) VALUES (?,?,?,?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssii',$account,$password,$name,$email,$tel,$point,$staId);
    $stmt->execute();

    echo 'member insert complete';
    return;
}
   

?>
