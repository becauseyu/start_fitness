$('.footerpage').load('/MengYing/大專/LAB/footer.html')

// 飲食的hover

$(function(){
    $(this).find('.food').hover(
        $(this).attr("src", "../asset/saleitem/food/fruitwater01.webp")
    );

    
});



// $(function () {
//   var itemnum = 0;
//   itemnum = $('.food').length;

//   //建立　換圖function
//   function menu(i) {
//     $('.food').eq(i).hover(
//       function () {
//         $(this).attr("src", "../asset/saleitem/food/0" + i + ".1.webp");
//       },
//       function () {
//         $(this).attr("src", "../asset/saleitem/food/0" + i + ".webp")
//       })
//   };
//   // 執行　function
//   for (i = 0; i < itemnum; i++) {
//     menu(i);
//   }

// })

// 動動的hover
// $(function () {
//   var itemnum = 0;
//   itemnum = $('.gym').length;

//   //建立　換圖function
//   function menu(i) {
//     $('.gym').eq(i).hover(
//       function () {
//         $(this).attr("src", "../asset/saleitem/gym/0" + i + ".1.webp")
//       },
//       function () {
//         $(this).attr("src", "../asset/saleitem/gym/0" + i + ".webp")
//       })
//   };
//   // 執行　function
//   for (i = 0; i < itemnum; i++) {
//     menu(i);
//   }

// })



