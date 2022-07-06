<meta charset="UTC-8">
<?php
include('./mysqli.php');
//把phpmailer帶進來
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_REQUEST['resName'])) {
    $name = $_REQUEST['resName'];
    $tel = $_REQUEST['resTel'];
    $gym = $_REQUEST['resGym'];
    $email = $_REQUEST['resEmail'];
    $date = $_REQUEST['resDate'];
    $time = $_REQUEST['resTime'];
    // echo "$name:$tel:$gym:$email:$date:$time";


    //用健身房名稱抓現在數量
    $sqlCount = "SELECT name,res FROM `taichung_gym` WHERE name = '{$gym}' ";
    // $hasGym = $result->num_rows; //傳回select語句後的筆數結果，之後可以做判斷
    $result = $mysqli->query($sqlCount);
    $row = $result->fetch_array();

    // echo " {$row['res']} "; //得到現在的數量;
    $count = $row['res'];
    $count--;

    //每次預約後數量-1並更新
    $sqlMinus = "UPDATE `taichung_gym` SET res = '{$count}'  WHERE name = '{$gym}'";
    $result2 = $mysqli->query($sqlMinus);
    // echo 'ok';

    //傳入訂單資料
    $sqlRes = "INSERT INTO inbody(name,tel,email,gym,date,time) VALUES ('{$name}','{$tel}','{$email}','{$gym}','{$date}','{$time}')";
    $result3 = $mysqli->query($sqlRes);

    //寄送訂單email
    // 這邊就可以使用
    $mail = new PHPMailer(true);

    $mail->IsSMTP();                                    //設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                        //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
    $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8";
    $mail->Username = "startfitness0809@gmail.com"; //Gamil帳號
    $mail->Password = "jsifadwuzaatcklc";                 //Gmail密碼
    $mail->From = "startfitness0809@gmail.com";        //寄件者信箱
    $mail->FromName = "動吃!動吃!";                  //寄件者姓名
    $mail->Subject = "感謝您在{$gym}的預約!"; //郵件標題
    $mail->Body = "<img src='https://upload.cc/i1/2022/07/06/CKv67A.png
    '>以下為您的預訂資訊：<br/>姓名:" . $name . "<br />信箱:" . $email . "<br />電話:" . $tel . "<br />" ; //郵件內容
    $mail->IsHTML(true);                             //郵件內容為html
    $mail->AddAddress("$email");            //收件者郵件及名稱
    if (!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "<b>感謝您的留言，您的建議是我們前進的動力。</b>";
    }



    header('Location:gym_map.php');
}
?>