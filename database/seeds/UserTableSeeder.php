<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'KienNguyen',
            'address'=>'HaTinh',
            'phone'=>'0988888888',
            'level'=>'admin',
            'email'=>'lordofking83@gmail.com',
            'password'=>bcrypt('123456')
        ]);
    }
}
