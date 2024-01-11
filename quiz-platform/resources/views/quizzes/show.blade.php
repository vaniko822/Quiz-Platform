<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quiz Details') }}
        </h2>
    </x-slot>

    <div class="quiz-container" style="margin-left: 300px; margin-top: 80px;"> 
        <h1 style="font-size: 30px; color: white; font-weight: bold;">{{ $quiz->name }}</h1>
        <img src="{{ $quiz->main_photo }}" alt="Quiz Photo Not Found" style="height:271px; max-height: 336px; max-width:336px; width: 263px;">
        <p style="font-size: 30px; color: white;">Quiz Description: </p>
        <p style="font-size: 25px; color: white;">{{ $quiz->description }}</p>

        <div id="quizQuestions" style="margin-top: 30px;">
            @php
                $totalQuestions = count($questions);
            @endphp

            @foreach($quiz->questions as $index => $question)
                <div id="question_{{ $question->id }}" style="color: white; font-size: 25px; margin-bottom: 20px">
                <h3>Question {{ $index + 1 }} of {{ $totalQuestions }}: {{ $question->question }}</h3>
                    <ul>
                        <li>1. {{ $question->option1 }}</li>
                        <li>2. {{ $question->option2 }}</li>
                        <li>3. {{ $question->option3 }}</li>
                        <li>4. {{ $question->option4 }}</li>
                    </ul>
                </div>
            @endforeach
        </div>


        <button id="startQuiz" onclick="startQuiz({{ $quiz->id }})" style="color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Start Quiz</button>
        <button id="submitAnswer" onclick="submitAnswer({{ $quiz->id }}, {{ $question->id }})" style="display: none; color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Submit Answer</button>
        <button id="finishQuiz" style="display: none;">Finish Quiz</button>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function startQuiz(quizId) {
            $.post(`{{ route('quizzes.start', ['quiz' => $quiz->id]) }}`, function (data) {
            displayQuestion(data.question);
            });

            $('#submitAnswer').show();
            $('#startQuiz').hide();
        };

        let userQuestionCount = 0;

        function submitAnswer(quizId, questionId) {
            const selectedOption = $('input[name="selectedOption"]:checked').val();

            $.post(`{{ route('quizzes.submit-answer', ['quiz' => $quiz->id, 'question' => ':questionId']) }}`.replace(':questionId', questionId), { selectedOption }, function (data) {
                // Display whether the answer is correct
                displayResult(data.isCorrect);
                // Increment the user question count
                userQuestionCount++;
                // Display the next question
                displayQuestion(data.nextQuestion);
            });
        }

        function displayQuestion(question) {
                const questionHtml = `
                    <h3 style="color: white; font-size: 25px; margin-bottom: 20px">${question.question}</h3>
                    <ul style="color: white; font-size: 25px; margin-bottom: 20px">
                        <li><input type="radio" name="selectedOption" value="option1">${question.option1}</li>
                        <li><input type="radio" name="selectedOption" value="option2">${question.option2}</li>
                        <li><input type="radio" name="selectedOption" value="option3">${question.option3}</li>
                        <li><input type="radio" name="selectedOption" value="option4">${question.option4}</li>
                    </ul>
                `;
                $('#quizQuestions').html(questionHtml);
                console.log(question);
            }
        
        function displayResult(isCorrect) {
            const resultHtml = `<p style="color: white; font-size: 25px;">Your answer is ${isCorrect ? 'correct' : 'incorrect'}</p>`;
            $('#quizQuestions').append(resultHtml);
        }

    </script>

</x-app-layout>