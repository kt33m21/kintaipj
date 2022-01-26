@extends('layouts.main_home')
<style>

.contents-box{
  text-align:center;
}

.day-list{
  color:blue;
}


.today-contents{
  font-weight:bold;
  font-size:20px;
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
  <div class="arrow-button-back">
    <form action="{{route('/attendance/attendance')}}" method="post">
        @csrf
        <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
        <input type="hidden" class="flg" name="dayflg" value="back">
        <input type="submit" name="" value="<" class="day-list" id="back_btn">
    </form>
  </div>

  <div class="today-contents">{{ $today }}</div>

  <div class="arrow-button-next">
    <form action="{{route('/attendance/attendance')}}" method="post">
        @csrf
        <input type="hidden" class="form-control" id="today" name="today" value={{ $today }}>
        <input type="hidden" class="flg" name="dayflg" value="next">
        <input type="submit" name="" value=">" class="day-list" id="next_btn">
    </form>
  </div>

</div>

<table>
    <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)
    <tr>
        <td>{{ $attendance->name }}</td>
        <td>{{ substr($attendance->start_time,10)}}</td>
        <td>{{ substr($attendance->end_time,10) }}</td>
        @foreach($rests as $rest)
        {{--<td>{{ $rest->rest_time }}</td>--}}
        @endforeach
        <td>{{ gmdate('H:i:s',(strtotime($attendance->end_time))-strtotime($attendance->start_time))}}</td>
    </tr>
    @endforeach
</table>
</div>
@endsection


@section('footer')
@endsection