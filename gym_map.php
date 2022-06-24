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
    .markTitle {
        font-weight: bold;
        font-size: 16px;
    }

    .gym_pic{
        height: 300px;
    }
</style>

<body>
    <!--地圖的放置位置-->
    <div id="content">
        <div class="row" id="gym_data">
            <div class="col">
                <h2>健身地圖</h2>
                <select id="city">
                    <option disabled selected>請選擇縣市</option>
                    <option>台中市</option>
                </select>
                <select id="town">
                    <option disabled selected>請選擇鄉鎮市區</option>
                    <option value="east">東區</option>
                    <option value="west">西區</option>
                    <option value="south">南區</option>
                    <option value="north">北區</option>
                    <option value="nantun">南屯區</option>
                    <option value="xitun">西屯區</option>
                    <option value="beitun">北屯區</option>
                    <option value="fengyuan">豐原區</option>
                    <option value="dali">大里區</option>
                    <option value="qingshui">清水區</option>
                    <option value="dajia">大甲區</option>
                    <option value="daya">大雅區</option>
                    <option value="wuri">烏日區</option>
                </select>
                <table>
                    <tr>
                        <th id="gym_name" colspan="2">Anytime Fitness 台中公益店</th>
                    </tr>
                    <tr>
                        <td colspan="2"><img id="gym_pic" class="gym_pic" src="https://lh5.googleusercontent.com/p/AF1QipNH3rmkgnaBQ55rdZHW8HXb01sNpcnNmd4Wqan8=w408-h272-k-no">
                        </td>
                    <tr>
                        <td>地址：</td>
                        <td id="gym_add">台中市南屯區公益路二段51號B1</td>
                    </tr>
                    <tr>
                        <td>電話：</td>
                        <td id="gym_tel">04-2327-0866</td>
                    </tr>
                    <tr>
                        <td>營業時間：</td>
                        <td id="gym_open">00:00-00:00</td>
                    </tr>
                    <tr>
                        <td>介紹：</td>
                        <td id="gym_intr">Anytime
                            Fitness——目前在全世界已經擁有超過5,000間分店，台中首家24小時健身中心，我們打造出輕鬆自在、沒有壓力的運動環境，歡迎所有人來運動。</td>
                    </tr>


                </table>
            </div>
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>

    </div>
</body>

<script>
    //地圖

    $('#mapid').height(window.innerHeight);
    //先建立map容器，再建立中心做標與縮放程度
    var myMap = L.map('mapid').setView([24.15098859875372, 120.65095303464386], 18);
    //加入地圖底圖( titleLayer:底圖圖層)
    L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        //地圖可以縮放的最大等級
        minZoom: 12,
        maxZoom: 18,
        attribution: 'Map data: © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: © <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
    }).addTo(myMap);

    //匯入JSON資料並製造成戳記
    $.getJSON('./taichung_gym.JSON', function(res) {
        for (i = 0; i < res.length; i++) {
            var name = res[i].name
            var add = res[i].address
            var town = res[i].town
            var tel = res[i].tel
            var open = res[i].open
            var lon = res[i].lon
            var lat = res[i].lat
            var intr = res[i].introduece
            var pic = res[i].picture
            //加入地圖戳記與pop
            L.marker([lon, lat]).addTo(myMap).bindPopup(
                name
            ).addTo(myMap).on('click', showGymName)
        }

    })
    //藉由onclick事件抓到健身房名稱
    function showGymName() {
        //抓取pop的文字(健身房名稱)
        var content = this._popup._content
        console.log(content)
        //利用匹配JSON資料，改變內容
        $.getJSON('./taichung_gym.JSON', function(res) {
            // console.log(res)
            //利用index
            const index = res.findIndex((element) => element.name === content);
            // console.log(index)
            var $name = res[index].name
            $('#gym_name').html($name)
            var $add = res[index].address
            var $town = res[index].town
            $('#gym_add').html('台中市'+$town+$add)
            var $tel = res[index].tel
            $('#gym_tel').html($tel)
            var $open = res[index].open
            $('#gym_open').html($open)
            var $intr = res[index].introduce
            console.log($intr)
            $('#gym_intr').html($intr)
            var $pic = res[index].picture
            console.log($pic)
            $('#gym_pic').attr('src',$pic)

        })
    }
</script>

</html>