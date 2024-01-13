<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('quizzes.update', ['quizId' => $quiz]) }}" method="post" style="display: flex; flex-direction: column; gap:10px; color: black;">
                        @csrf
                        @method('PUT')

                        <label for="name">Quiz Name:</label>
                        <input type="text" name="name" value="{{ $quiz->name }}">

                        <label for="description">Quiz Description:</label>
                        <textarea name="description">{{ $quiz->description }}</textarea>

                        <label for="photo">Quiz Photo URL:</label>
                        <input type="text" name="photo" value="{{ $quiz->main_photo }}">

                        <button type="submit" class="btn btn-primary">Update Quiz</button>
                    </form>

                    <div id="quizQuestions" style="margin-top: 30px;">

                        @foreach($quiz->questions as $index => $question)
                            <div id="question_{{ $question->id }}" style="color: white; font-size: 25px; margin-bottom: 20px">
                            <h3>Question {{ $index + 1 }}: {{ $question->question }}</h3>
                                <ul>
                                    <li>1. {{ $question->option1 }}</li>
                                    <li>2. {{ $question->option2 }}</li>
                                    <li>3. {{ $question->option3 }}</li>
                                    <li>4. {{ $question->option4 }}</li>
                                </ul>
                                <a href="{{ route('questions.edit', ['quiz' => $quiz, 'question' => $question]) }}" style="color: black; font-size: 25px; margin-bottom: 20px">Edit Question</a>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>