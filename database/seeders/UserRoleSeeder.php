<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Admin',
            'email'=> 'johndoem@gmail.com',
            'phone'=>'0789000000',
            'address'=>'Kampala',
            'role'=> 1,
            'password'=> Hash::make(env('ADMIN_SEEDER_PASSWORD ', ''))
        ]);
    }
}
