<?php

// copy from a20220702_creste_member.php not edit yet



include('a20220702_sql_functions.php');
date_default_timezone_set('Asia/Taipei');



// -----------------------------------------會員資料產生器----------------------------------------------------------

// 姓名100筆(上網抓的)
$nameList = ['林怡蓁', '陳金辰', '吳鈺雯', '陳百歡', '鄭靜怡', '廖雅竹', '吳翊元', '胡智依', '浦仁豪', '馬文彥', '蔡美玲', '顏胤雨', '夏俊憲', '邱賢豪', '鄭育瑋', '楊淑玲', '陳家豪', '李嘉喜', '蔡宜靜', '黃筱辰', '李俊傑', '鄭俊緯', '李政迪', '張秀易', '吳介南', '劉宛玲', '李士佳', '李佳航', '陳政憲', '唐岱然', '蔡宗翰', '童愛菱', '邱秀玲', '楊雅嵐', '許明宏', '葉祥玉', '楊佩樺', '蔡雅正', '李妤妏', '沈紫夢', '黃子霞', '鄭朝盈', '黃華琪', '林可定', '朱靜宜', '時雅婷', '韓夢妍', '宣梅群', '鄭信宏', '陳明一', '楊育廷', '方俊佑', '馬婷富', '曾淑毓', '吳哲嘉', '楊宛蘋', '陳恩映', '賴俊和', '盧又昇', '黃雅瑜', '蔡芃映', '吳淑惠', '周可瑞', '李怡霖', '趙柏豪', '韓惠雯', '陳佳慧', '孫政勳', '蔡小威', '黃承翰', '蔡志修', '陳筱秀', '劉展珮', '吳竹哲', '吳揚修', '王漢隆', '楊佳菱', '吳佳穎', '陳志文', '黃建凱', '白盛華', '黃怡君', '柳函來', '李幸胤', '桑志明', '陳志峰', '蔡承春', '林安其', '廖雅馨', '陳依齊', '林雅琳', '夏仲恆', '李得茜', '吳元恬', '陳琪玄', '崔進易', '張哲谷', '曾嘉琪', '許雅婷', '林瓊剛'];


// email 100筆(上網抓的)
$emailList = ['winnifred.heathcote@hotmail.com', 'lorenz.lynch@gmail.com', 'mccullough.francesco@kris.com', 'marie.prohaska@gmail.com', 'dean97@hyatt.com', 'shane88@jacobi.com', 'dankunding@prohaska.com', 'skye.donnelly@hotmail.com', 'immanuel.schimmel@reilly.com', 'whaley@prohaska.biz', 'keeling.johann@yahoo.com', 'elenor04@gmail.com', 'maryse75@yahoo.com', 'samson15@hand.com', 'isidro08@herzog.com', 'silas.lemke@gmail.com', 'osteuber@yahoo.com', 'libby06@gmail.com', 'keven.hammes@reilly.biz', 'rupert01@hotmail.com', 'minnie.ondricka@haag.com', 'leon.gusikowski@gmail.com', 'kareem.leuschke@yahoo.com', 'mgusikowski@gmail.com', 'larkin.greyson@casper.com', 'claude60@hotmail.com', 'donny73@yahoo.com', 'fay.colt@kunze.com', 'johnnie.ward@champlin.com', 'trenton.sporer@cole.com', 'geoffrey02@yahoo.com', 'sandy93@rippin.com', 'yrutherford@gmail.com', 'roma87@bednar.org', 'bashirian.melisa@beer.com', 'dbartoletti@yahoo.com', 'ilarkin@hansen.org', 'anibal20@homenick.com', 'alta22@kirlin.net', 'becker.elena@gmail.com', 'mckenzie.elise@hotmail.com', 'jdouglas@rath.biz', 'gfunk@stracke.org', 'smcglynn@herman.com', 'yazmin.cole@hotmail.com', 'raynor.marques@hotmail.com', 'armand76@gmail.com', 'lorine45@yahoo.com', 'douglas.martine@hotmail.com', 'yquigley@denesik.info', 'rcrist@yahoo.com', 'mylene.kirlin@greenfelder.biz', 'ahermann@rippin.com', 'sgreenfelder@pouros.com', 'clara80@gmail.com', 'cole52@hotmail.com', 'padberg.alana@gmail.com', 'constantin.steuber@pollich.net', 'weber.adalberto@shanahan.com', 'wuckert.ursula@gmail.com', 'jweber@mayer.info', 'jenkins.gavin@hettinger.com', 'ole53@hotmail.com', 'ftrantow@mohr.com', 'jast.thelma@hotmail.com', 'reese53@yahoo.com', 'zhayes@denesik.biz', 'kenneth46@klocko.com', 'cschoen@yahoo.com', 'wisoky.dimitri@hotmail.com', 'adolfo.kunze@yahoo.com', 'kadin.dach@yahoo.com', 'joey.schultz@schulist.com', 'daron57@gleason.org', 'diego04@swaniawski.com', 'esta.larson@wolff.com', 'zkoss@konopelski.com', 'durgan.jazmin@von.net', 'qlueilwitz@weimann.com', 'yjones@harber.com', 'laurianne98@hotmail.com', 'stracke.lindsay@bechtelar.com', 'hortense64@hotmail.com', 'candelario.bogan@hotmail.com', 'lkrajcik@gmail.com', 'stoltenberg.brian@gmail.com', 'arielle28@hotmail.com', 'sydnie.franecki@gmail.com', 'april.bergnaum@boyle.org', 'lmarvin@gmail.com', 'ullrich.hosea@hilpert.com', 'alvina.gleason@gmail.com', 'hoeger.samson@hotmail.com', 'reinhold94@wiza.biz', 'kayden26@deckow.net', 'johnston.loyal@collier.biz', 'sofia28@conroy.net', 'sfahey@graham.org', 'lillian33@hotmail.com', 'aric.von@hotmail.com'];


// 隨機產生n組電話
function tel_generater(int $toal)
{
    $telList = [];
    for ($i = 0; $i < $toal; $i++) {
        $telList[] = '0' . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9) . random_int(1, 9);

        //     echo $tel[$i] . '<br / >';
    }
    return $telList;
}


// 簡易帳號隨機產生(4~6碼英文、0~4碼數字)
function account_generater(int $total)
{
    $English_small = str_split('qazwsxedcrfvtgbyhnujmikolp');
    // $English_big   = str_split('QAZWSXEDCRFVTGBYHNUJMIKOLP');
    $Number = str_split('0123456789');
    // $Special = str_split('!@#$%^&*()');
    $accountList = [];
    for ($i = 0; $i < $total; $i++) {
        $english_total = random_int(4, 6);
        $number_total = random_int(0, 4);
        $tmp = '';
        for ($j = 0; $j < $english_total; $j++) {

            $tmp .= $English_small[random_int(0, count($English_small) - 1)];
        }

        for ($j = 0; $j < $number_total; $j++) {
            $tmp .= $Number[random_int(0, count($Number) - 1)];
        }


        // echo $tmp . '<br />';
        $accountList[] = $tmp;
    }

    return $accountList;
}


// 隨機產生n組可以用的密碼
function ps_generater(int $total)
{
    $ii = 0;
    $passwordList = [];
    do {
        $tmp = ps_generater_single(random_int(10, 20));
        if (password_check($tmp)) {
            $ii++;
            $passwordList[] = $tmp;
            echo $tmp . '<br />';
        }
    } while ($ii < $total);

    return $passwordList;
}




//-----------------------------------------其他會用到的function------------------------------------

// 單筆密碼產生器(有很小機率可能不會過密碼驗證)
function ps_generater_single(int $length)
{
    $English_small = str_split('qazwsxedcrfvtgbyhnujmikolp');
    $English_big   = str_split('QAZWSXEDCRFVTGBYHNUJMIKOLP');
    $Number = str_split('0123456789');
    $Special = str_split('!@#$%^&*()');
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        switch (random_int(0, 3)) {
            case 0:
                $password .=  $English_small[random_int(0, count($English_small) - 1)];
                break;
            case 1:
                $password .=  $English_big[random_int(0, count($English_big) - 1)];
                break;
            case 2:
                $password .=  $Number[random_int(0, count($Number) - 1)];
                break;
            case 3:
                $password .=  $Special[random_int(0, count($Special) - 1)];
                break;
        }
    }
    return $password;
}



// 新創帳號密碼驗證
// 1.  10 ~ 30碼
// 2.  數字、大小寫英文、特殊符號要保證3項
// 3.  特殊符號只有!@#$%^&*() 不接受其他符號也不接受中文
function password_check(string $password)
{
    // 1. 不夠長、太長
    if (strlen($password) < 10) {
        return [false, '密碼要大於10碼，不夠長'];
    }
    if (strlen($password) > 30) {
        return [false, '密碼太長，你最好是可以記超過30碼'];
    }


    // 2. 驗證種類保證3項
    $password_new = $password;
    $password_old = $password;
    $English_small = str_split('qazwsxedcrfvtgbyhnujmikolp');
    $English_big   = str_split('QAZWSXEDCRFVTGBYHNUJMIKOLP');
    $Number = str_split('0123456789');
    $Special = str_split('!@#$%^&*()');


    // 密碼字元型態
    $totalType = 0;

    //
    $password_new = str_replace($English_small, '', $password_old);
    if ($password_new != $password_old) {
        $totalType++;
        $password_old = $password_new;
    }

    $password_new = str_replace($English_big, '', $password_old);
    if ($password_new != $password_old) {
        $totalType++;
        $password_old = $password_new;
    }

    $password_new = str_replace($Number, '', $password_old);
    if ($password_new != $password_old) {
        $totalType++;
        $password_old = $password_new;
    }

    $password_new = str_replace($Special, '', $password_old);
    if ($password_new != $password_old) {
        $totalType++;
        $password_old = $password_new;
    }


    // 3. 不包含規定以外的符號
    // 密碼內容包含前面以外的東西，不給過
    if (strlen($password_new) > 0) {
        return [false, '特殊符號只規定!@#$%^&*()，不可以出現空白及其他符號，中文也不行'];
    }

    // 2. 驗證(邏輯上可以先判定3所以插在中間)
    if ($totalType < 3) {
        return [false, '密碼請包含數字、大寫英文、小寫英文、特殊符號至少3種'];
    }


    return [true, 'OK,密碼可以用'];
}




// 記憶密碼，不然插入非密碼就死定了
function write_memberLog($name, $account, $password)
{
    $filename = fopen("log.txt", "a+");
    fwrite($filename, "| 姓名 : {$name} |" . "| 帳號 : {$account} |" .  "| 密碼 : {$password} |" . ' 產生日期 : ' . date('Y-m-d H:i:s') . "\r\n");
    fclose($filename);
}


//--------------------------------寫入主程式----------------------------------------





//資料進資料庫囉~~ 進100筆測試
function member_generater(int $time_perData = 10)
{
    $nameList = ['林怡蓁', '陳金辰', '吳鈺雯', '陳百歡', '鄭靜怡', '廖雅竹', '吳翊元', '胡智依', '浦仁豪', '馬文彥', '蔡美玲', '顏胤雨', '夏俊憲', '邱賢豪', '鄭育瑋', '楊淑玲', '陳家豪', '李嘉喜', '蔡宜靜', '黃筱辰', '李俊傑', '鄭俊緯', '李政迪', '張秀易', '吳介南', '劉宛玲', '李士佳', '李佳航', '陳政憲', '唐岱然', '蔡宗翰', '童愛菱', '邱秀玲', '楊雅嵐', '許明宏', '葉祥玉', '楊佩樺', '蔡雅正', '李妤妏', '沈紫夢', '黃子霞', '鄭朝盈', '黃華琪', '林可定', '朱靜宜', '時雅婷', '韓夢妍', '宣梅群', '鄭信宏', '陳明一', '楊育廷', '方俊佑', '馬婷富', '曾淑毓', '吳哲嘉', '楊宛蘋', '陳恩映', '賴俊和', '盧又昇', '黃雅瑜', '蔡芃映', '吳淑惠', '周可瑞', '李怡霖', '趙柏豪', '韓惠雯', '陳佳慧', '孫政勳', '蔡小威', '黃承翰', '蔡志修', '陳筱秀', '劉展珮', '吳竹哲', '吳揚修', '王漢隆', '楊佳菱', '吳佳穎', '陳志文', '黃建凱', '白盛華', '黃怡君', '柳函來', '李幸胤', '桑志明', '陳志峰', '蔡承春', '林安其', '廖雅馨', '陳依齊', '林雅琳', '夏仲恆', '李得茜', '吳元恬', '陳琪玄', '崔進易', '張哲谷', '曾嘉琪', '許雅婷', '林瓊剛'];
    $emailList = ['winnifred.heathcote@hotmail.com', 'lorenz.lynch@gmail.com', 'mccullough.francesco@kris.com', 'marie.prohaska@gmail.com', 'dean97@hyatt.com', 'shane88@jacobi.com', 'dankunding@prohaska.com', 'skye.donnelly@hotmail.com', 'immanuel.schimmel@reilly.com', 'whaley@prohaska.biz', 'keeling.johann@yahoo.com', 'elenor04@gmail.com', 'maryse75@yahoo.com', 'samson15@hand.com', 'isidro08@herzog.com', 'silas.lemke@gmail.com', 'osteuber@yahoo.com', 'libby06@gmail.com', 'keven.hammes@reilly.biz', 'rupert01@hotmail.com', 'minnie.ondricka@haag.com', 'leon.gusikowski@gmail.com', 'kareem.leuschke@yahoo.com', 'mgusikowski@gmail.com', 'larkin.greyson@casper.com', 'claude60@hotmail.com', 'donny73@yahoo.com', 'fay.colt@kunze.com', 'johnnie.ward@champlin.com', 'trenton.sporer@cole.com', 'geoffrey02@yahoo.com', 'sandy93@rippin.com', 'yrutherford@gmail.com', 'roma87@bednar.org', 'bashirian.melisa@beer.com', 'dbartoletti@yahoo.com', 'ilarkin@hansen.org', 'anibal20@homenick.com', 'alta22@kirlin.net', 'becker.elena@gmail.com', 'mckenzie.elise@hotmail.com', 'jdouglas@rath.biz', 'gfunk@stracke.org', 'smcglynn@herman.com', 'yazmin.cole@hotmail.com', 'raynor.marques@hotmail.com', 'armand76@gmail.com', 'lorine45@yahoo.com', 'douglas.martine@hotmail.com', 'yquigley@denesik.info', 'rcrist@yahoo.com', 'mylene.kirlin@greenfelder.biz', 'ahermann@rippin.com', 'sgreenfelder@pouros.com', 'clara80@gmail.com', 'cole52@hotmail.com', 'padberg.alana@gmail.com', 'constantin.steuber@pollich.net', 'weber.adalberto@shanahan.com', 'wuckert.ursula@gmail.com', 'jweber@mayer.info', 'jenkins.gavin@hettinger.com', 'ole53@hotmail.com', 'ftrantow@mohr.com', 'jast.thelma@hotmail.com', 'reese53@yahoo.com', 'zhayes@denesik.biz', 'kenneth46@klocko.com', 'cschoen@yahoo.com', 'wisoky.dimitri@hotmail.com', 'adolfo.kunze@yahoo.com', 'kadin.dach@yahoo.com', 'joey.schultz@schulist.com', 'daron57@gleason.org', 'diego04@swaniawski.com', 'esta.larson@wolff.com', 'zkoss@konopelski.com', 'durgan.jazmin@von.net', 'qlueilwitz@weimann.com', 'yjones@harber.com', 'laurianne98@hotmail.com', 'stracke.lindsay@bechtelar.com', 'hortense64@hotmail.com', 'candelario.bogan@hotmail.com', 'lkrajcik@gmail.com', 'stoltenberg.brian@gmail.com', 'arielle28@hotmail.com', 'sydnie.franecki@gmail.com', 'april.bergnaum@boyle.org', 'lmarvin@gmail.com', 'ullrich.hosea@hilpert.com', 'alvina.gleason@gmail.com', 'hoeger.samson@hotmail.com', 'reinhold94@wiza.biz', 'kayden26@deckow.net', 'johnston.loyal@collier.biz', 'sofia28@conroy.net', 'sfahey@graham.org', 'lillian33@hotmail.com', 'aric.von@hotmail.com'];

    $accountList = account_generater(100);
    $telList = tel_generater(100);
    $passwordList = ps_generater(100);
    for ($i = 0; $i < 100; $i++) {
        // 密碼加密
        $password = password_hash($passwordList[$i], PASSWORD_DEFAULT);

        // 插入資料
        insertMember($nameList[$i], $emailList[$i], $telList[$i], $accountList[$i], $password);

        // 廢物管理員要為自己留後路
        write_memberLog($nameList[$i], $accountList[$i], $passwordList[$i]);

        // 怕存資料出問題，可以及時停止程式，而不是進入n筆後無法挽回
        sleep($time_perData);
    }
}






function controller_generate()
{
    // 插入資料
    $password = password_hash('1234ABCD!@#$', PASSWORD_DEFAULT);
    insertMember('Tesrter1', 'jom30801@gmail.com', '0970638603', 'tester1', $password, 1, 'controller');

    // 廢物管理員要為自己留後路
    write_memberLog('Tesrter1', 'tester1', '1234ABCD!@#$');
}    











// 會員帳密單測試區
// write_member_log('測試員2','test456','12345678');



// 表單插入測試
// insertMember($name , $email , $tel , $account , $password , $status = 1, $permission = 'member');
// insertMember('測試員1', 'aaa123@yuo.com' , '0123456789' , 'test456' , '12345678' , 1, 'member');


// 密碼測試區
// $password_test = '123456';
// [$result,$log] = password_check($password_test);
// echo "密碼: $password  //  驗證訊息 : $log" . '<br />';

// $password_test = '1111111111111111111111111111111111111111111111111111111111';
// [$result,$log] = password_check($password_test);
// echo "密碼: $password_test  //  驗證訊息 : $log" . '<br />';

// $password_test = 'aaaaaaaaaa123';
// [$result,$log] = password_check($password_test);
// echo "密碼: $password_test  //  驗證訊息 : $log" . '<br />';

// $password_test = '!@#$%^&*(JKLJKLJK\\';
// [$result,$log] = password_check($password_test);
// echo "密碼: $password_test  //  驗證訊息 : $log" . '<br />';
