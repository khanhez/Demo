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
        $data=[
        	[
        		'email'=>'khanh@gmail.com',
        		'password'=>bcrypt('1234'),
        		'level'=>1
        	],
        	[
        		'email'=>'admn@gmail.com',
        		'password'=>bcrypt('1234'),
        		'level'=>1
        	],
        ];
        DB::table('vp_users')->insert($data);
    }
}
