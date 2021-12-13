<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function test(){
        return view('test');
    }

    public function create(){
    return view('member_registration');
    }

}
