@extends('ld.nav2')



@section('title')
    <title>goods</title>
@endsection


@section('head')
    <link rel="stylesheet" href="/css/ld/goods.css">
    <link rel="stylesheet" href="/css/ld/member.css">
@endsection


@section('h1')
    <h1 class="text-center header01"> 庫存管理</h1>
@endsection

@section('content')
    <!--  表格首欄  -->
    <section class="mb-0 h4">
        <div class="row table-color m-0">
            <div class="col-1 text-center">大分類</div>
            <div class="col-3 text-center">商品名稱</div>
            <div class="col-3 text-center">品牌</div>
            <div class="col-2 text-center">圖片</div>
            <div class="col-3 text-center">
                <a href="Create.html" class="btn01 btn-outline" style="color: black ;" >
                    新增庫存資料
                </a>
            </div>
            
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
                <div class="card-header01" id="heading{{ $goods->pid }}">
                    <button class="btn01 btn-block" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $goods->pid }}">
                        <div class="row">
                            <div class="col-1 text-center">{{ $goods->ptype }}</div>
                            <div class="col-3 text-center">{{ $goods->pname }}</div>
                            <div class="col-3 text-center">{{ $goods->branddetail->bname }}</div>
                            <div class="col-2 text-center"><img height="100" src="{{ $goods->url }}"></div>
                            <div class="col-3 text-center">
                                <a href="/ld/goods/edit/{{$goods->pid}}" class="mr-1 btn01 btn-outline01 ">編輯</a> |
                                <a href="/Todo/Delete/1" class="ml-1 btn01 btn-outline02">刪除</a>
                            </div>
                        </div>
                    </button>
                </div>
                <div id="collapse{{ $goods->pid }}" class="collapse" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th> 流水號 </th>
                                <th> 口味 </th>
                                <th> 數量 </th>
                                <th> 圖片 </th>
                                <th> 價格 </th>
                            </tr>
                            @foreach ($goods->flavor as $flavor)
                                <tr>
                                    <th> {{ $flavor->pid }} </th>
                                    <th> {{ $flavor->pstyle }} </th>
                                    <th> {{ $flavor->pcount }} </th>
                                    <th> <img height="150" src="{{ $flavor->url }}"> </th>
                                    <th> $ {{ $flavor->pprice }} </th>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        @endforeach




    </div>
@endsection


<!-- 上一頁/下一頁 -->
{{-- @section('prevPageUrl')
    {{ $goodsList->previousPageUrl() }}
@endsection

@section('nextPageUrl')
    {{ $goodsList->nextPageUrl() }}
@endsection --}}
