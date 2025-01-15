@extends('layouts.app')

@section('title', 'Jugando')

@section('content')
    <div class="text-center">
        <div class="mb-4">
            <span class="text-gray-600">Jugador:</span>
            <span class="font-semibold">{{ session('player_name') }}</span>
            <span class="ml-4 text-gray-600">Puntuación:</span>
            <span class="font-semibold">{{ session('score', 0) }}</span>
        </div>

        <div id="timer" class="mb-4 text-lg font-bold text-indigo-600">30</div>

        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-6">{{ $question->question }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button class="answer-btn bg-white border-2 border-indigo-200 p-4 rounded-lg hover:bg-indigo-50 transition-colors"
                        data-answer="a">
                    A) {{ $question->option_a }}
                </button>
                
                <button class="answer-btn bg-white border-2 border-indigo-200 p-4 rounded-lg hover:bg-indigo-50 transition-colors"
                        data-answer="b">
                    B) {{ $question->option_b }}
                </button>
                
                <button class="answer-btn bg-white border-2 border-indigo-200 p-4 rounded-lg hover:bg-indigo-50 transition-colors"
                        data-answer="c">
                    C) {{ $question->option_c }}
                </button>
                
                <button class="answer-btn bg-white border-2 border-indigo-200 p-4 rounded-lg hover:bg-indigo-50 transition-colors"
                        data-answer="d">
                    D) {{ $question->option_d }}
                </button>
            </div>
        </div>

        <div id="feedback" class="mb-4 hidden">
            <p class="text-lg font-semibold"></p>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let timeLeft = 30;
        const timerElement = document.getElementById('timer');
        const answerButtons = document.querySelectorAll('.answer-btn');
        const feedbackDiv = document.getElementById('feedback');
        let timerInterval;
        let answered = false;

        function startTimer() {
            timerInterval = setInterval(() => {
                timeLeft--;
                timerElement.textContent = timeLeft;

                if (timeLeft <= 0 || answered) {
                    clearInterval(timerInterval);
                    if (!answered) {
                        handleTimeout();
                    }
                }
            }, 1000);
        }

        function handleTimeout() {
            answered = true;
            answerButtons.forEach(btn => btn.disabled = true);
            feedbackDiv.querySelector('p').textContent = '¡Se acabó el tiempo!';
            feedbackDiv.classList.remove('hidden');
            setTimeout(() => window.location.href = '{{ route("game.play") }}', 2000);
        }

        function handleAnswer(answer) {
            answered = true;
            clearInterval(timerInterval);
            
            fetch('{{ route("game.answer") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: '{{ $question->id }}',
                    answer: answer
                })
            })
            .then(response => response.json())
            .then(data => {
                answerButtons.forEach(btn => {
                    btn.disabled = true;
                    if (btn.dataset.answer === data.correct_answer) {
                        btn.classList.add('bg-green-100', 'border-green-500');
                    }
                });

                feedbackDiv.querySelector('p').textContent = data.correct ? 
                    '¡Correcto! +10 puntos' : 
                    '¡Incorrecto!';
                feedbackDiv.classList.remove('hidden');
                
                setTimeout(() => window.location.href = '{{ route("game.play") }}', 2000);
            });
        }

        answerButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (!answered) {
                    handleAnswer(button.dataset.answer);
                }
            });
        });

        startTimer();
    });
</script>
@endsection
