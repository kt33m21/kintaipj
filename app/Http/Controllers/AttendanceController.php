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
            'start_time' => Carbon::now()
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
        return redirect()->back()->with('my_status', '退勤打刻が完了しました。');
    }

    //休憩開始処置
    public function restStartWork()
    {
        $user = Auth::user();


        //当日の打刻状態を確認し、レコードが存在する場合は　Carbon::today型と形式を合わせる
        $oldTimeStamp = Rest::where('system_user_id', $user->id)->latest()->first();
        if ($oldTimeStamp) {
            $oldTimeStampStart = new Carbon($oldTimeStamp->start_time);
            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }
        $newTimeStampDay = Carbon::today();

        //当日休憩開始押済で、end_timeが入っていない場合はエラーを返す
        if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($oldTimeStamp->end_time))) {
            return redirect()->back()->with('error', 'すでに休憩開始打刻がされています。');
        }
        //勤務開始ボタン押下時、Restレコードのstart_timeに現時刻を投入
        $timeStamp = Rest::create([
            'system_user_id' => $user->id,
            'start_time' => Carbon::now()
            ]);
        return redirect()->back()->with('my_status', '休憩開始が完了しました。');
    }

    //休憩終了
    public function restEndWork()
    {
        $user = Auth::user();

        $timeStamp = Rest::where('system_user_id', $user->id)->latest()->first();

        $timeStamp->update([
            'end_time' => Carbon::now()
            ]);
        return redirect()->back()->with('my_status', '退勤打刻が完了しました。');
    }


    public function AttendanceList(Request $request)
    {
        $user = Auth::user();
        $date = Carbon::today()->format("Y-m-d");
        $items = Attendance::whereDate('start_time', $date)->paginate(5);
        return view('list', ['items' => $items],['today' => $date]);
    }
}

