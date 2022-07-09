<?php 

include('../php/mysqli.php');

$acc= $_REQUEST['lg_account'];

if(isset($name)){
    //因為密碼用MD5加密放入的
    $psw =md5($_REQUEST['lg_password']);
    $sql = "SELECT * FROM member WHERE name = {$acc}" ;
    $result = $mysqli->query($sql);

    echo $psw;

    // if($result->num_rows > 0){
    //     //確認會員帳號密碼是否正確
    //     $member = $result->fetch_array();
    //     if (($member['account']) == $account && ($member['psw'] == $psw)){
    //         // header('Location:../html/mb_login.php');
    //         echo 'ok';
        
    //     }else{
    //         header('Location:../html/mb_login.php');
    //     }
    // //若無，跳回登入畫面
    // }else{
    //     header('Location:../html/mb_login.php');
    // };
    

}else{
    
}




?>