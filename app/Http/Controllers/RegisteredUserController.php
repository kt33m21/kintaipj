<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function test(){
        return view('test');
    }

    public function create(){
    $items = SystemUser::all();
    return view('member_registration', ['items' => $items]);
    }

    public function search(Request $request)
    {
        $item = SystemUser::where('name','email','password','LIKE',"%{$request->input}%")->get();
        $param = [
            'input' => $request->input,
            'item' => $items
        ];
    }

    public function store(Request $request)
    {
        $items = SystemUser::all();
        $this->validate($request, SystemUser::$rules);
        $form = $request->all();
        SystemUser::create($form);
        return redirect('registration_comp');
    }


}
