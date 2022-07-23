<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;


// 寄信專用功能
// 因為需要的東西很長，所以寫在這裡

trait PhpMailTrait

{

    // =============== [ Email ] ===================
    public function email()
    {
        return view("email");
    }


    // ========== [ Compose Email ] ================
    public function composeEmail($request)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        // 寄信目前需要給
        // 1. 標頭 subject;
        // 2. 內容 body;
        // 3. 寄信人 email;
        // 4. 重導頁網址 redirect url

        try {

            // Email server settings
            $mail->IsSMTP();                                    //設定使用SMTP方式寄信
            $mail->SMTPAuth = true;                        //設定SMTP需要驗證
            $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
            $mail->Host = env('MAIL_HOST');             //Gamil的SMTP主機
            $mail->Port = env('MAIL_PORT');                                 //Gamil的SMTP主機的埠號(Gmail為465)。
            $mail->CharSet = "utf-8";
            $mail->Username = env('MAIL_USERNAME'); //Gamil帳號
            $mail->Password = env('MAIL_PASSWORD');                //Gmail密碼(要去申請應用程式密碼)
            $mail->From = env('MAIL_FROM_ADDRESS');        //寄件者信箱
            $mail->FromName = env('MAIL_FROM_NAME');             //寄件者姓名



            $mail->Subject = $request->subject; //郵件標題
            $mail->Body = $request->body;

            $mail->SMTPDebug = 0;
            $mail->isHTML(true);                // Set email content format to HTML
            $mail->AddAddress("$request->email"); //收件者email
            $mail->Send();



            // 增加附件功能，目前用不到
            // if (isset($_FILES['emailAttachments'])) {
            //     for ($i = 0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }


            // $mail->AltBody = plain text version of email body;



            if (!$mail->send()) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            } else {
                return back()->with("success", "Email has been sent.");
            }
        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }
    }
}
