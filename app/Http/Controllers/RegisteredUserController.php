<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{

    public function create(){
    $items = SystemUser::all();
    return view('member_registration');
    }


    public function store(RegisterRequest $request)
    {
        $items = SystemUser::all();
        $this->validate($request, SystemUser::$rules);
        $form = $request->all();
        SystemUser::create($form);
        return view('registration_comp');

            $user = SystemUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
    ]);
    }



}
