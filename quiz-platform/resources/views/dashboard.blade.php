<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Main Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-11">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="display: flex; justify-content: space-between;">
                    <div>{{ __("Quezzies: ") }}</div>
                    <div><a href="{{ route('quizzes.create') }}" class="btn btn-primary" style="background: black; padding: 10px;">Add Quiz</a></div>
                </div>
                <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                @foreach($quizzes as $quiz)
                <div style="margin-left: 50px; margin-bottom: 20px;">
                    <h2 style="color: white;">Quiz Name: {{ $quiz->name }}</h2>
                    <img src="{{ $quiz->main_photo }}" alt="Quiz Photo Not Found" style="height:271px; max-height: 336px; max-width:336px; width: 263px;">
                    <p style="color: white;">{{ $quiz->questions->count() }} Questions</p>
                    <div>
                        <a href="{{ route('quizzes.show', $quiz) }}">Show Quiz Details</a>
                        <form action="{{ route('quizzes.delete', $quiz) }}" method="post" style="">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="background: red; padding: 5px;">Delete Quiz</button>
                        </form>
                        <a href="{{ route('quizzes.edit', $quiz) }}" style="margin-left: 10px;">Edit</a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
