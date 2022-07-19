$('.footerpage').load('/MengYing/大專/LAB/footer.html')

// 圖片hover

$('.good_img').hover(hoverIn, hoverout)

function hoverIn(img) {
    //得到該圖片的路徑
    var url = $(this).prop('src'); //圖片的完整路徑
    var pic_url = (url.split('/'))[7]; //得到圖片檔案完整名稱
    var pic_name = (pic_url.split('.'))[0]; //得到檔案名稱+數字
    var url_road = (url.split(pic_url))[0];//得到前面剩餘路徑
    var pic_num = parseInt(pic_name.replace(/[^0-9]/ig, "")); //得檔案的數字
    var pic_num_next = pic_num + 1;
    if (pic_num_next <= 10) {
        pic_num_next = "0" + pic_num_next;
    } else {
        pic_num_next
    }
    var pic_name_pre = (pic_name.split(pic_num))[0]; //得到檔案不含數字的部分
    var pic_style = (pic_url.split('.'))[1] //得到副檔名稱
    $(this).attr('src', url_road + pic_name_pre + pic_num_next + "." + pic_style)
 

}

function hoverout(img) {
    //  //得到該圖片的路徑
    var url = $(this).prop('src'); //圖片的完整路徑
    var pic_url = (url.split('/')[7]); //得到圖片檔案完整名稱
    var pic_name = (pic_url.split('.'))[0]; //得到檔案名稱+數字
    var url_road = (url.split(pic_url))[0];//得到前面剩餘路徑
    var pic_num = parseInt(pic_name.replace(/[^0-9]/ig, "")); //得檔案的數字
    var pic_num_next = pic_num - 1;
    if (pic_num_next <= 0) {
        pic_num_next = "0"
    } else if (pic_num_next <= 10) {
        pic_num_next = "0" + pic_num_next;
    }
    else {
        pic_num_next
    }
    var pic_name_pre = (pic_name.split(pic_num))[0]; //得到檔案不含數字的部分
    var pic_style = (pic_url.split('.'))[1] //得到副檔名稱
    //  console.log((url_road+pic_name_pre+pic_num_next+"."+pic_style))
    $(this).attr('src', url_road + pic_name_pre + pic_num_next + "." + pic_style)

}


