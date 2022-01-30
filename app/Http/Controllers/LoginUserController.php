<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class LoginUserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function execution(LoginRequest $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        return back()->withErrors([
            'email' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }

    public function top(){

        $btn_start_attendance = false;
        $btn_end_attendance = false;
        $btn_start_rest = false;
        $btn_end_rest = false;

        $user_id = Auth::id();
        $today = Carbon::today()->format('Y-m-d');
        $now = Carbon::now()->format('H:i:s');
        $attendance = Attendance::where('system_user_id', $user_id)->where('start_time', $today)->first();



        //①今日出勤しているかどうか？
        if($attendance != null){ //データがある場合:「勤務開始」ボタンが押せない

            //②勤務終了時間が入っているか？
            if($attendance['end_time'] != null){//入っている場合：全てのボタンが押せない

            }else{//入っていない場合：③休憩中かどうか？

                $rest = Rest::where('attendance_id', $user_id)->where('start_time', $today)->orderBy('start_time', 'desc')->first();
                // $restの中身{user_id,work_day,start_rest,end_rest,create_date,update_date}

                if($rest != null){//データがある場合：④休憩終了時間があるかどうか？

                    if($rest['end_time'] != null){//入っている場合（休憩終了）：「勤務終了」「休憩開始」ボタンが押せる
                        $btn_end_attendance = true;
                        $btn_start_rest = true;
                    }else{//入っていない場合（休憩中）：「休憩終了」ボタンが押せる
                        $btn_end_rest = true;
                    }
                }else{//データがない場合：（休憩していない）：「勤務終了」「休憩開始」ボタンが押せる
                    $btn_end_attendance = true;
                    $btn_start_rest = true;
                }            
            }
        }else{//データがない場合:「勤務開始」ボタンが押せる
            $btn_start_attendance = true;
        }
            
        $btn_display = [//trueならボタン表示
        'btn_start_attendance' => $btn_start_attendance,
        'btn_end_attendance' => $btn_end_attendance,
        'btn_start_rest' => $btn_start_rest,
        'btn_end_rest' => $btn_end_rest,
        ];


        return view('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
