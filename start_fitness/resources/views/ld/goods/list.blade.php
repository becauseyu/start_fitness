@extends('ld.nav2')



@section('title')
    <title>goods</title>
@endsection


@section('head')
    <link rel="stylesheet" href="/css/ld/member.css">
@endsection


@section('h1')
    <h1 class="text-center header01"> 庫存管理</h1>
@endsection

@section('content')
    <!--  表格首欄  -->
    <section class="mb-0 h4">
        <div class="row table-color m-0">
            <div class="col text-center">大分類</div>
            <div class="col text-center">商品名稱</div>
            <div class="col text-center">品牌</div>
            <div class="col text-center">口味</div>
            <div class="col text-center">圖片</div>
            <div class="col text-center">價格</div>
            <div class="col text-center">庫存</div>
            
            
        </div>
    </section>
    <!--  表格單筆  -->
    <div class="accordion " id="accordionExample">

        {{-- @foreach ($memberList as $member)
            <!--  單筆會員資料  -->
            <div class="card ">
                <div class="card-header01" id="heading{{ $member->mid }}">
                    <button class="btn01 btn-block" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $member->mid }}">
                        <div class="row">
                            <div class="col-1 text-center">{{ $member->mid }}</div>
                            <div class="col-4 text-center">{{ $member->name }}</div>
                            <div class="col-4 text-center">{{ $member->account }}</div>
                            <div class="col-3 text-center">{{ $member->status }}</div>
                        </div>
                    </button>
                </div>
                <div id="collapse{{ $member->mid }}" class="collapse" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th> ID </th>
                                <td> {{ $member->mid }} </td>
                            </tr>
                            <tr>
                                <th> 帳號 </th>
                                <td> {{ $member->account }} </td>
                            </tr>
                            <tr>
                                <th> 姓名 </th>
                                <td> {{ $member->name }} </td>
                            </tr>
                            <tr>
                                <th> email </th>
                                <td> {{ $member->email }} </td>
                            </tr>

                            <tr>
                                <th> 電話 </th>
                                <td> {{ $member->tel }} </td>
                            </tr>
                            <tr>
                                <th> 登入狀況 </th>
                                <td> 最後登入 : 2022-07-01 </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        @endforeach --}}




    </div>
@endsection


<!-- 上一頁/下一頁 -->
{{-- @section('prevPageUrl')
    {{ $memberList->previousPageUrl() }}
@endsection

@section('nextPageUrl')
    {{ $memberList->nextPageUrl() }}
@endsection --}}