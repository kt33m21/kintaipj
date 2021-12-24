<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{

    public function create(){
    return view('member_registration');
    }

    public function store(RegisterRequest $request)
    {

    $user = SystemUser::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),]);
    return view('registration_comp');
    }
}
