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

        DB::table('questions')->insert([
            'question' => 'Who is Formula 1 Driver?',
            'photo' => null, 
            'option1' => 'Jason Statham',
            'option2' => 'Max Verstappen',
            'option3' => 'Vin Diseal',
            'option4' => 'Paul Walker',
            'correct_option' => 'option2',
            'position' => 1,
            'quiz_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'Who won the first-ever Formula 1 World Championship in 1950?',
            'photo' => null, 
            'option1' => 'Jason Statham',
            'option2' => 'Max Verstappen',
            'option3' => 'Vin Diseal',
            'option4' => 'Giuseppe Farina',
            'correct_option' => 'option4',
            'position' => 2,
            'quiz_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'Who is the youngest-ever Formula 1 World Champion? ',
            'photo' => null, 
            'option1' => 'Sebastian Vettel',
            'option2' => 'Max Verstappen',
            'option3' => 'Michael Schumacher',
            'option4' => 'Clay Regazzoni',
            'correct_option' => 'option1',
            'position' => 3,
            'quiz_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'What was Freddie Mercurys real name?',
            'photo' => null, 
            'option1' => 'Sebastian Vettel',
            'option2' => 'Farrokh Bulsara',
            'option3' => 'Beyoncé',
            'option4' => 'Brie Larson',
            'correct_option' => 'option2',
            'position' => 1,
            'quiz_id' => 3, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('questions')->insert([
            'question' => 'Keith Moon and John Entwistle of The Who are said to have inspired the name of which other classic rock band?',
            'photo' => null, 
            'option1' => 'Queen',
            'option2' => 'Bedford Falls',
            'option3' => 'Led Zeppelin',
            'option4' => 'Loud Speakers',
            'correct_option' => 'option3',
            'position' => 2,
            'quiz_id' => 3, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
