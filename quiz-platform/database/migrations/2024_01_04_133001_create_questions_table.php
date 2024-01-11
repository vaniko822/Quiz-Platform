<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration {
    public function up() {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('photo')->nullable();
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->string('correct_option');
            $table->integer('position');
            $table->foreignId('quiz_id')->constrained('quizzes');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('questions');
    }
}
