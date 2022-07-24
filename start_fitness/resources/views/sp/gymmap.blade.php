<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--加入leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <!--加入leaflet js(一定要在css之後)-->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>


    @include('front_side_frame.link')

    <!--加入jQuery ui(dialog)-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />


    <!-- 插入自己的css -->
    <link href="/css/gym_map.css" rel="stylesheet">
    <title>{{ $text->title }}</title>
</head>

<body>
    <!-- 頁首  -->
    <div class='headerpage'>
        @include('front_side_frame.header')
    </div>
    <!-- 地圖的放置位置 -->
    <div id="content">
        <div class="row m-5">
            <div class="col table-responsive" id="gym_data">
                <h2>健身地圖</h2>
                <div class="areaList">
                    <select class=' mb-3' aria-label=".form-select-lg example">
                        <option disabled selected>請選擇所在縣市</option>
                        <option selected>台中市</option>
                    </select>
                    <select name="" id="" class="townList  mb-3">
                    </select><br />
                    <select name="" id="" class="gymList mb-3">
                    </select>
                </div>
                <table border="2px" class='gym_table'>
                    <tr>
                        <th class='gymTitle' colspan="2"></th>
                    </tr>
                    <tr>
                        <td colspan="2"><img class="gympic" src=''></td>
                    </tr>
                    <tr>
                        <td style="width:100px;">地址：</td>
                        <td class='gymaddr'></td>
                    </tr>
                    <tr>
                        <td>電話：</td>
                        <td class='gymtel'></td>
                    </tr>
                    <tr>
                        <td>營業時間</td>
                        <td class='gymopen'></td>
                    </tr>
                    <tr>
                        <td>介紹：</td>

                        <td class='gymintr' style='text-align: left'></td>
                    </tr>
                </table>
                <div class='inbody'>

                </div>
            </div>
            <div class="col">

                <div class="intrMark" align='left'>
                    inbody預約的剩餘數量：
                    <img class='markicon'
                        src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png'>31以上
                    <img class='markicon'
                        src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png'>16~30
                    <img class='markicon'
                        src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png'>1~15
                    <img class='markicon'
                        src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png'>0
                </div>

                <div id="mapid"></div>

            </div>

        </div>
    </div>
    <!-- 頁尾 -->
    <footer>
        
        @include('front_side_frame.footer')
    </footer>
    <!----------------------------------Dialog area-------------------------------------------->
    <div id="dialog_div" title="立即預約您的inbody檢測!！">
        <form method="post" id='inbodyRes' action="/sport/gymmap/inbody">
            @csrf
            <span class="con_title">您欲預約的健身房:</span>
            <br />
            <input id='resGym' type='text' class='form-control' disabled></input>
            <input id='resGym2' name='resGym' type='text' class='form-control hidden'></input>
            <span class="con_title">尚可預約數量:</span><span id='resCount'> 0 </span>
            <hr>
            <span class="con_title">
                <label for='resName'>
                    預約大名（真實姓名）：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_name'></span>
            </span>
            <br />
            <input required id='resName' name='resName' type="text" class='form-control'>
            <span class="con_title">
                <label for='restel'>
                    聯絡電話(僅供手機)：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_tel'></span>
            </span>
            <input required id='resTel' name='resTel' type="text" class='form-control'>
            <span class="con_title">
                <label for='resEmail'>
                    聯絡信箱：
                </label>
                <span class='memo'>*必填</span>
                <span id='wrong_email'></span>
            </span>
            <input required id='resEmail' name='resEmail' type="email" class='form-control'>
            <span class="con_title"><label for='resDate'>預約日期</label><span class='memo'>*必填</span></span>
            <input id='resDate' name='resDate' type="date">
            <br />
            <span class="con_title"><label for='resTime'>預約時段</label><span class='memo'>*必填</span></span>
            <select id='resTime' name='resTime' value='0'>
                <option value="0" disabled selected>請選擇時段</option>
            </select>
            <br />
            <input type="submit" value="送出">
        </form>


    </div>


</body>


<script src="/js/main.js"></script>
<script>
    // //將php匯出的資料先以JSON傳送

    // //全部data
    // var data = '<php echo json_encode($data); ?>'
    // dataList = JSON.parse(data);
    // // console.log(dataList) //得到陣列資料

    // //初始值data(之後可以連動map與table資料)
    // var center = '<php echo json_encode($rowCenter); ?>'
    // centerList = JSON.parse(center)
    // // console.log(centerList) //得到物件


    function getGymData(url) {
        var xhttp = new XMLHttpRequest();
        //如果當xhttp發生改變時，發生後面的callback(回乎函式) //閉包
        xhttp.onreadystatechange = function() {
            //200 :畫面載入成功(404是失敗)
            if (xhttp.readyState == 4 && xhttp.status == 200) {

                if (xhttp.responseText != 0) { //帳號無重複 //xhttp.responseText 來自後端
                    console.log('get gym data')
                    
                } else {
                    console.log('get nothing')
                }
            }
        };

        // 不使用非同步功能
        xhttp.open('GET', url, false);
        //send請求
        xhttp.send();
        return JSON.parse(xhttp.responseText);
    }


</script>
<script src="/js/gym_map.js"></script>


</html>
