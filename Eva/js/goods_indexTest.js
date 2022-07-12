$('.footerpage').load('/MengYing/大專/LAB/footer.html')
// 飲食的hover
$(function () {
  var itemnum = 0;
  itemnum = $('.food').length;

  //建立　換圖function
  function menu(i) {
    $('.food').eq(i).hover(
      function () {
        $(this).attr("src", "../asset/saleitem/food/0" + i + ".1.webp");
      },
      function () {
        $(this).attr("src", "../asset/saleitem/food/0" + i + ".webp")
      })
  };
  // 執行　function
  for (i = 0; i < itemnum; i++) {
    menu(i);
  }

})

// 動動的hover
$(function () {
  var itemnum = 0;
  itemnum = $('.gym').length;

  //建立　換圖function
  function menu(i) {
    $('.gym').eq(i).hover(
      function () {
        $(this).attr("src", "../asset/saleitem/gym/0" + i + ".1.webp")
      },
      function () {
        $(this).attr("src", "../asset/saleitem/gym/0" + i + ".webp")
      })
  };
  // 執行　function
  for (i = 0; i < itemnum; i++) {
    menu(i);
  }

})

//新增側邊購物車

//------------------點擊【x】關閉購物車-----------------------------//


function closebuycar() {
  $('#slide_buycart').css('visibility', 'hidden')
}

//------------------點擊【購物車】開啟購物車-----------------------------//

function openbuycar() {
  $('#slide_buycart').css('visibility', 'visible')
}

//=====點擊處發購物車========//
var wantList = []; //設定一個願望清單(要放到localStroage)
$('.fa-cart-shopping').on('click', function () {
  $('#slide_buycart').css('visibility', 'visible')
  var goods_name = $(this).parent().text()
  // console.log(goods_name)
  var goods_img = $(this).parent().parent().parent().find('img').prop('src')
  // console.log(goods_img)  //設定引用圖片
  var goods_single_price = $(this).parent().parent().find('p').find('span').text()
  // console.log(goods_single_price)//設定單價
  var uls = ($('#slide_buycart_goods ul'))
  var nameArr = new Array(); //定義nameArray為新陣列(目前#slide_buycart_goods ul還是空的)
  $.each(uls, function (idx, elm) {
    nameArr.push($(this).children('li').eq(0).text())
  })
  var $ul = $( //新增商品後的html //單價不顯示，僅計算用，在購物車頁面會顯示
    `<ul style="list-style: none;">
          <li align="center"class="slide_buycart_goodsTitle">${goods_name}</li>
          <li align="center"><img class="slide_buycart_image" src=${goods_img}></img></li>
          <li ><input type="number" value="1" id="slide_buycart_count" "></input></li>
          <li id="slide_buycart_total"align="center">NT$ <span>${goods_single_price}</span></li>
          <li class="hide">${goods_single_price}</li>
          <li><button class='delete_goods' onclick=delete_goods(this) >移除該商品</button></li>
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
    // console.log(goodCount)
    Number.parseInt(goodCount);
    uls.eq(isHasName).children('li').eq(2).find('input').val(++goodCount)
    var goodPrice = uls.eq(isHasName).children('li').eq(4).html()
    // console.log(goodPrice)
    Number.parseInt(goodPrice);
    var goodTotal = goodCount * goodPrice
    Number.parseInt(goodTotal)
    // console.log(goodTotal)
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
    // console.log(wantList)
    myStorage.setItem('wantList', wantList)

    //-------------inputNumber 觸發單品加減與總數量加減-----------------------------//

    $(":input").on('input', function () {
      var btn_count = $(this).val()
      console.log(btn_count)

      if (btn_count >= 0) {  //設定如果val()小於零時，自動刪除
        var btn_price = $(this).closest('ul').find('li').eq(4).text()
        // console.log(btn_price)
        var btn_total = btn_count * btn_price
        Number.parseInt(btn_total)
        $(this).closest('ul').find('li').eq(3).html(`NT$<span>${btn_total}</span>`)

        var sum = 0
        $('#slide_buycart_content').find('ul').each(function (idx, elm) {
          var goodsTotalAcount = $(elm).find('span').html();
          // console.log(goodsTotalAcount);
          sum = parseInt(sum) + parseInt(goodsTotalAcount)
        })
        $('#slide_buycart_accounttotal').html(sum)

        var count = 0
        $('#slide_buycart_content').find('ul').each(function (idx, elm) {
          var goodsTotalcount = $(elm).find(':input').val();
          // console.log(goodsTotalcount);
          count = parseInt(count) + parseInt(goodsTotalcount)
        })
        $('#totalCount').html(count)
        $('#cartQuantity').html(count) //透過點擊改變購物車圖標上數字
      }

      else {
        var a = $(this).closest('ul')
        a.remove()


      }

      //更改數量加入localStorage
      var btn_name = $(this).closest('ul').find('li').eq(0).text()
      console.log(btn_name)
      var myStorage = localStorage
      var goodJson = myStorage.getItem(btn_name)
      var goodsData = JSON.parse(goodJson)
      console.log(goodsData.count)
      goodsData.count = parseInt(btn_count)
      goodsData.totalPrice = parseInt(sum)
      myStorage.setItem(btn_name, JSON.stringify(goodsData))


    })

    //------------------點擊icon改變總計-----------------------------//
    var sum = 0
    $('#slide_buycart_content').find('ul').each(function (idx, elm) {
      var goodsTotalAcount = $(elm).find('span').html();
      // console.log(goodsTotalAcount);
      sum = parseInt(sum) + parseInt(goodsTotalAcount)
    })
    $('#slide_buycart_accounttotal').html(sum)

    var count = 0
    $('#slide_buycart_content').find('ul').each(function (idx, elm) {
      var goodsTotalcount = $(elm).find(':input').val();
      // console.log(goodsTotalcount);
      count = parseInt(count) + parseInt(goodsTotalcount)
    })
    $('#totalCount').html(count)
    $('#cartQuantity').html(count)  //透過input:number改變購物車圖標上數字



  })



function delete_goods(btn) {
  // console.log($(btn))
  var now_price = $('#slide_buycart_accounttotal').html()
  // console.log(now_price)
  var now_count = $('#cartQuantity').html()
  // console.log(now_count)
  var delete_price = $(btn).closest('ul').find('span').html()
  // console.log(delete_price)
  var delete_count = $(btn).closest('ul').find(':input').val()
  // console.log(delete_count)
  $('#slide_buycart_accounttotal').html(parseInt(now_price) - parseInt(delete_price))
  $('#cartQuantity').html(parseInt(now_count) - parseInt(delete_count))
  var delete_goods = $(btn).closest('ul')
  delete_goods.remove()

  //把品項從localStroage移除
  var btn_name = $(btn).closest('ul').find('li').eq(0).html()
  var myStorage = localStorage
  myStorage.removeItem(btn_name)

}

//把localStorage的東西留在畫面上
var myStorage = localStorage
wantList = myStorage.getItem('wantList') //得到目前有被放進購物車的物品清單
var result =wantList.split(',') //因為是字串，所以把他拆成陣列
result.forEach(function(res,idx){
  var dataDetail = JSON.parse(myStorage.getItem(res))  //把東西轉回物件
})

