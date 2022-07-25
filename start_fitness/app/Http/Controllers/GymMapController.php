<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiChung_gym;
use App\Models\Inbody;
use App\Http\Traits\PhpMailTrait;

class GymMapController extends Controller
{
    function gymmap() {
        $text = (object) [];
        $text->title = '健身地圖';




        
        return view('sp.gymmap',compact('text'));
    }

    // 撈全部
    function list() {
        $gymList = TaiChung_gym::all()->toArray();
        return $gymList;
    }

    // 撈預設地點
    function getDefault() {
        $gymList = TaiChung_gym::where('name','Anytime Fitness 台中公益店')->first();
        return $gymList;
    }




    use PhpMailTrait;
    function inbody(Request $request) {
        // inbody 總覺得不登入不怎麼安全，容易被亂用

        // 資料檢查
        $name ='';
        $phone = '';
        $gym = '';
        $email ='';
        $date ='';
        $time ='';

        if ($request->input('resName')) {
            $name =$request->input('resName');
        } 

        if ($request->input('resTel')) {
            $phone =$request->input('resTel');
        } 

        if ($request->input('resGym')) {
            $gym =$request->input('resGym');
        } 

        if ($request->input('resEmail')) {
            $email =$request->input('resEmail');
        } 

        if ($request->input('resDate')) {
            $date =$request->input('resDate');
        } 

        if ($request->input('resTime')) {
            $time =$request->input('resTime');
        } 


        if ($name && $phone && $gym  && $email && $date && $time){
            // 全部都有才做
            $gymData = TaiChung_gym::where('name',$gym)->first();

            // 預約數量少1
            $gymData->res = $gymData->res - 1;
            $gymData->save();

            // 新增inbody
            $inbody = (new Inbody)->createNewInbody($name, $phone, $email, $gym, $date, $time);
            if ($inbody) {
                
                
                // 成功後開始寄信
                $addr = $gymData->town . $gymData->addr;
                $tel = $gymData->tel;
                $sendmail = (object) [];
                $sendmail->email = $email;
                $sendmail->subject = "感謝您在{$gym}的預約！"; //郵件標題
                $sendmail->body = "
                <table style='background-color: white;'>
                <tr>
                    <td>
                        <img src='https://upload.cc/i1/2022/07/07/cYzknK.png' style='width:800px'>
                    </td>
                </tr>
                <tr>
                    <td align='center'>
                        <h1 style='color: rgb(223, 128, 34) ;'>感謝您在『動吃！動吃！』網站進行預約</h1>
            
                    </td>
                </tr>
                <tr>
                    <td align='center' style='font-size: 14px;color: gray;padding: 15px;'>
                        InBody是體脂機通過電流，測出體脂、量測、量測等的數據。<br />
                        多位教練說：“開始減肥前運動一定要測！”如此了解的身體組成，調整飲食才能對症下藥！
                    </td>
                </tr>
                <tr>
                    <td align='center' style='padding: 30px;font-size: 16px;'>
                        <div style='background-color: rgb(255, 195, 85);border-radius: 20px;padding: 10px;width: fit-content;'>
                            <p style='padding:2px ;font-weight: bold;'>以下為您的預訂資訊 </p>
                            <p style='padding:2px ;'>預約者姓名： {$name} </p>
                            <p style='padding:2px ;'>預約者電話：{$phone}</p>
                            <p style='padding:2px ;'>預約日期：{$date}</p>
                            <p style='padding:2px ;'>預約時間：{$time}</p>
                            <p style='padding:2px ;'>健身房名稱:{$gym}</p>
                            <p style='padding:2px ;'>健身房地址:{$addr}</p>
                            <p style='padding:2px ;'>健身房電話:{$tel}</p>
                        </div>
            
                    </td>
                </tr>
                <tr>
                    <td style='background-color: rgb(142,180,227);padding: 20px;'>
                        <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊提醒您，當日請提早5-10分鐘至健身房櫃檯報到＊</p>
                        <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊如資訊有問題，或行程有異動，請來信<a
                                href='startfitness0809@gmail.com'>startfitness0809@gmail.com</a>告知＊</p>
            
                    </td>
                </tr>
            
            </table>
            
                " ; //郵件內容
                $this->composeEmail($sendmail);
                return redirect('/sport/gymmap');
                



            }else{
                // 預約失敗
                return redirect('/sport/gymmap');
            }
            
        

    
    




        }else{
            return redirect('/sport/gymmap');
        }

        

    }

}



// 撈資料
// include('../php/mysqli.php');
// $sql = "SELECT * FROM taichung_gym";
// $result = $mysqli->query($sql); //傳回物件

// $data = [];
// $i = 0;
// while ($row = $result->fetch_object()) { //將資料轉為物件後，丟到data陣列裡
//     $data[$i] = $row;
//     $i++;
// }

// //設定初始值(以後從這裡改即可)
// $center = "SELECT * FROM taichung_gym WHERE name = 'Anytime Fitness 台中公益店'  ";
// $resCenter = $mysqli->query($center); //傳回物件
// $rowCenter = $resCenter->fetch_object();



// inbody
// <meta charset="UTC-8">
// <?php
// include('./mysqli.php');
// //把phpmailer帶進來
// require '../vendor/autoload.php';

// use PHPMailer\PHPMailer\PHPMailer;

// //如果姓名不為空值，才執行
// $name = $_REQUEST['resName'];
// $phone = $_REQUEST['resTel'];
// $gym = $_REQUEST['resGym'];
// $email = $_REQUEST['resEmail'];
// $date = $_REQUEST['resDate'];
// $time = $_REQUEST['resTime'];
// if (!empty($name) && !empty($phone) && !empty($gym) && !empty($email) && $time != 0 ) {

//     // echo "$name:$tel:$gym:$email:$date:$time";

//     //用健身房名稱抓健身房資訊(電話、地址、訂位數量、營業時間)
//     $sqlCount = "SELECT name,town,res,tel,addr,open FROM `taichung_gym` WHERE name = '{$gym}' ";
//     // $hasGym = $result->num_rows; //傳回select語句後的筆數結果，之後可以做判斷
//     $result = $mysqli->query($sqlCount);
//     $row = $result->fetch_array();

//     // echo " {$row['res']} "; //得到現在的數量;
//     $count = $row['res'];
//     $count--;
//     $addr = $row['town'] . $row['addr'];
//     $tel = $row['tel'];
//     $picture = 'https://upload.cc/i1/2022/07/07/cYzknK.png';


//     //每次預約後數量-1並更新
//     $sqlMinus = "UPDATE `taichung_gym` SET res = '{$count}'  WHERE name = '{$gym}'";
//     $result2 = $mysqli->query($sqlMinus);
//     // echo 'ok';

//     //傳入訂單資料
//     $sqlRes = "INSERT INTO inbody(name,tel,email,gym,date,time) VALUES ('{$name}','{$tel}','{$email}','{$gym}','{$date}','{$time}')";
//     $result3 = $mysqli->query($sqlRes);



//     //寄送訂單email
//     // 這邊就可以使用
//    //寄送訂單email
//     // 這邊就可以使用
//     $mail = new PHPMailer(true);

//     $mail->IsSMTP();                                    //設定使用SMTP方式寄信
//     $mail->SMTPAuth = true;                        //設定SMTP需要驗證
//     $mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
//     $mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
//     $mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
//     $mail->CharSet = "utf-8";
//     $mail->Username = "1102136108@gm.kuas.edu.tw"; //Gamil帳號
//     $mail->Password = "tobzfgiutdxxapmq";                 //Gmail密碼(要去申請應用程式密碼)
//     $mail->From = "startfitness0809@gmail.com";        //寄件者信箱
//     $mail->FromName = "動吃!動吃!";                  //寄件者姓名
//     $mail->Subject = "感謝您在{$gym}的預約！"; //郵件標題
//     $mail->Body = "
//     <table style='background-color: white;'>
//     <tr>
//         <td>
//             <img src='https://upload.cc/i1/2022/07/07/cYzknK.png' style='width:800px'>
//         </td>
//     </tr>
//     <tr>
//         <td align='center'>
//             <h1 style='color: rgb(223, 128, 34) ;'>感謝您在『動吃！動吃！』網站進行預約</h1>

//         </td>
//     </tr>
//     <tr>
//         <td align='center' style='font-size: 14px;color: gray;padding: 15px;'>
//             InBody是體脂機通過電流，測出體脂、量測、量測等的數據。<br />
//             多位教練說：“開始減肥前運動一定要測！”如此了解的身體組成，調整飲食才能對症下藥！
//         </td>
//     </tr>
//     <tr>
//         <td align='center' style='padding: 30px;font-size: 16px;'>
//             <div style='background-color: rgb(255, 195, 85);border-radius: 20px;padding: 10px;width: fit-content;'>
//                 <p style='padding:2px ;font-weight: bold;'>以下為您的預訂資訊 </p>
//                 <p style='padding:2px ;'>預約者姓名： {$name} </p>
//                 <p style='padding:2px ;'>預約者電話：{$phone}</p>
//                 <p style='padding:2px ;'>預約日期：{$date}</p>
//                 <p style='padding:2px ;'>預約時間：{$time}</p>
//                 <p style='padding:2px ;'>健身房名稱:{$gym}</p>
//                 <p style='padding:2px ;'>健身房地址:{$addr}</p>
//                 <p style='padding:2px ;'>健身房電話:{$tel}</p>
//             </div>

//         </td>
//     </tr>
//     <tr>
//         <td style='background-color: rgb(142,180,227);padding: 20px;'>
//             <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊提醒您，當日請提早5-10分鐘至健身房櫃檯報到＊</p>
//             <p style='color:rgb(49, 45, 42);font-size: 14px;font-weight: bold;'>＊如資訊有問題，或行程有異動，請來信<a
//                     href='startfitness0809@gmail.com'>startfitness0809@gmail.com</a>告知＊</p>

//         </td>
//     </tr>

// </table>

//     " ; //郵件內容
//     $mail->IsHTML(true);                     //郵件內容為html
//     $mail->AddAddress("$email");  
//     $mail->Send();          
//     header('Location:../html/gym_map.php');
// }