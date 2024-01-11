<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run() {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'Vaniko Kukutchanashvili', 
            'email' => 'vano.kukutchanashvili.1@btu.edu.ge', 
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
    }
}
