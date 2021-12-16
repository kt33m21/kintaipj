<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemUsersTableSeeder extends Seeder
{

    public function run()
    {
$param = [
            'name' => '宮下 透',
            'email' => 'kk45@gmail.com',
            'password' => 'takosuke45'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '片岡 洋介',
            'email' => 'ss32@gmail.com',
            'password' => 'ikasuke32'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '岡野 健太郎',
            'email' => 'jj88@gmail.com',
            'password' => 'nakumo88'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '佐々木 圭子',
            'email' => 'kg22@gmail.com',
            'password' => 'namida22'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '田中 真美',
            'email' => 'tk777@gmail.com',
            'password' => '777takokaina'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '横井 早苗',
            'email' => 'kkr288jk@gmail.com',
            'password' => 'nyanko228nyanko'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => 'Jack Score',
            'email' => '555kiki@gmail.com',
            'password' => 'kiki555kiki'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => 'はしもと わたる',
            'email' => '7575sin@gmail.com',
            'password' => '7575wataru'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '若菜 隆二',
            'email' => 'sasadango2@gmail.com',
            'password' => 'sasadango3'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '椎葉 猛',
            'email' => 'takeru54@gmail.com',
            'password' => 'takeru4545'
        ];
        DB::table('system_users')->insert($param);

        $param = [
            'name' => '丹羽 恵美',
            'email' => 'emi3dayo@gmail.com',
            'password' => 'emi3dayo'
        ];
        DB::table('system_users')->insert($param);
    }
}
