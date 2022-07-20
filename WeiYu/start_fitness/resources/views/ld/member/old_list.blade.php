@extends('ld.nav')



@section('title')
    <title>member</title>
@endsection


@section('head')
@endsection


@section('h1')
    <h1 class="text-center"> 會員管理</h1>
@endsection

@section('content')
    <div class="container">

        <!--  表格首欄  -->
        <h2 class="mb-0 h4">
            <div class="row table-dark m-0 p-2">

                <div class="col-1 text-center">ID</div>
                <div class="col-4 text-center">姓名</div>
                <div class="col-4 text-center">帳號名稱</div>
                <div class="col-3 text-center">狀態</div>
            </div>
        </h2>


        <!--  表格單筆  -->
        <div class="accordion" id="accordionExample">

            @foreach ($memberList as $member)
                <!--  單筆會員資料  -->
                <div class="card">

                    <div class="card-header" id="heading1">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $member->id }}">
                                <div class="row">
                                    <div class="col-1 text-center">{{ $member->id }}</div>
                                    <div class="col-4 text-center">{{ $member->name }}</div>
                                    <div class="col-4 text-center">{{ $member->account }}</div>
                                    <div class="col-3 text-center">{{ $member->status }}</div>
                                </div>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $member->id }}" class="collapse" data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th> ID </th>
                                    <td> {{ $member->id }} </td>
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
            @endforeach



        </div>
        {{-- <!--  單筆會員資料  -->
        <div class="card">

            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse1">
                        <div class="row">
                            <div class="col-1 text-center">1</div>
                            <div class="col-4 text-center">你好</div>
                            <div class="col-4 text-center">aaa123</div>
                            <div class="col-3 text-center">正常</div>
                        </div>
                    </button>
                </h2>
            </div>

            <div id="collapse1" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th> ID </th>
                            <td> 1 </td>
                        </tr>
                        <tr>
                            <th> 帳號 </th>
                            <td> aaa123 </td>
                        </tr>
                        <tr>
                            <th> 姓名 </th>
                            <td> 你好 </td>
                        </tr>
                        <tr>
                            <th> email </th>
                            <td> 不知道 </td>
                        </tr>

                        <tr>
                            <th> 電話 </th>
                            <td> 0912345678 </td>
                        </tr>
                        <tr>
                            <th> 登入狀況 </th>
                            <td> 最後登入 : 2022-07-01 </td>
                        </tr>

                    </table>
                </div>
            </div>


        </div>

        <!--  單筆會員資料  -->
        <div class="card">

            <div class="card-header" id="heading2">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapse2">
                        <div class="row">
                            <div class="col-1 text-center">2</div>
                            <div class="col-4 text-center">我不好</div>
                            <div class="col-4 text-center">bbb456</div>
                            <div class="col-3 text-center">停權</div>
                        </div>
                    </button>
                </h2>
            </div>

            <div id="collapse2" class="collapse" data-parent="#accordionExample">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th> ID </th>
                            <td> 2 </td>
                        </tr>
                        <tr>
                            <th> 帳號 </th>
                            <td> bbb456 </td>
                        </tr>
                        <tr>
                            <th> 姓名 </th>
                            <td> 我不好 </td>
                        </tr>
                        <tr>
                            <th> email </th>
                            <td> OKOK@aa123.yaqoo.tp </td>
                        </tr>

                        <tr>
                            <th> 電話 </th>
                            <td> 0245874521 </td>
                        </tr>
                        <tr>
                            <th> 登入狀況 </th>
                            <td> 2022-07-02 停權 </td>
                        </tr>

                    </table>
                </div>
            </div>

        </div> --}}

    </div>
@endsection


<!-- 上一頁/下一頁 -->
@section('prevPageUrl')
    {{ $memberList->previousPageUrl() }}
@endsection

@section('nextPageUrl')
    {{ $memberList->nextPageUrl() }}
@endsection
