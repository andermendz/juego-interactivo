@extends('layouts.app')

@section('title', 'Jugando')

@section('content')
<div class="text-center animate-fade-in">
    <div class="game-card">
        <div class="flex justify-between items-center mb-6">
            <div class="text-left">
                <span class="text-gray-600">Jugador:</span>
                <span class="font-semibold text-indigo-600">{{ session('player_name') }}</span>
            </div>
            <div class="score-display">
                {{ session('score', 0) }} puntos
            </div>
        </div>

        <div class="progress-indicator mb-4">
            @for ($i = 0; $i < 5; $i++)
                <div class="progress-dot {{ session('questions_answered', 0) > $i ? 'active' : '' }}"></div>
            @endfor
        </div>

        <div class="timer-container mb-6">
            <div class="timer-bar">
                <div class="timer-bar-inner" id="timerBar" style="width: 100%"></div>
            </div>
            <div id="timer" class="mt-2 text-lg font-bold text-indigo-600">30</div>
        </div>

        <div class="mb-8 animate-scale-in">
            <h3 class="text-xl font-semibold mb-6">{{ $question->question }}</h3>

            <div class="grid grid-cols-1 gap-4">
                @php
                    $options = [
                        'a' => $question->option_a,
                        'b' => $question->option_b,
                        'c' => $question->option_c,
                        'd' => $question->option_d,
                    ];
                @endphp

                @foreach ($options as $key => $option)
                    <button class="answer-btn" data-answer="{{ $key }}">
                        <span class="inline-flex items-center">
                            <span class="w-8 h-8 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full mr-3">
                                {{ strtoupper($key) }}
                            </span>
                            {{ $option }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>

        <div id="feedback" class="feedback-message hidden"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeLeft = 30;
    const timerElement = document.getElementById('timer');
    const timerBar = document.getElementById('timerBar');
    const answerButtons = document.querySelectorAll('.answer-btn');
    const feedbackDiv = document.getElementById('feedback');
    let timerInterval;
    let answered = false;

    function updateTimer() {
        const percentage = (timeLeft / 30) * 100;
        timerBar.style.width = `${percentage}%`;
        
        if (percentage < 30) {
            timerBar.style.backgroundColor = '#EF4444';  // red
        } else if (percentage < 60) {
            timerBar.style.backgroundColor = '#F59E0B';  // yellow
        }
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            updateTimer();

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
        answerButtons.forEach(btn => {
            btn.disabled = true;
            btn.classList.add('disabled');
            if (btn.dataset.answer === '{{ $question->correct_answer }}') {
                btn.classList.add('correct');
            }
        });
        
        feedbackDiv.innerHTML = `
            <div class="text-red-600 mb-2">¡Se acabó el tiempo!</div>
            <div class="text-gray-600">La respuesta correcta era: 
                <span class="font-semibold text-indigo-600">
                    {{ strtoupper($question->correct_answer) }}
                </span>
            </div>
        `;
        feedbackDiv.classList.remove('hidden');
        feedbackDiv.classList.add('incorrect');
        
        setTimeout(() => window.location.href = '{{ route("game.play") }}', 3000);
    }

    function handleAnswer(button, answer) {
        answered = true;
        clearInterval(timerInterval);
        
        answerButtons.forEach(btn => {
            btn.disabled = true;
            btn.classList.add('disabled');
        });

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
                if (btn.dataset.answer === data.correct_answer) {
                    btn.classList.add('correct');
                }
            });

            if (data.correct) {
                button.classList.add('correct');
                feedbackDiv.textContent = '¡Correcto! +10 puntos';
                feedbackDiv.classList.add('correct');
                
                // Confetti effect for correct answer
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            } else {
                button.classList.add('incorrect');
                feedbackDiv.innerHTML = `
                    <div class="text-red-600 mb-2">¡Incorrecto!</div>
                    <div class="text-gray-600">La respuesta correcta era: 
                        <span class="font-semibold text-indigo-600">
                            ${data.correct_answer.toUpperCase()}
                        </span>
                    </div>
                `;
                feedbackDiv.classList.add('incorrect');
            }

            feedbackDiv.classList.remove('hidden');
            
            setTimeout(() => {
                if (data.finished) {
                    window.location.href = '{{ route("game.finish") }}';
                } else {
                    window.location.href = '{{ route("game.play") }}';
                }
            }, 2000);
        });
    }

    answerButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (!answered) {
                handleAnswer(button, button.dataset.answer);
            }
        });
    });

    startTimer();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
@endsection
