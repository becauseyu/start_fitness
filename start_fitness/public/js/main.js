
//新增側邊購物車
//------------------點擊【x】關閉購物車-----------------------------//
function closebuycar() {
  $('#slide_buycart').css('visibility', 'hidden')
}

//------------------點擊【購物車】開啟購物車-----------------------------//
function openbuycar() {
  $('#slide_buycart').css('visibility', 'visible')
}

//===================點擊觸發購物車與增加品項=======================//
//確認localStorage是否有東西
var myStorage = localStorage
goodstList = myStorage.getItem('wantList') //得到目前有被放進購物車的物品清單
//------------------如果wantList是空值，直接清空localStorage-----------------------------//
if (goodstList == '') {
  myStorage.clear()
}
//如果有，先把東西放進購物車
//======================= 先初始化資料============================//
var wantList = []
if (goodstList) {
  goodstList = goodstList.split(',') //得到目前有的清單
  goodstList.forEach(function (elm, idx) {
    var data = JSON.parse(myStorage.getItem(elm));//把JSON轉回物件
    var $ul = $(
      `<ul style="list-style: none;">
        <li align="center"class="slide_buycart_goodsTitle">${data.name}</li>
        <li align="center"><img class="slide_buycart_image" src=${data.img}></img></li>
        <li ><input type="number" value=${data.count}  class="slide_buycart_count" id="slide_buycart_count" "></input></li>
        <li id="slide_buycart_total"align="center">NT$ <span>${data.totalPrice}</span></li>
        <li class="hide">${data.singlePrice}</li>
        <li><button class='delete_goods' onclick=delete_goods(this) >移除該商品</button></li>
        <hr>
     </ul>
        `
    )
    wantList = goodstList
    //先把已經有的品項放進購物車
    $('#slide_buycart_goods').append($ul)
    var total = parseInt($('#slide_buycart_accounttotal').html())
    total += parseInt(data.totalPrice) 
    $('#slide_buycart_accounttotal').html(total)


  })
  //在購物車icon放入數量
  var count = myStorage.getItem('cartQuantity')
  $('#cartQuantity').html(count)

} else {
  wantList = []; //設定一個願望清單(要放到localStroage)
}
//===================點擊觸發購物車與增加品項=======================//


$('.cart2').on('click', function () {
  $('#slide_buycart').css('visibility', 'visible')
  var goods_name = $(this).parent().parent().find('p').eq(0).text()
  // console.log(goods_name)
  var goods_img = $(this).parent().parent().parent().find('img').prop('src')
  var goods_single_price = $(this).parent().parent().find('p').find('span').text()
  var uls = ($('#slide_buycart_goods ul'))
  var nameArr = new Array(); //定義nameArray為新陣列(目前#slide_buycart_goods ul還是空的)
  $.each(uls, function (idx, elm) {
    nameArr.push($(this).children('li').eq(0).text())
  })
  var $ul = $( //新增商品後的html //單價不顯示，僅計算用，在購物車頁面會顯示
    `<ul style="list-style: none;">
        <li align="center"class="slide_buycart_goodsTitle">${goods_name}</li>
        <li align="center"><img class="slide_buycart_image" src=${goods_img}></img></li>
        <li ><input type="number" value="1" class="slide_buycart_count" id="slide_buycart_count" "></input></li>
        <li id="slide_buycart_total"align="center">NT$ <span>${goods_single_price}</span></li>
        <li class="hide">${goods_single_price}</li>
        <li><button class='delete_goods' onclick=delete_goods(this) >移除商品</button></li>
        <hr>
     </ul>
        `
  )

  //確認商品是否已存在購物車
  var isHasName = nameArr.indexOf(goods_name)
  var goodCount = 1  //設定商品數量初始值
  var goodTotal = goods_single_price //設定商品數量初始價格

  if (isHasName >= 0) { //被點及一次後，就會往上加，初始為-1
    var goodCount = uls.eq(isHasName).children('li').eq(2).find('input').val()
    Number.parseInt(goodCount);
    uls.eq(isHasName).children('li').eq(2).find('input').val(++goodCount)
    var goodPrice = uls.eq(isHasName).children('li').eq(4).html()
    Number.parseInt(goodPrice);
    var goodTotal = goodCount * goodPrice
    Number.parseInt(goodTotal)
    uls.eq(isHasName).children('li').eq(3).html(`NT$<span>${goodTotal}</span>`)

  }
  //如果不存在就新增商品

  else {
    $('#slide_buycart_goods').append($ul)
    $('#slide_buycart_accounttotal').html(+goods_single_price)
    //也新增到願望清單中
    wantList.push(goods_name)
  }

  var myStorage = localStorage
  var good = {
    name: goods_name,
    count: goodCount,
    img: goods_img,
    singlePrice: goods_single_price,
    totalPrice: goodTotal
  }
  myStorage.setItem(goods_name, JSON.stringify(good))
  myStorage.setItem('wantList', wantList)

  //-------------inputNumber 觸發單品加減與總數量加減-----------------------------//

  $(".slide_buycart_count").on('input', function () {
    var btn_count = $(this).val()

    if (btn_count >= 0) {  //設定如果val()小於零時，自動刪除
      var btn_price = $(this).closest('ul').find('li').eq(4).text()
      var btn_total = btn_count * btn_price
      Number.parseInt(btn_total)
      $(this).closest('ul').find('li').eq(3).html(`NT$<span>${btn_total}</span>`)

      var sum = 0
      $('#slide_buycart_content').find('ul').each(function (idx, elm) {
        var goodsTotalAcount = $(elm).find('span').html();
        sum = parseInt(sum) + parseInt(goodsTotalAcount)
        console.log(sum)
      })
      $('#slide_buycart_accounttotal').html(sum)

      var count = 0
      $('#slide_buycart_content').find('ul').each(function (idx, elm) {
        var goodsTotalcount = $(elm).find(':input').val();
        count = parseInt(count) + parseInt(goodsTotalcount)
      })
      $('#totalCount').html(count)
      $('#cartQuantity').html(count) //透過點擊改變購物車圖標上數字
      //把購物車數量存到localStorage
      var myStorage = localStorage
      myStorage.setItem('cartQuantity', count)

    }

    else {
      //刪除畫面
      var a = $(this).closest('ul')
      a.remove()
      //歸零時刪除localStorage
      var goods_name = $(this).closest('ul').find('li').eq(0).html()
      var myStorage = localStorage
      myStorage.removeItem(goods_name)
      //從wantList刪除商品並推回localStorage
      wantList = myStorage.getItem('wantList').split(',')
      wantList = wantList.filter(deleteGoods);
      function deleteGoods(name) {
        return name != goods_name;
      }
      myStorage.setItem('wantList', wantList)
    }

    //更改數量加入localStorage
    var btn_name = $(this).closest('ul').find('li').eq(0).text()
    var myStorage = localStorage
    var goodJson = myStorage.getItem(btn_name)
    var goodsData = JSON.parse(goodJson)
    goodsData.count = parseInt(btn_count)
    goodsData.totalPrice = parseInt(btn_total)
    myStorage.setItem(btn_name, JSON.stringify(goodsData))
  })

  //------------------點擊icon改變總計-----------------------------//
  var sum = 0
  $('#slide_buycart_content').find('ul').each(function (idx, elm) {
    var goodsTotalAcount = $(elm).find('span').html();
    sum = parseInt(sum) + parseInt(goodsTotalAcount)
  })
  $('#slide_buycart_accounttotal').html(sum)

  var count = 0
  $('#slide_buycart_content').find('ul').each(function (idx, elm) {
    var goodsTotalcount = $(elm).find(':input').val();
    count = parseInt(count) + parseInt(goodsTotalcount)
  })
  $('#totalCount').html(count)
  $('#cartQuantity').html(count)  //透過input:number改變購物車圖標上數字
  myStorage.setItem('cartQuantity', count)

})


$(".slide_buycart_count").on('input', function () {
  var btn_count = $(this).val()

  if (btn_count >= 0) {  //設定如果val()小於零時，自動刪除
    var btn_price = $(this).closest('ul').find('li').eq(4).text()
    var btn_total = btn_count * btn_price
    Number.parseInt(btn_total)
    $(this).closest('ul').find('li').eq(3).html(`NT$<span>${btn_total}</span>`)

    var sum = 0
    $('#slide_buycart_content').find('ul').each(function (idx, elm) {
      var goodsTotalAcount = $(elm).find('span').html();
      sum = parseInt(sum) + parseInt(goodsTotalAcount)
      console.log(sum)
    })
    $('#slide_buycart_accounttotal').html(sum)

    var count = 0
    $('#slide_buycart_content').find('ul').each(function (idx, elm) {
      var goodsTotalcount = $(elm).find(':input').val();
      count = parseInt(count) + parseInt(goodsTotalcount)
    })
    $('#totalCount').html(count)
    $('#cartQuantity').html(count) //透過點擊改變購物車圖標上數字
    //把購物車數量存到localStorage
    var myStorage = localStorage
    myStorage.setItem('cartQuantity', count)

  }

  else {
    //刪除畫面
    var a = $(this).closest('ul')
    a.remove()
    //歸零時刪除localStorage
    var goods_name = $(this).closest('ul').find('li').eq(0).html()
    var myStorage = localStorage
    myStorage.removeItem(goods_name)
    //從wantList刪除商品並推回localStorage
    wantList = myStorage.getItem('wantList').split(',')
    wantList = wantList.filter(deleteGoods);
    function deleteGoods(name) {
      return name != goods_name;
    }
    myStorage.setItem('wantList', wantList)
  }

  //更改數量加入localStorage
  var btn_name = $(this).closest('ul').find('li').eq(0).text()
  var myStorage = localStorage
  var goodJson = myStorage.getItem(btn_name)
  var goodsData = JSON.parse(goodJson)
  goodsData.count = parseInt(btn_count)
  goodsData.totalPrice = parseInt(btn_total)
  myStorage.setItem(btn_name, JSON.stringify(goodsData))
})

function delete_goods(btn) {
  var now_price = $('#slide_buycart_accounttotal').html()
  var now_count = $('#cartQuantity').html()
  var delete_price = $(btn).closest('ul').find('span').html()
  var delete_count = $(btn).closest('ul').find(':input').val()
  $('#slide_buycart_accounttotal').html(parseInt(now_price) - parseInt(delete_price))
  $('#cartQuantity').html(parseInt(now_count) - parseInt(delete_count))
  var myStorage = localStorage
  myStorage.setItem('cartQuantity', parseInt(now_count) - parseInt(delete_count))

  var delete_goods = $(btn).closest('ul')
  delete_goods.remove()

  //把品項從localStroage移除
  var btn_name = $(btn).closest('ul').find('li').eq(0).html()
  myStorage.removeItem(btn_name)
  wantList = myStorage.getItem('wantList').split(',')
  wantList = wantList.filter(deleteGoods);
  function deleteGoods(name) {
    return name != btn_name;
  }
  myStorage.setItem('wantList', wantList)

}
//判斷是否顯示登出按鈕
var user = $('#user').html()
if(user == '登入'){
  $('#userlogout').addClass('hidden')
  $('#user_icon').addClass('fa-user-o')
  $('#user_icon').removeClass('fa-user')




}else{
  $('#userlogout').removeClass('hidden')
  $('#user_icon').addClass('fa-user')
  $('#user_icon').removeClass('fa-user-o')


}