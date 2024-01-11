<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model {
    protected $fillable = ['name', 'main_photo', 'description', 'author_id'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
