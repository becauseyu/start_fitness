<?php
include('../php/mysqli.php');
$oPsw = md5($_POST['old_password']);
$nPsw = md5($_POST['fg_password']);
$email = $_POST['fg_email'];
//先確認舊密碼是否正確
$sqlConfirm = "SELECT * FROM member WHERE email = '{$email}' AND psw = '{$oPsw}' ;";
$result = $mysqli->query($sqlConfirm);
$count = $result->num_rows;
$text = '';
//有找到代表舊密碼正確
if ($count > 0) {
    //已信箱為條件去搜尋並更新密碼
    $sqlRenewPsw = "UPDATE member SET psw = '{$nPsw}' WHERE email = '{$email}'";
    $mysqli->query($sqlRenewPsw);
    $text = 'alert("密碼已更新完成，請重新登入！")';
    header("refresh:0.1;url=../html/mb_login.php");
}else{
    $sqlOrign = "SELECT * FROM member WHERE email = '{$email}'";
    $result2 = $mysqli->query($sqlOrign);
    $data = $result2->fetch_array();
    $mid = $data['mid'];
    $psw = $data['psw'];
    $text = 'alert("舊密碼輸入錯誤!")';
    header("refresh:0.1;url=../html/mb_update.php?mid={$mid}&psw={$psw}");

}
?>

<script>
    <?php
    echo $text; ?>

</script>
