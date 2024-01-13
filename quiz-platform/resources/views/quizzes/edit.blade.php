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
                    <form action="{{ route('questions.update', ['quiz' => $quiz, 'question' => $question]) }}" method="post" style="display: flex; flex-direction: column; gap:10px; color: black;">
                        @csrf
                        @method('PUT')

                        <label for="question">Question:</label>
                        <input type="text" name="question" value="{{ old('question', $question->question) }}" required>

                        <label for="photo">Photo URL:</label>
                        <input type="text" name="photo" value="{{ old('photo', $question->photo) }}" required>

                        <label for="option1">Option 1:</label>
                        <input type="text" name="option1" value="{{ old('option1', $question->option1) }}" required>

                        <label for="option2">Option 2:</label>
                        <input type="text" name="option2" value="{{ old('option2', $question->option2) }}" required>

                        <label for="option3">Option 3:</label>
                        <input type="text" name="option3" value="{{ old('option3', $question->option3) }}" required>

                        <label for="option4">Option 4:</label>
                        <input type="text" name="option4" value="{{ old('option4', $question->option4) }}" required>

                        <label for="correct_option">Correct Option:</label>
                        <select name="correct_option" required>
                            <option value="option1" {{ old('correct_option', $question->correct_option) === 'option1' ? 'selected' : '' }}>Option 1</option>
                            <option value="option2" {{ old('correct_option', $question->correct_option) === 'option2' ? 'selected' : '' }}>Option 2</option>
                            <option value="option3" {{ old('correct_option', $question->correct_option) === 'option3' ? 'selected' : '' }}>Option 3</option>
                            <option value="option4" {{ old('correct_option', $question->correct_option) === 'option4' ? 'selected' : '' }}>Option 4</option>
                        </select>

                        <button type="submit">Update Question</button>
                    </form>

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>