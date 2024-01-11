<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $fillable = ['question', 'photo', 'option1', 'option2', 'option3', 'option4', 'correct_option', 'position', 'quiz_id'];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}

