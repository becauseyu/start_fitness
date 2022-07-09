<?php 
$verify = stripslashes(trim($_GET['verify']));
echo $verify;
// $nowtime = time();
// $query = mysql_query("select id,token_exptime from t_user where status='0' and
// `token`='$verify'");
// $row = mysql_fetch_array($query);
// if($row){
// if($nowtime>$row['token_exptime']){ //24hour
// $msg = '您的啟用有效期已過，請登入您的帳號重新傳送啟用郵件.';
// }else{
// mysql_query("update t_user set status=1 where id=".$row['id']);
// if(mysql_affected_rows($link)!=1) die(0);
// $msg = '啟用成功！';
// }
// }else{
// $msg = 'error.';
// }
// echo $msg;
?>
