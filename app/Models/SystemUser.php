<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class SystemUser extends Model
{

use HasApiTokens, HasFactory, Notifiable;

protected $fillable = ['name','email','password'];

public static $rules = array(
'name' => 'required',
'email' => 'required|email',
'password' => 'required'
);
}
