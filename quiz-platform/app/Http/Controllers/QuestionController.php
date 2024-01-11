<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller {
    
    // Display the form to add a new question
    public function create(Quiz $quiz) {
        return view('questions.create', compact('quiz'));
    }

    // Store a newly created question in storage
    public function store(Request $request, Quiz $quiz) {
        $request->validate([
            'question' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_option' => 'required|in:option1,option2,option3,option4',
        ]);

        $questionData = $request->except(['_token']);
        $questionData['quiz_id'] = $quiz->id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/questions'), $imageName);
            $questionData['photo'] = 'uploads/questions/'.$imageName;
        }

        Question::create($questionData);

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question added successfully');
    }

    // Display the form to edit the specified question
    public function edit(Question $question) {
        return view('questions.edit', compact('question'));
    }

    // Update the specified question in storage
    public function update(Request $request, Question $question) {
        $request->validate([
            'question' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_option' => 'required|in:option1,option2,option3,option4',
        ]);

        $questionData = $request->except(['_token', '_method']);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/questions'), $imageName);
            $questionData['photo'] = 'uploads/questions/'.$imageName;
        }

        $question->update($questionData);

        return redirect()->route('quizzes.show', $question->quiz)->with('success', 'Question updated successfully');
    }

    // Remove the specified question from storage
    public function destroy(Question $question) {
        $quiz = $question->quiz;
        $question->delete();

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question deleted successfully');
    }
}