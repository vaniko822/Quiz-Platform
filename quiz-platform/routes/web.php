<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [QuizController::class, 'index'] ,function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('quizzes', QuizController::class);

Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::post('quizzes/{quiz}/start', [QuizController::class, 'start'])->name('quizzes.start');
Route::post('quizzes/{quiz}/questions/{question}/submit-answer', [QuizController::class, 'submitAnswer'])->name('quizzes.submit-answer');
Route::delete('/quizzes/{quiz}', [QuizController::class, 'delete'])->name('quizzes.delete');
Route::post('/quizzes/{quiz}/finish', [QuizController::class, 'finish'])->name('quizzes.finish');
Route::get('/quizzes/{quizId}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
Route::put('/quizzes/{quizId}', [QuizController::class, 'update'])->name('quizzes.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/quizzes/add-questions/{quizId}', [QuestionController::class, 'showAddQuestionsForm'])->name('quizzes.add-questions');
Route::post('/quizzes/store-questions/{quizId}', [QuestionController::class, 'storeQuestions'])->name('quizzes.storeQuestions');

//Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
//Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
//Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
//Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
//Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

require __DIR__.'/auth.php';
