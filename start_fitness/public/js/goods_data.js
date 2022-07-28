// 小圖抓大圖
$('.smallImage01').on('click', function () {
  var src = $(this).attr('src');
  $('#bigImage').attr("src", src);
})

// 點口味更換資訊
$('.item-icon').on('click', function () {
  var who = $(this).closest('.item-icon').html();
  //在口味欄放入內容
  $('.flaver').html(who);
  //找到該名字的圖片
  var img = $(this).data('pic') //找到對應的圖片
  var type = $(this).data('type')
  var price = $(this).data('price')
  //更換大圖
  $('#bigImage').attr('src', '/image/' + type + '/' + img)
  //更換價格
  $('.pprice').html(price)


})
// //點圖片放入口味
$('.smallImage01').on('click', function () {
  var style = $(this).data('name')
  var price = $(this).data('price')
  $('.flaver').html(style)
  $('.pprice').html(price)


})

//數字加與減
$('.plus').on('click', function () {
  var sum = $('.qty').val()
  sum++;
  $('.qty').val(sum)

})
$('.minus').on('click', function () {
  var sum = $('.qty').val()
  sum--;
  if (sum < 0) {
    sum = 0
  }
  $('.qty').val(sum)

})

//把商品加入購物車
$('.button08').on('click', function () {
  //打開購物車
  $('#slide_buycart').css('visibility', 'visible')
  //得到產品完整名稱，去檢查是否存在購物車
  var name = $('#product_name').html()
  var flavor = $('#product_flaver').html()
  var fullname = $.trim(name) + '－' + $.trim(flavor)
  var img = $('#bigImage').prop('src')
  var single_price = $('#product_price').html()
  var count = $('#product_count').val()

  var uls = ($('#slide_buycart_goods ul'))
  //檢查是否存在
  var isHasName = wantList.indexOf(fullname)
  var $ul = $( //新增商品後的html //單價不顯示，僅計算用，在購物車頁面會顯示
    `<ul style="list-style: none;">
      <li align="center"class="slide_buycart_goodsTitle">${fullname}</li>
      <li align="center"><img class="slide_buycart_image" src=${img}></img></li>
      <li ><input type="number" value="${count}" class="slide_buycart_count" id="slide_buycart_count" "></input></li>
      <li id="slide_buycart_total"align="center">NT$ <span>${count * single_price}</span></li>
      <li class="hide">${single_price}</li>
      <li><button class='delete_goods' onclick=delete_goods(this) >移除商品</button></li>
      <hr>
   </ul>
      `)

  if (isHasName >= 0) { //被點及一次後，就會往上加，初始為-1
    var goodCount = uls.eq(isHasName).children('li').eq(2).find('input').val()
    goodCount = parseInt(goodCount) + parseInt(count)
    uls.eq(isHasName).children('li').eq(2).find('input').val(goodCount)
    var goodPrice = uls.eq(isHasName).children('li').eq(4).html()
    Number.parseInt(goodPrice);
    var goodTotal = goodCount * goodPrice
    Number.parseInt(goodTotal)
    uls.eq(isHasName).children('li').eq(3).html(`NT$<span>${goodTotal}</span>`)
    //也把物品放入localStorage
    var good = {
      name: fullname,
      count: goodCount,
      img: img,
      singlePrice: single_price,
      totalPrice: goodTotal
    }
    myStorage.setItem(fullname, JSON.stringify(good))
  }
  //如果不存在就新增商品

  else {
    $('#slide_buycart_goods').append($ul)
    $('#slide_buycart_accounttotal').html(+single_price)
    //也新增到願望清單中
    wantList.push(fullname)
    //也把物品放入localStorage
    var good = {
      name: fullname,
      count: count,
      img: img,
      singlePrice: single_price,
      totalPrice:(count * single_price)
    }
    myStorage.setItem(fullname, JSON.stringify(good))
    myStorage.setItem('wantList', wantList)
  }
  //-------------inputNumber 觸發單品加減與總數量加減-----------------------------//

  $(".slide_buycart_count").on('input', function () {
    var btn_count = $(this).val()

    if (btn_count > 0) {  //設定如果val()小於零時，自動刪除
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




