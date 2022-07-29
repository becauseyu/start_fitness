@extends('ld.nav2')



@section('title')
    <title>goods</title>
@endsection


@section('head')
    <link rel="stylesheet" href="/css/ld/goods.css">
    <link rel="stylesheet" href="/css/ld/member.css">
@endsection


@section('h1')
    <div class="text-center">
        <h5 class="header01"> 庫存管理
            <p class="notice">*如要編輯產品請先下架</p>
        </h5>
    </div>
@endsection

@section('content')
    <div class="mb-2 ">
        <a href="/ld/goods/create" class="btn-add">
            新增商品
        </a>
    </div>
    <!--  表格首欄  -->
    <section class="mb-0 h4">
        <div class="row table-color m-0">
            <div class="col-1 text-center">分類</div>
            <div class="col-3 text-center">商品名稱</div>
            <div class="col-3 text-center">品牌</div>
            <div class="col-2 text-center">圖片</div>
            <div class="col-3 text-center">功能</div>
            {{-- <div class="col text-center">口味</div>
            <div class="col text-center">價格</div>
            <div class="col text-center">庫存</div> --}}
        </div>
    </section>
    <!--  表格單筆  -->
    <div class="accordion " id="accordionExample">

        @foreach ($goodsList as $goods)
            <!--  單筆會員資料  -->
            <div class="card ">
                <form id="a{{ $goods->pid }}" action="/ld/goods/bigEdit" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="pid" value="{{ $goods->pid }}" />
                    <div class="card-header01" id="heading{{ $goods->pid }}">
                        <button class="btn01 btn-block headButton" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $goods->pid }}">
                            <div class="row cen10">
                                <div class="col-1 text-center ptype">{{ $goods->ptype }}</div>
                                <div class="col-3 text-center pname">{{ $goods->pname }}</div>
                                <div class="col-3 text-center bname">{{ $goods->branddetail->bname }}</div>
                                <div class="col-2 text-center "><img height="100" src="{{ $goods->url }}"
                                        class="rounded"></div>
                                <div class="col-3 cen text-center button_bag">

                                    @if ($goods->staid == '1')
                                        <a href="/ld/goods/takeDown/{{ $goods->pid }}" onclick="cancelBub(event)">
                                            <div class="mr-1 btn-off">下架</div>
                                        </a>
                                    @else
                                        <a href="/ld/goods/onShelf/{{ $goods->pid }}" onclick="cancelBub(event)"
                                            style="text-decoration: none;">
                                            <div class="mr-1 btn-on">上架</div>
                                        </a>
                                        |
                                        <div class="mr-1 btn-edit" onclick="bigEdit('a{{ $goods->pid }}')">編輯
                                        </div>
                                        |
                                        <a href="/ld/goods/deleteAll/{{ $goods->pid }}" onclick="cancelBub(event)">
                                            <div class="ml-1 btn-delete">刪除</div>
                                        </a>
                                    @endif



                                </div>
                            </div>
                        </button>
                    </div>
                </form>
                <div id="collapse{{ $goods->pid }}" class="collapse body" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table-striped cen-table">
                            <tr class="f-header">
                                <th> 流水號 </th>
                                <th> 口味 </th>
                                <th> 數量 </th>
                                <th> 圖片 </th>
                                <th> 價格 </th>
                                <th></th>
                            </tr>
                            @foreach ($goods->flavor->where('staid', '!=', '2') as $flavor)
                                <tr>
                                    <form class="h5" id="b{{ $flavor->pid }}" action="/ld/goods/smallEdit"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <th><input class="f-input  f-size " id="pid{{ $flavor->pid }}" name='pid'
                                                form="b{{ $flavor->pid }}" value="{{ $flavor->pid }}" size="1"
                                                disabled />
                                        </th>

                                        <th><input class="f-input  f-size " id="pstyle{{ $flavor->pid }}" name='pstyle'
                                                form="b{{ $flavor->pid }}" value="{{ $flavor->pstyle }}"
                                                size='10'disabled />
                                        </th>


                                        <th><input class="f-input  f-size " id="pcount{{ $flavor->pid }}" name='pcount'
                                                form="b{{ $flavor->pid }}" value="{{ $flavor->pcount }}" size='10'
                                                disabled />
                                        </th>


                                        <th id="ppic{{ $flavor->pid }}"> <img height="120" src="{{ $flavor->url }}"
                                                id="img{{ $flavor->pid }}" class="rounded " />
                                        </th>



                                        <th> <span><input class="f-input  f-size " id="pprice{{ $flavor->pid }}"
                                                    name='pprice' orm="b{{ $flavor->pid }}"
                                                    value="${{ $flavor->pprice }}" size='10' disabled /></span>
                                        </th>


                                        <th id="button_bag{{ $flavor->pid }}">
                                            @if (!$flavor->staid)
                                                <div class="mr-1 btn-edit01 css-edit"
                                                    onclick="smallEdit('{{ $flavor->pid }}')">編輯
                                                </div> |
                                                <a href="/ld/goods/deleteOne/{{ $flavor->pid }}"
                                                    onclick="cancelBub(event)">
                                                    <div class="ml-1 btn-delete01">刪除</div>
                                                </a>
                                            @endif

                                        </th>
                                    </form>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        @endforeach




    </div>
@endsection

@section('script')
    <script>


        // 大標題修改
        function bigEdit(id) {
            // 取得品牌資料
            var brandList_url = window.location.origin + '/ld/branddetail/list';
            var brandList = getList(brandList_url);

            // 取得大分類資料
            var ptypeList_url = window.location.origin + '/ld/ptype/list';
            var ptypeList = getList(ptypeList_url);


            // 先取得目標表單
            getForm = document.getElementById(id);

            // 鎖住原本的表格不要亂動
            getForm.querySelector('.headButton').setAttribute("data-target", '');


            // 所有可輸入值置換成input

            // ptype----------------
            ptype = getForm.querySelector('.ptype');
            ptype_html = `<select name='ptype' value = '${ptype.innerText}'>`;
            ptypeList.forEach((option) => {
                if (ptype.innerText == option.ptype) {
                    ptype_html += `<option value='${option.ptype}' selected>${option.ptype}</option>`;
                } else {
                    ptype_html += `<option value='${option.ptype}' >${option.ptype}</option>`;
                }

            })
            ptype_html += `</select>`;

            ptype.innerHTML = ptype_html;

            // pname----------------
            pname = getForm.querySelector('.pname');
            pname.innerHTML = `<input name='pname' value ='${pname.innerText}'>`;

            // bname
            bname = getForm.querySelector('.bname');
            bname_html = `<select name='bid' value = '${bname.innerText}'>`;
            brandList.forEach((option) => {
                if (bname.innerText == option.bname) {
                    bname_html += `<option value='${option.bid}' selected>${option.bname}</option>`;
                } else {
                    bname_html += `<option value='${option.bid}'>${option.bname}</option>`;
                }

            })
            bname_html += `</select>`;
            bname.innerHTML = bname_html;

            // button_bag
            getForm.querySelector('.button_bag').innerHTML = `
                <input type="submit" class="mr-1 btn-ok01" value='完成'></div> |
                <a href='/ld/goods/list' class="ml-1 btn-delete01">取消</a>
            `;


            // 其他不相干表單隱藏
            getAllForm = document.querySelectorAll(`form`);
            getAllForm.forEach(($element) => {
                if ($element.id != id) {
                    console.log($element);
                    $element.style.visibility = 'hidden';
                    $element.style.position = 'fixed';
                }
            })
        }





        // 小口味修改
        function smallEdit(id) {
            // 先取得目標表單
            // getForm = document.getElementById(id);
            // console.log(getForm)
            // 鎖住原本的表格不要亂動
            // getForm.querySelector('.headButton').setAttribute("data-target", '');
            // getForm.querySelector('.body').classList.remove("collapse");


            // 所有可輸入值置換成input
            // pid 、 pstyle 、 pcount 、 pprice
            // ptype----------------

            // pid------------------
            document.getElementById('pid' + id).disabled = false;
            document.getElementById('pid' + id).readOnly = true;

            // pstyle
            document.getElementById('pstyle' + id).disabled = false;
            document.getElementById('pstyle' + id).classList.remove('f-input');

            // pcount
            document.getElementById('pcount' + id).disabled = false;
            document.getElementById('pcount' + id).classList.remove('f-input');


            // pprice
            document.getElementById('pprice' + id).disabled = false;
            document.getElementById('pprice' + id).classList.remove('f-input');


            // button_bag
            document.getElementById('button_bag' + id).innerHTML = `
                <input form='b${id}' type="submit" class="mr-1 btn-ok01" value='完成'></div> |
                <a href='' onClick='window.location.reload' class="ml-1 btn-delete01">取消</a>
            `


            // 插入圖片
            document.getElementById('ppic' + id).innerHTML +=
                `
                <label class="btn btn-info fileinput">
                <span>更新圖片</span>
                    <input accept = "image/*" class="b1 img-up " type = 'file'  form='b${id}' name="file${id}"  id = "file${id}" / >
                </label >
                `;

            // 


            // 加入預覽事件
            document.getElementById('file' + id).onchange = evt => {
                const [file] = document.getElementById('file' + id).files
                if (file) {
                    document.getElementById('img' + id).src = URL.createObjectURL(file)

                }
            }

            // pid ptype pname bname pstyle pcount pprice



            // getAllInput.forEach(($element)=>{
            //     $element.innerHTML = `<input value ='${$element.innerHTML}'' ></input>`
            // } )















            // 其他不相干表單隱藏
            getAllForm = document.querySelectorAll(`form`);
            getAllForm.forEach(($element) => {
                if ($element.id != id) {

                    $element.style.visibility = 'hidden';
                    $element.style.position = 'fixed';
                }
            })
        }







        // xttp請求取得表單資料
        function getList(url) {
            var xhttp = new XMLHttpRequest();
            //如果當xhttp發生改變時，發生後面的callback(回乎函式) //閉包
            xhttp.onreadystatechange = function() {
                //200 :畫面載入成功(404是失敗)
                if (xhttp.readyState == 4 && xhttp.status == 200) {

                    if (xhttp.responseText != 0) { //帳號無重複 //xhttp.responseText 來自後端
                        console.log('get List data')

                    } else {
                        console.log('get nothing')
                    }
                }
            };

            // 不使用非同步功能
            xhttp.open('GET', url, false);
            //send請求
            xhttp.send();
            return JSON.parse(xhttp.responseText);
        }





        // 預覽圖片(照抄別人)
        // imgInp.onchange = evt => {
        //     const [file] = imgInp.files
        //     if (file) {
        //         blah.src = URL.createObjectURL(file)
        //     }
        // }
        // <form runat = "server" >
        // <input accept = "image/*" type = 'file'id = "imgInp" / >
        // <img id = "blah" src = "#" alt = "your image" / >
        // </form>



        // 取消bubble
        cancelBub = (e) => {
            e.stopPropagation();
        }
    </script>
@endsection



<!-- 上一頁/下一頁 -->
@section('prevPageUrl')
    {{ $goodsList->previousPageUrl() }}
@endsection

@section('nextPageUrl')
    {{ $goodsList->nextPageUrl() }}
@endsection
