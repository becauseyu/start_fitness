<?php
include_once('../php/mysqli.php');
$acc = $_REQUEST['acc'];
$verify = stripslashes(trim($_GET['verify'])); //得到驗證碼
// echo $verify;
$timeStamp = $_GET['time'] + (60 * 60 * 24); //得到驗證效期最後時間 UNIX(24小時)
// echo date("Y-m-d",$timeStamp);
$nowtime = time();
$sql = "SELECT * FROM member WHERE psw = '{$verify}' AND account = '{$acc}' ";
$result = $mysqli->query($sql);
// var_dump($result);
$row =  $result->num_rows; //確認是否有符合的

$text = "";

if ($row > 0) {
    if ($nowtime > $timeStamp) {
        $text = 'alert("您的驗證碼已過期，請至登入頁面重新登入驗證。")';
        header("refresh:0.1;url=../html/mb_login.php");
    } else {
        $sqlConfirm = "UPDATE member SET staId = 2 WHERE psw = '{$verify}'";
        $mysqli->query($sqlConfirm);
        $text = 'alert("驗證成功！將為您跳轉至登入頁面重新登入。")';
        //設定幾秒後做頁面跳轉
        header("refresh:0.1;url=../html/mb_login.php");
    }
}

?>

<script>
    <?php echo $text; ?>
</script>

