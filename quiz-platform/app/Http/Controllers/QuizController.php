<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller {
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'asc')->get();
        return view('dashboard', compact('quizzes'));
    }

    public function show(Quiz $quiz) {
        $questions = $quiz->questions;
        return view('quizzes.show', compact('quiz', 'questions'));
    }

    public function create() {
        return view('quizzes.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        
        $photoPath = $request->file('photo')->store('quiz_photos', 'public');

        $quiz = new Quiz([
            'name' => $request->input('name'),
            'main_photo' => $request->input('photo'),
            'description' => $request->input('description'),
            'author_id' => $user->id,
        ]);

        $quiz->save();

        return redirect()->route('dashboard')->with('success', 'Quiz added successfully');
    }

    public function start(Request $request, Quiz $quiz)
    {
        $firstQuestion = $quiz->questions()->first();

        return response()->json(['question' => $firstQuestion]);
    }

    public function submitAnswer(Quiz $quiz, Question $question, Request $request)
    {
        $correctOption = $question->correct_option;
        $isCorrect = ($request->selectedOption === $correctOption);
        $nextPosition = $question->position + 1;

        $nextQuestion = $quiz->questions()->where('position', $nextPosition)->first();
        return response()->json(['isCorrect' => $isCorrect, 'nextQuestion' => $nextQuestion]);
    }

    public function finish(Quiz $quiz)
    {
        // Implement logic to finish the quiz
        // Calculate and return the final score
        return response()->json(['score' => 10]); // Replace 10 with the actual score
    }

}

