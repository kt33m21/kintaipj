<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function execution(LoginRequest $request){
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect('home')->with('login_success','ログインに成功しました!');
        }

            return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }
}
