<?php
include('../php/mysqli.php');
$nPsw = md5($_POST['fg_password']);
$email = $_POST['fg_email'];
//已信箱為條件去搜尋並更新密碼
$sqlRenewPsw = "UPDATE member SET psw = '{$nPsw}' WHERE email = '{$email}'";
$mysqli->query($sqlRenewPsw);
$text = 'alert("密碼已更新完成，請重新登入！")';
header("refresh:0.1;url=../html/mb_login.php");
?>
<script>
<?php echo $text; ?>
</script>