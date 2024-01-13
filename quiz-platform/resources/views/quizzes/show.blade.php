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

        <div id="quizResults" style="display: none; color: white; font-size: 25px; margin-bottom: 20px; margin-top: 20px;"></div>

        <button id="startQuiz" onclick="startQuiz({{ $quiz->id }})" style="color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Start Quiz</button>
        <button id="submitAnswer" onclick="submitAnswer({{ $quiz->id }}, {{ $question->id }})" style="display: none; color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Submit Answer</button>
        <button id="finishQuiz" onclick="finishQuiz({{ $quiz->id }})" style="display:none; color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Finish Quiz</button>
        <a href="{{ route('dashboard') }}" id="backBtn" style="display:none; color: white; font-size: 25px; background: black; padding: 8px; border-radius: 10px;">Go Back to Main Page</a>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let currentQuestionId;

        function startQuiz(quizId) {
            $.post(`{{ route('quizzes.start', ['quiz' => $quiz->id]) }}`, function (data) {
            displayQuestion(data.question);
            currentQuestionId = data.question.id;

            $(`#submitAnswer`).show();
            $('#startQuiz').hide();
            });
        };

        let SumCorrectAnswers = 0;

        function submitAnswer(quizId, questionId) {
            const selectedOption = $('input[name="selectedOption"]:checked').val();

            $.post(`{{ route('quizzes.submit-answer', ['quiz' => $quiz->id, 'question' => ':questionId']) }}`.replace(':questionId', currentQuestionId), { selectedOption }, function (data) {
                displayResult(data.isCorrect);

                if(data.isCorrect){
                    SumCorrectAnswers++;
                }

                if (data.nextQuestion) {
                    displayQuestion(data.nextQuestion);
                    currentQuestionId = data.nextQuestion.id;
                }
                else{
                    $('#submitAnswer').hide();
                    $('#finishQuiz').show();
                }
            });
        }

        function displayQuestion(question) {
                const questionHtml = `
                    <h3 style="color: white; font-size: 25px; margin-bottom: 20px">Question ${question.position} of {{ $quiz->questions->count() }}: ${question.question}</h3>
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
            if (isCorrect) {
                Swal.fire({
                    icon: 'success',
                    title: 'Correct Answer!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Answer!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }

        function finishQuiz(quizId) {
            $.post(`{{ route('quizzes.finish', ['quiz' => $quiz->id]) }}`, function (data) {
                const correctAnswersCount = SumCorrectAnswers;
                const totalQuestionsCount = data.totalQuestionsCount;

                $('#quizQuestions').hide();          
                $('#quizResults').html(`Quiz completed!\nCorrect Answers: ${correctAnswersCount}/${totalQuestionsCount}`).show();
                $('#finishQuiz').hide();
                $('#backBtn').show(); 
            });
        }
    </script>

</x-app-layout>