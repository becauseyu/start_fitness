<?php

include('./mysqli.php');
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_REQUEST['fg_email'];

if (isset($email)) {
    $sql = "SELECT * FROM member WHERE email = '{$email}'";
    $result = $mysqli->query($sql);
    $row =  $result->num_rows; //確認是否有符合的
    $data = $result->fetch_array();
    $host = $_SERVER['HTTP_HOST'];

    //代表沒有輸入錯誤的註冊信箱
    if ($row > 0) {
        //發重設密碼的信件
        $acc = $data['account'];
        $mail = new PHPMailer(true);
        $mail->IsSMTP();                                    //設定使用SMTP方式寄信
        $mail->SMTPAuth = true;                        //設定SMTP需要驗證
        $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
        $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
        $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
        $mail->CharSet = "utf-8";
        $mail->Username = ""; //Gamil帳號
        $mail->Password = "";                    //Gmail密碼(要去申請應用程式密碼)
        $mail->From = "startfitness0809@gmail.com";        //寄件者信箱
        $mail->FromName = "動吃!動吃!";                  //寄件者姓名
        $mail->Subject = "『動吃！動吃！』網站的密碼重設請求！"; //郵件標題
        $mail->Body = "
            <table style='background-color: white;'>
        <tr>
            <td>
                <img src='https://upload.cc/i1/2022/07/07/cYzknK.png' style='width:800px'>
            </td>
        </tr>
    
        <tr>
            <td align='center' style='padding: 30px;font-size: 16px;'>
                親愛的{$acc}：<br/>
                請點選連結重設您的登入密碼。<br/>
                <a href='http://{$host}/php/renewPsw.php?email={$email}' target='_blank'>＞＞＞點此重設密碼＜＜＜＜</a><br/>
                如果以上網址無法點取，請將它複製到你的瀏覽器位址列中進入訪問。<br/>
                如果此次重設密碼請求非你本人所發，請盡速來信聯絡我們。<br/><p style='text-align:right'>

            </td>
        </tr>
        <tr>
            <td style='background-color: rgb(142,180,227);padding: 20px;'>
                <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊如資訊有問題，請來信<a
                        href='startfitness0809@gmail.com'>startfitness0809@gmail.com</a>告知＊</p>

            </td>
        </tr>

    </table>

                "; //郵件內容
        $mail->IsHTML(true);
        $mail->AddAddress("$email");
        $mail->Send();
        $text = 'alert("已將重設密碼要求寄至您的信箱！請盡速至信箱收取。")';
        //跳轉回認證正確訊息
        header("refresh:0.1;url=../html/mb_login.php");
    }
    //代表了錯誤的信箱 
    else {
        $text = 'alert("此信箱尚未註冊")';
        header("refresh:0.1;url=../html/forget.html");


    }
}
?>
<script>
<?php echo $text; ?>
</script>