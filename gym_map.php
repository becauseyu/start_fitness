<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--加入leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
    <!--加入leaflet js(一定要在css之後)-->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <!--加入jquery-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--加入bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>gym_map</title>
</head>
<style>
    /*popFamily*/
    .popTitle {
        font-weight: bold;
        font-size: 18px;
        color: rgb(62, 89, 209);
    }

    .popAddr {
        font-size: 16px;
        color: gray;
    }

    .popRes {
        font-size: 16px;
        color: gray;
    }

    /*popFamily*/
    .redRes {
        color: white;
        background-color: rgb(255, 61, 61);
        border: 1px solid gray;
        border-radius: 5px;
        font-size: 18px;
    }

    .greenRes {
        color: white;
        background-color: rgb(62, 255, 127);
        border: 1px solid gray;
        border-radius: 5px;
        font-size: 18px;

    }

    .orangeRes {
        color: white;
        background-color: rgb(248, 134, 58);
        border: 1px solid gray;
        border-radius: 5px;
        font-size: 18px;

    }



    .gympic {
        height: 500px;
    }

    #gym_data {
        height: 100vh;
        overflow: scroll;
    }
</style>

<body>
    <!--地圖的放置位置-->
    <div id="content">
        <div class="row">
            <div class="col" id="gym_data">
                <h2>健身地圖</h2>
                <div class="areaList">
                    <select>
                        <option disabled selected>請選擇所在縣市</option>
                        <option selected>台中市</option>
                    </select>
                    <select name="" id="" class="townList">
                    </select>
                    <select name="" id="" class="gymList">
                    </select>
                </div>
                <table>
                    <tr>
                        <th class='gymTitle' colspan="2"></th>
                    </tr>
                    <tr>
                        <td colspan="2"><img class="gympic" src=''></td>
                    </tr>
                    <tr>
                        <td>地址：</td>
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

                        <td class='gymintr'></td>
                    </tr>



                </table>
            </div>
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>

    </div>
</body>

<?php
include('./mysqli.php');
$sql = "SELECT * FROM taichung_gym";
$result = $mysqli->query($sql); //傳回物件

$data = [];
$i = 0;
while ($row = $result->fetch_object()) { //將資列轉為物件後，丟到data陣列裡
    $data[$i] = $row;
    $i++;
}

//設定初始值(以後從這裡改即可)
$center = "SELECT * FROM taichung_gym WHERE name = 'Anytime Fitness 台中公益店'  ";
$resCenter = $mysqli->query($center); //傳回物件
$rowCenter = $resCenter->fetch_object();



?>


<script>
    //將php匯出的資料先以JSON傳送

    //全部data
    var data = '<?php echo json_encode($data); ?>'
    dataList = JSON.parse(data);
    // console.log(dataList) //得到陣列資料

    //初始值data(之後可以連動map與table資料)
    var center = '<?php echo json_encode($rowCenter); ?>'
    centerList = JSON.parse(center)
    // console.log(centerList) //得到物件



    //先將初始資料填入table
    $('.gymTitle').html(centerList.name)
    $('.gymaddr').html('台中市' + centerList.town + centerList.addr)
    $('.gympic').attr('src', centerList.pic)
    $('.gymtel').html(centerList.tel)
    $('.gymtel').html(centerList.tel)
    $('.gymopen').html(centerList.open)
    $('.gymintr').html(centerList.intr)


    //設定地圖高度
    $('#mapid').height(window.innerHeight);
    //先建立map容器，再建立中心做標與縮放程度
    var myMap = L.map('mapid').setView([centerList.lat, centerList.lon], 18);
    //加入地圖底圖( titleLayer:底圖圖層)
    L.tileLayer('https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png', {
        //地圖可以縮放的最大等級
        minZoom: 12,
        maxZoom: 18,
        attribution: 'Map data: © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: © <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
    }).addTo(myMap);

    //定義marker顏色(不同剩餘預約數顏色不同) //綠:31~45  橘:16~30 紅:1~15

    const greenIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    const orangeIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    const redIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    //使用for迴圈添加marker
    for (i = 0; i < dataList.length; i++) {
        var name = dataList[i].name
        var addr = dataList[i].addr
        var town = dataList[i].town
        var tel = dataList[i].tel
        var open = dataList[i].open
        var lon = dataList[i].lon
        var lat = dataList[i].lat
        var intr = dataList[i].intr
        var pic = dataList[i].pic
        var count = dataList[i].res
        //為inbody數量做出不同的樣式
        let countJudge;
        //依照預約數量顯示不同的marker顏色與預約數字
        if (count >= 0 && count <= 15) {
            mark = redIcon;
            countJudge = "redRes";
        } else if (count > 15 && count <= 30) {
            mark = orangeIcon;
            countJudge = "orangeRes";

        } else {
            mark = greenIcon;
            countJudge = "greenRes";

        }
        //添加marker
        L.marker([lat, lon], {
            icon: mark
        }).addTo(myMap).bindPopup(
            `<span class='popTitle'>${name}</span>
                <hr />
                <span class='popAddr'>台中市${town}${addr}</span><br/>
                <span class='popRes'>可供預約的數量:<button id='res' class=${countJudge}>${count}</button></span>
                <hr/>
                <button class='btn btn-info' onclick= >點我預約inbody</button>
                    `

        ).addTo(myMap).on('click', showGymName)

    }

    //藉由點擊marker改變table內容
    function showGymName(e) {
        //透過點擊抓到座標
        var gym = e.latlng
        var targetlat = gym.lat
        var targetlon = gym.lng
        // console.log(targetlat)
        // console.log(targetlon)
        for (let i = 0; i < dataList.length; i++) {
            let name = dataList[i].name;
            let addr = dataList[i].addr
            let town = dataList[i].town
            let tel = dataList[i].tel
            let open = dataList[i].open
            let intr = dataList[i].intr
            let pic = dataList[i].pic
            let count = dataList[i].res
            let lat = dataList[i].lat;
            let lon = dataList[i].lon;
            if (lat == targetlat) {
                $('.gymTitle').html(name)
                $('.gymaddr').html('台中市' + town + addr)
                $('.gympic').attr('src', pic)
                $('.gymtel').html(tel)
                $('.gymopen').html(open)
                $('.gymintr').html(intr)
                $('.townList').val(0)
                $('.gymList').val(0)

            }
        }


    }

    // //透過選取鄉鎮市後顯示鄉鎮市範圍(待修正) //目前問題點：他是用累加的，是不是要用layer分開比較好
    fetch("./taichung_dist.json")
        .then(response => response.json())
        .then(json => {
            var distList = json.features
            var nameList = []
            // console.log(distList) //全部的區名
            for (i = 0; i < distList.length; i++) {
                var distName = distList[i].properties.T_Name
                nameList.push(distName)
            }
            console.log(nameList) //得到所有的行政區清單(array)

            

        });


    // 從資料庫抓取鄉鎮市資料並加到畫面(以後新增資料庫才能連動)
    $(function() {
        let allTown = [];
        let TownStr = '';
        TownStr += '<option value="0" disabled selected>請選擇鄉鎮市區</option>'
        for (let i = 0; i < dataList.length; i++) {
            // 取出 data 資料裡的縣市名稱
            const townName = dataList[i].town;
            // console.log(townName)
            // 如果在 allTown 這個陣列裡找不到 townName，且 townName 不為空字串，就把 townName 放進 allTown 這個陣列裡
            if (allTown.indexOf(townName) == -1 && townName !== '') {
                allTown.push(townName);
                TownStr += `<option value="${townName}">${townName}</option>`
            }
        }
        $('.townList').html(TownStr)
        // 當鄉鎮選當發生變化時，進行畫面跳轉
        $('.townList').on('change', addGymList);
        $('.townList').on('change', goTownView);

    })

    // 選擇鄉鎮市後連動健身房並添加到select
    $('.gymList').html(`<option value="0" disabled selected>請選擇健身房</option>`);
    // 使用函式並帶入參數 e 來取得鄉鎮區的名字
    function addGymList(e) {
        // 取得點到的
        let townValue = e.target.value;
        let gymStr = `<option value="0" disabled selected>請選擇健身房</option>`;
        let allGym = [];
        let newGymnList = '';
        // 然後用迴圈來取得符合條件的鄉鎮區名
        for (let i = 0; i < dataList.length; i++) {
            //先宣告 ownMatch 為 data 資料中的縣市名
            let townMatch = dataList[i].town;
            //用 if 來判斷，如果鄉鎮市 select 的值跟 data 資料裡的鄉鎮市名相同，就把所有的健身房name push 到 allGym 這個陣列裡
            if (townValue == townMatch) {
                allGym.push(dataList[i].name);
            }
        }
        // 然後使用 Set 方法來產生一個集合讓陣列元素不會重複
        newGymList = new Set(allGym);
        // 再從剛才的集合產生陣列
        newGymList = Array.from(newGymList);
        for (let i = 0; i < newGymList.length; i++) {
            // 把鄉鎮區名累加成字串
            gymStr += `<option value="${newGymList[i]}">${newGymList[i]}</option>`
        }
        // 並把鄉鎮區名字串累加的結果用 innerHTML 放進 townSelector 裡
        $('.gymList').html(gymStr);
        // 對 townSelector 進行監聽，當 townSelector change 時，執行 geoTownView 函式
        $('.gymList').on('change', goGymView);

    }




    //選擇鄉鎮市後跳轉地圖
    function goTownView(e) {
        // 先取得鄉鎮區 select 中的 value，也就是鄉鎮區的名稱
        let town = e.target.value;
        // console.log(town)

        for (let i = 0; i < dataList.length; i++) {
            // 宣告變數取得 data 裡的鄉鎮區及其經緯度
            let townTarget = dataList[i].town;
            let lat = dataList[i].lat;
            let lon = dataList[i].lon;
            // 比較鄉鎮區名及縣市名，如果兩者皆符合，則取得鄉鎮區的經緯度
            if (townTarget == town) {
                lat = lat
                lon = lon
                myMap.setView([lat, lon], 14)

            }
        }

    }
    //選擇健身房名稱後後跳轉地圖+內容
    function goGymView(e) {
        // 先取得健身房 select 中的 value
        let gym = e.target.value;
        // console.log(gym)
        for (let i = 0; i < dataList.length; i++) {
            // 宣告變數取得 data 裡的鄉鎮區及其經緯度
            let gymTarget = dataList[i].name;
            let addr = dataList[i].addr
            let town = dataList[i].town
            let tel = dataList[i].tel
            let open = dataList[i].open
            let intr = dataList[i].intr
            let pic = dataList[i].pic
            let count = dataList[i].res
            let lat = dataList[i].lat;
            let lon = dataList[i].lon;
            // 比較鄉鎮區名及縣市名，如果兩者皆符合，則取得鄉鎮區的經緯度
            if (gymTarget == gym) {
                lat = lat
                lon = lon
                //進行跳轉
                myMap.setView([lat, lon], 16)
                $('.gymTitle').html(gym)
                $('.gymaddr').html('台中市' + town + addr)
                $('.gympic').attr('src', pic)
                $('.gymtel').html(tel)
                $('.gymopen').html(open)
                $('.gymintr').html(intr)

            }
        }
    }
</script>

</html>