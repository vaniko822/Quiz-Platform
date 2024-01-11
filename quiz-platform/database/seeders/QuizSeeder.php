<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Http\Controllers\QuizController;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run() {
        Quiz::truncate();

        Quiz::create([
            'name' => 'General Knowledge Quiz',
            'main_photo' => 'https://kwizzbit.com/wp-content/uploads/2022/05/General-Knowledge-Quiz-Questions-min.jpg',
            'description' => 'Test your knowledge on a variety of topics.',
            'author_id' => 1,
        ]);

        Quiz::create([
            'name' => 'F1 Quiz',
            'main_photo' => 'https://media.contentapi.ea.com/content/dam/gin/images/2023/02/f123-gametile-16x9.jpg.adapt.crop1x1.767w.jpg',
            'description' => 'Test your knowledge on a variety of topics.',
            'author_id' => 1,
        ]);

        Quiz::create([
            'name' => 'Music Quiz',
            'main_photo' => 'https://daily.jstor.org/wp-content/uploads/2023/01/good_times_with_bad_music_1050x700.jpg',
            'description' => 'Test your knowledge on a variety of topics.',
            'author_id' => 1,
        ]);
    }
}
