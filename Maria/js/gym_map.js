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
var allPoly = new L.LayerGroup();
//加入地圖底圖( titleLayer:底圖圖層)
var base = L.tileLayer('https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png', {
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

const blackIcon = new L.Icon({
    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

//使用for迴圈添加marker
for (i = 0; i < dataList.length; i++) {
    let data = dataList[i]
    let name = data.name
    let addr = data.addr
    let town = data.town
    let tel = data.tel
    let open = data.open
    let lon = data.lon
    let lat = data.lat
    let intr = data.intr
    let pic = data.pic
    let count = data.res
    //為inbody數量做出不同的樣式
    let countJudge;
    //依照預約數量顯示不同的marker顏色與預約數字
    if (count > 0 && count <= 15) {
        mark = redIcon;
        countJudge = "redRes";
    } else if (count > 15 && count <= 30) {
        mark = orangeIcon;
        countJudge = "orangeRes";

    } else if (count <= 0) {
        mark = blackIcon;
        countJudge = "blackRes"
    } else {
        mark = greenIcon;
        countJudge = "greenRes";
    }

    //依照預約數量，放入預約按鈕
    let buttonJudge;
    if (count > 0) {
        buttonJudge = "btn-info"
    } else {
        buttonJudge = "btn-dark"
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
                <button class='btn ${buttonJudge}' onclick=openRes(this) >點我預約inbody</button><a  target='_blank' class='m-2' href='https://healthyu.ntunhs.edu.tw/content/?parent_id=250'>甚麼是inbody?</a>
                    `

    ).addTo(myMap).on('click', showGymName)

}

//==========================================================問題點======================================================================/

//以行政區為分隔添加圖層
fetch("../JSON/taichung_dist.json")
    .then(response => response.json())
    .then(json => {
        var distList = json.features
        var townList = []
        for (let i = 0; i < distList.length; i++) {
            var distName = distList[i].properties.T_Name
            var distPoly = L.geoJSON(distList[i])
            var data = {}
            data.name = distName;
            data.polygon = distPoly
            townList.push(data)
        }

        // console.log(townList)
        //解決如何用變數全部加入
        //想法一:生出 {區名:poly } 這樣的陣列
        //想法二"找到只單純新增layer control的方法

        L.control.layers({
            "Gym健身地圖": base,
        }, {
            '中區': townList[0].polygon,
            '東區': townList[1].polygon,
            '南區': townList[2].polygon,
            '西區': townList[3].polygon,
            '北區': townList[4].polygon,
            '西屯區': townList[5].polygon,
            '南屯區': townList[6].polygon,
            '北屯區': townList[7].polygon,
            '豐原區': townList[8].polygon,
            '東勢區': townList[9].polygon,
            '大甲區': townList[10].polygon,
            '清水區': townList[11].polygon,
            '沙鹿區': townList[12].polygon,
            '后里區': townList[13].polygon,
            '神岡區': townList[14].polygon,
            '潭子區': townList[15].polygon,
            '大雅區': townList[16].polygon,
            '新社區': townList[17].polygon,
            '石岡區': townList[18].polygon,
            '外埔區': townList[19].polygon,
            '大安區': townList[20].polygon,
            '烏日區': townList[21].polygon,
            '大肚區': townList[22].polygon,
            '龍井區': townList[23].polygon,
            '霧峰區': townList[24].polygon,
            '太平區': townList[25].polygon,
            '大里區': townList[26].polygon,
            '和平區': townList[27].polygon,
            '梧棲區': townList[28].polygon
        }).addTo(myMap);
    });

//==========================================================問題點======================================================================/
//原始dialog框設定
$(function () {

    $("#dialog_div").dialog({
        open: function () {
            // On open, hide the original submit button
            $(this).find("[type=submit]").hide();
        },
        autoOpen: false, //自動開啟，預設開啟(true)，這邊改為false
        show: "blind", //設定開啟樣式
        hide: "none", //設定關閉樣式
        buttons: [{
            text: '送出',
            open: function () {
                $(this).addClass('yescls')
            },
            click: function () {
                alert('感謝您的預約！請到信箱確認預約詳情。')

            },
            type: 'submit',
            form: 'inbodyRes' //透過form與原本的form連結，就可以做submit事件
        },
        {
            text: "取消",
            open: function () {
                $(this).addClass('cancelcls')
            },
            click: function () {
                $(this).dialog("close");
            }
        }
        ],
        closeOnEscape: true, //設定也可用exc關閉表單
        draggable: false, //設定無法被拖曳(固定置中)
        height: 500,
        width: 500,
        modal: true, //設定dialog開啟時，頁面鎖定
    });


});


//點擊開啟預約表單(dialog)
function openRes(btn) {
    //抓到觸發點的資訊
    var targetname = $(btn).siblings().eq(0).text()
    for (let i = 0; i < dataList.length; i++) {
        let data = dataList[i]
        let name = data.name;
        let addr = data.addr
        let town = data.town
        let tel = data.tel
        let open = data.open
        let intr = data.intr
        let pic = data.pic
        let count = data.res
        let lat = data.lat;
        let lon = data.lon;
        let id = data.id;
        if (count > 0) { //預約數大於0才能預約
            if (name == targetname) {
                // console.log(name)
                $('#resGym').val(name)
                $('#resGym2').val(name)
                $('#resCount').text(count)
                //dialog裡的時段跳轉(依照營業時間不同跳轉)
                //依造營業時間產生預約時段表(一小時一次))
                $('#resTime').html(`<option value="0" disabled selected>請選擇時段</option>`);
                let timeStr = `<option value="0" disabled selected>請選擇時段</option>`;
                let time = [];
                // console.log(open) //得到 00:00 - 00:00的格式
                var open_time = open.split('-')
                // console.log(open_time) //得到array[00:00,00:00] 
                open_start = parseInt((open_time[0].split(':'))[0])
                open_end = parseInt((open_time[1].split(':'))[0]) - 1
                //把營業時間每一小時就加到選項中
                for (let i = open_start; i <= open_end; i++) {
                    if (i < 10) {
                        timeStr += `<option value="0${i}:00" >0${i}:00</option>`
                    } else {
                        timeStr += `<option value="${i}:00">${i}:00</option>`
                    }
                }
                // console.log(timeStr)
                $('#resTime').html(timeStr); //最後放到預約時間中
                //開啟對話框
                $("#dialog_div").dialog("open"); //設定點按鈕時會跳出diolog
                return false;

            }
        }
    }
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
        let data = dataList[i]
        let name = data.name;
        let addr = data.addr
        let town = data.town
        let tel = data.tel
        let open = data.open
        let intr = data.intr
        let pic = data.pic
        let count = data.res
        let lat = data.lat;
        let lon = data.lon;
        let id = data.id;
        if (lat == targetlat) {
            $('.gymTitle').html(name)
            $('.gymaddr').html('台中市' + town + addr)
            $('.gympic').attr('src', pic)
            $('.gymtel').html(tel)
            $('.gymopen').html(open)
            $('.gymintr').html(intr)
            // console.log(town)
            $('.townList').val(0)
            // console.log(name)
            $('.gymList').val(0)

        }
    }
}


// 從資料庫抓取鄉鎮市資料並加到畫面(以後新增資料庫才能連動)
$(function () {
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
    let allId = [];
    let newGymnList = '';
    // 然後用迴圈來取得符合條件的鄉鎮區名
    for (let i = 0; i < dataList.length; i++) {
        //先宣告 townMatch 為 data 資料中的縣市名
        let townMatch = dataList[i].town;
        //用 if 來判斷，如果鄉鎮市 select 的值跟 data 資料裡的鄉鎮市名相同，就把所有的健身房name push 到 allGym 這個陣列裡
        if (townValue == townMatch) {
            allId.push(dataList[i].id);
            allGym.push(dataList[i].name);
        }
    }
    // 然後使用 Set 方法來產生一個集合讓陣列元素不會重複
    newGymList = new Set(allGym);
    newGymIdx = new Set(allId);
    // 再從剛才的集合產生陣列
    newGymList = Array.from(newGymList);
    newGymIdx = Array.from(newGymIdx);
    for (let i = 0; i < newGymList.length; i++) {
        // 把鄉鎮區名累加成字串
        gymStr += `<option data-id="${newGymIdx[i]}" value="${newGymList[i]}">${newGymList[i]}</option>`
    }

    // 並把鄉鎮區名字串累加的結果用 HTML 放進 townSelector 裡
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
        // console.log(town)
    }


    //想實現的功能二、選取鄉鎮市後框起範圍(無法成功只保留一區)
    fetch("../JSON/taichung_dist.json")
        .then(response => response.json())
        .then(json => {
            var distList = json.features
            // console.log(distList)
            //再來找目標
            var targetPoly;

            for (let i = 0; i < distList.length; i++) {
                var distName = distList[i].properties.T_Name
                var distPoly = L.geoJSON(distList[i]) //轉成polygon事件
                if (distName == town) {
                    //allPoly是一個LayerGroup
                    myMap.fitBounds(distPoly.getBounds()) //抓取layerGroup的bound，然後縮放程符合的畫面
                    allPoly.clearLayers(); //每次開始前先清除layer裡的所有內容
                    allPoly.addLayer(distPoly); //再加入正確的
                    allPoly.addTo(myMap); //顯示到地圖上
                }
            }
        })

}
//選擇健身房名稱後後跳轉地圖+內容
function goGymView(e) {
    // 先取得健身房 select 中的 value
    let gym = e.target.value;
    // console.log(gym)
    for (let i = 0; i < dataList.length; i++) {
        // 宣告變數取得 data 裡的鄉鎮區及其經緯度
        let data = dataList[i];
        let gymTarget = data.name;
        let addr = data.addr
        let town = data.town
        let tel = data.tel
        let open = data.open
        let intr = data.intr
        let pic = data.pic
        let count = data.res
        let lat = data.lat;
        let lon = data.lon;
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
    var a = $('.gymList').val()
    console.log(a)
}

//判定名字
$('#resName').on('input', function () {
    var name = $('#resName').val()
    // console.log(email.includes('@'))
    //驗證信箱是否含@
    if ( name !='') {
        $('#wrong_name').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    }else {
        $('#wrong_name').html('<span class="notice">請輸入您的名字</span>')

    }
})

//判定電話號碼
$('#resTel').on('input', function () {
    var tel = $('#resTel').val()
    //判定是否為手機(09) or (+886)
    var tel_local = tel.substr(0, 2)
    var tel_foreign = tel.substr(0, 4)
    if (tel_local == '09') {
        if (tel.length == 10) {
            $('#wrong_tel').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
        }
        else {
            $('#wrong_tel').html('<span class="notice">請輸入正確的手機</span>')

        }

    } else if (tel_foreign == '+886') {
        if (tel.length == 13 || tel.length == 14) {
            $('#wrong_tel').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')

        } else {
            $('#wrong_tel').html('<span class="notice">請輸入正確的手機</span>')

        }
    } else {
        $('#wrong_tel').html('<span class="notice">請輸入正確的手機</span>')

    }
})

//判定電子信箱
$('#resEmail').on('input', function () {
    var email = $('#resEmail').val()
    // console.log(email.includes('@'))
    //驗證信箱是否含@
    if ( email.includes('@') == true) {
        $('#wrong_email').html('<i style="color:green" class="fa fa-check-circle" aria-hidden="true"></i>')
    }else {
        $('#wrong_email').html('<span class="notice">請輸入正確的信箱</span>')

    }
})



