@extends('ld.nav2')


{{--  頁籤標題 --}}
@section('title')

<title>order</title>

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
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">活動內容</th>
                <th scope="col">紀錄時間</th>


            </tr>
        </thead>
        <tbody>
            


            @foreach ($logList as $log)
            <tr>
                <th scope="row">{{$log->id}}</th>
                <td> {{$log->body}}</td>
                <td>{{$log->date}}</td>
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



