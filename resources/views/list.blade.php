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


th{
  vertical-align:center;
  padding:15px;
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
        <td>{{ $item->system_user_id }}</td>
        <td>{{ $item->start_time}}</td>
        <td>{{ $item->end_time }}</td>
        <td>{{ $item->rest_time }}</td>
    </tr>
    @endforeach
</table>

</div>
@endsection


@section('footer')
@endsection