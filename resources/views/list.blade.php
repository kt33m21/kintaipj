@extends('layouts.main_home')
<style>

.contents-box{
  text-align:center;
}

.today-contents{
  padding-top:10px;
  font-weight:bold;
  font-size:20px;
}

.today-contents{
  margin-bottom:80px;
}


th{
  padding-left:150px;
  padding-bottom:15px;

}

td{
  padding-left:150px;
  padding-bottom:15px;
}


</style>

@section('header')
@endsection

@section('contents')

<div class="contents-main">
<div class="contents-box">
<div class="today-contents">{{ $today }}</div>
</div>

<table>
    <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
    </tr>
    @foreach($items as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->start_time}}</td>
        <td>{{ $item->end_time }}</td>
        <td>{{ $item->rest_time }}</td>
        <td>{{ gmdate('H時間i分s秒',strtotime($item->end_time)-strtotime($item->start_time))}}</td>
    </tr>
    @endforeach
</table>

</div>
@endsection


@section('footer')
@endsection