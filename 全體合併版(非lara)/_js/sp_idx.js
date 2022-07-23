//先建立map容器，再建立中心做標與縮放程度
var myMap = L.map('mapid').setView([24.1506315,120.6509068], 18);
var allPoly = new L.LayerGroup();
//加入地圖底圖( titleLayer:底圖圖層)
var base = L.tileLayer('https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png', {
    //地圖可以縮放的最大等級
    minZoom: 18,
    maxZoom: 18,
    attribution: 'Map data: © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: © <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
}).addTo(myMap);

L.marker([24.1506315,120.6509068], {
}).addTo(myMap).bindPopup(
    `<span style='font-weight: bold;font-size: 18px;color: rgb(62, 89, 209);'>Anytime Fitness 台中公益店</span>
            <hr />
            <span  style='font-size: 16px;color: gray;'>台中市南屯區公益路二段51號B1<br/>`

).addTo(myMap)