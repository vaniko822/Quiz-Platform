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

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>