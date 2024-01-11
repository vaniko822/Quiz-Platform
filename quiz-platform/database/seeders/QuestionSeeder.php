<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run() {
        DB::table('questions')->truncate();

        DB::table('questions')->insert([
            'question' => 'What is the capital of France?',
            'photo' => null, 
            'option1' => 'Berlin',
            'option2' => 'London',
            'option3' => 'Paris',
            'option4' => 'Madrid',
            'correct_option' => 'option3',
            'position' => 1,
            'quiz_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'What is the capital of Georgia?',
            'photo' => null, 
            'option1' => 'Tbilisi',
            'option2' => 'London',
            'option3' => 'Paris',
            'option4' => 'Kutaisi',
            'correct_option' => 'option1',
            'position' => 2,
            'quiz_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'What is the capital of Turkey?',
            'photo' => null, 
            'option1' => 'Ankara',
            'option2' => 'New York',
            'option3' => 'Istanbul',
            'option4' => 'Paris',
            'correct_option' => 'option1',
            'position' => 3,
            'quiz_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
