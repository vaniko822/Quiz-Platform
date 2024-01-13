<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function editQuestion(Quiz $quiz, Question $question)
    {
        return view('quizzes.edit', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'option1' => 'required|string|max:255',
            'option2' => 'required|string|max:255',
            'option3' => 'required|string|max:255',
            'option4' => 'required|string|max:255',
            'correct_option' => 'required|string|in:option1,option2,option3,option4',
        ]);

        $question->update($request->all());

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question updated successfully');
    }

}