<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SystemUser;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //勤務開始処置
    public function attendanceWork()
    {
        $user = Auth::user();

        $timestampstart = Carbon::today();


        $timestamp = Attendance::create([
            'system_user_id' => $user->id,
            'start_time' => Carbon::now()
        ]);

    //1日1回しか押せないようにする
        if($timestampstart == $timestamp){
        return redirect->with('error', 'すでに打刻済の為、押せません');
    }

        return redirect()->back()->with('status', '出勤打刻が完了しました。');
    }

    //退勤処理
    public function leavingWork()
    {
        $user = Auth::user();
        $timestamp = Attendance::where('system_user_id', $user->id)->latest()->first();

        if (!empty($timestamp->punchOut)) {
            return redirect()->back()->with('error', '既に退勤の打刻がされているか、出勤が打刻されていません。');
        } else {
            $timestamp->update([
                'end_time' => Carbon::now()
            ]);

            return redirect()->back()->with('status', '退勤打刻が完了しました。');
        }
    }


    //休憩開始処理
    public function reststartWork()
    {
        $user = Auth::user();

        $startattendance = Attendance::where('system_user_id', $user->id)->latest()->first();

        $timestamp = Rest::create([
            'system_user_id' => $user->id,
            'attendance_id' => $startattendance->id,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('status', '休憩開始打刻が完了しました。');
    }

    //休憩終了処理
    public function restendWork()
    {
        $user = Auth::user();
        $timestamp = Rest::where('system_user_id', $user->id)->latest()->first();
        $attendance = Attendance::where('system_user_id', $user->id)->latest()->first();

        if (!empty($timestamp->punchOut)) {
            return redirect()->back()->with('error', '既に休憩終了の打刻がされているか、休憩開始が打刻されていません。');
        }

        $timestamp->update([
            'end_time' => Carbon::now()
        ]);

        //休憩時間取得
        $timestamp = Rest::where('system_user_id', $user->id)->latest()->first();

        // print($timestamp);

        $data = Rest::select(DB::raw('timediff(end_time,start_time) as resttime'))->where('id', $timestamp->id)->value('resttime');

        // print($data);

        //休憩時間合算
        //attendanceテーブルの休憩時間現在値取得
        // print($timestamp->id);
        $restdata = Attendance::select(DB::raw('rest_time'))->where('id', $timestamp->attendance_id)->value('rest_time');

        // print($restdata);


        $sum = DB::select('select addtime(:restdata, :data) as sum', ['restdata' => $restdata, 'data' => $data]);

        // var_dump($sum);
        print($sum);

        $attendance->update([
            'rest_time' => $sum
        ]);

        return redirect()->back()->with('status', '休憩終了時間打刻が完了しました。');
    }

    //public function AttendanceList()
    //{
    //    return view('attendance');
    //    }
}

