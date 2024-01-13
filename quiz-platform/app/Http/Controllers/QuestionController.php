<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function showAddQuestionsForm($quizId)
    {
        // Retrieve the quiz based on $quizId
        $quiz = Quiz::findOrFail($quizId);

        return view('quizzes.add_questions', compact('quiz'));
    }

    public function storeQuestions(Request $request, $quizId)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_option' => 'required|string',
        ]);

        // Retrieve the quiz based on $quizId
        $quiz = Quiz::findOrFail($quizId);

        // Add a new question to the quiz
        $question = $quiz->questions()->create($validatedData);

        return redirect()->route('quizzes.add-questions', ['quizId' => $quizId])
            ->with('success', 'Question added successfully');
    }

}