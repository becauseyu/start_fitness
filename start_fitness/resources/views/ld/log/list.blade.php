@extends('ld.nav2')


{{--  頁籤標題 --}}
@section('title')

<title>log活動記錄</title>

@endsection


{{--  網頁標題 --}}

@section('h1')

<h1 class="text-center header01"> 網站活動紀錄</h1>

@endsection


@section('head')
    <link rel="stylesheet" href="/css/ld/goods.css">
    <link rel="stylesheet" href="/css/ld/member.css">
@endsection





@section('content')
 





<div class="container">


    <br />
    <table class="table cen">
        <thead class="">
            <tr class="row table-log">
                <th class="col-2">Id</th>
                <th class="col-5">活動內容</th>
                <th class="col-5">紀錄時間</th>
            </tr>
        </thead>
        <tbody>
            


            @foreach ($logList as $log)
            <tr class="row log-content">
                <th class="col-2">{{$log->id}}</th>
                <td class="col-5"> {{$log->body}}</td>
                <td class="col-5">{{$log->date}}</td>
            </tr> 
            @endforeach
            




        </tbody>
    </table>



</div>
@endsection


<!-- 上一頁/下一頁 -->
@section('prevPageUrl')
{{$logList->previousPageUrl()}}
@endsection

@section('nextPageUrl')
{{$logList->nextPageUrl()}}
@endsection   



