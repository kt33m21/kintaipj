<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SystemUser;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //勤務開始処置
    public function attendanceWork()
    {
        $user = Auth::user();


        //当日の打刻状態を確認し、レコードが存在する場合は　Carbon::today型と形式を合わせる
        $oldTimeStamp = Attendance::where('system_user_id', $user->id)->latest()->first();
        if ($oldTimeStamp) {
            $oldTimeStampStart = new Carbon($oldTimeStamp->start_time);
            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }
        $newTimeStampDay = Carbon::today();

        //当日勤務開始押済で、end_timeが入っていない場合はエラーを返す
        if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($oldTimeStamp->end_time))) {
            return redirect()->back()->with('error', 'すでに出勤打刻がされています。');
        }
        //勤務開始ボタン押下時、attendancesレコードのstart_timeに現時刻を投入
        $timeStamp = Attendance::create([
            'system_user_id' => $user->id,
            'start_time' => Carbon::now(),
            'rest_time' => '00:00:00'
            ]);
        return redirect()->back()->with('my_status', '出勤打刻が完了しました。');
    }

    //退勤処理
    public function leavingWork()
    {
        $user = Auth::user();

        $timeStamp = Attendance::where('system_user_id', $user->id)->latest()->first();

        $timeStamp->update([
            'end_time' => Carbon::now()
            ]);

      
        return redirect()->back()->with('my_status', '休憩終了時間打刻が完了しました。');
    }


    //休憩開始処置
    public function restStartWork()
    {

        $user_id = Auth::id();
        $attendance =Attendance::where('system_user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();
        
        if ($timeStamp) {
            $oldTimeStampStart = new Carbon($timeStamp->start_time);
            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }
        $newTimeStampDay = Carbon::today();

        //当日勤務開始押済で、end_timeが入っていない場合はエラーを返す
        if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($timeStamp->end_time))) {
            return redirect()->back()->with('error', 'すでに休憩開始が押されています。');
            }

        //休憩開始ボタン押下時、Restレコードのstart_timeに現時刻を投入
        $items = Rest::create([
            'attendance_id'=>$attendance->id,
            'start_time' => Carbon::now(),
        ]);
        return redirect()->back()->with('my_status', '休憩開始が完了しました。');
    }

    //休憩終了
    public function restEndWork()
    {
        $user_id = Auth::id();
        $attendance =Attendance::where('system_user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();

    //休憩終了処理
        $timeStamp->update([
            'end_time' => Carbon::now()
            ]);

        return redirect()->back()->with('my_status', '退勤打刻が完了しました。');
    }


    public function AttendanceList(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $date = Carbon::today()->format("Y-m-d");

        $attendance =Attendance::where('system_user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();
        

        //休憩時間合計処理
        $restStartTimeData = $timeStamp->sum('start_time');
        $restEndTimeData = $timeStamp->sum('end_time');

        $restTotalTimeData = $restEndTimeData-$restStartTimeData;

        //ビューページのitemsを定義
        $items = Attendance::whereDate('start_time', $date)->join('system_users','system_users.id','=','attendances.system_user_id')->paginate(5)->items();
        
        return view('list', ['items' => $items],['today' => $date]);
    }
}

