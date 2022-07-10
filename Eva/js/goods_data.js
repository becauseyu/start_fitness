// 小圖抓大圖
$('.smallImage01').on('click',function(){
  var src = $(this).attr('src');
  $('#bigImage').attr("src",src);
})

// 點字放口味欄
$('.item-icon').on('click',function(){
  var who = $(this).closest('.item-icon').html();
  $('.flaver').html(who);
})

$('.spicy').on('click',function(){
  var src01 = $('.sm-box').find('.spicy').attr('src');
  $('#bigImage').attr("src",src01);
})

$('.salt').on('click',function(){
  var src01 = $('.sm-box').find('.salt').attr('src');
  $('#bigImage').attr("src",src01);
})

$('.black').on('click',function(){
  var src01 = $('.sm-box').find('.black').attr('src');
  $('#bigImage').attr("src",src01);
})

$('.mocha').on('click',function(){
  var src01 = $('.sm-box').find('.mocha').attr('src');
  $('#bigImage').attr("src",src01);
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


