<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemUser;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';

    protected $fillable = ['system_user_id', 'start_time', 'end_time'];

    public function systemuser()
    {
        $this->belongsTo(SystemUser::class);
    }
}

