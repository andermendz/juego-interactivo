@extends('layouts.app')

@section('title', 'Juego Terminado')

@section('content')
<div class="text-center animate-fade-in">
    <div class="game-card">
        <h2 class="text-3xl font-bold text-indigo-600 mb-6">¡Juego Terminado!</h2>

        <div class="mb-8">
            <p class="text-2xl mb-2">¡Felicitaciones, <span class="text-indigo-600 font-bold">{{ $player_name }}</span>!</p>
            <p class="text-gray-600 mb-6">Has completado el juego con los siguientes resultados:</p>

            <div class="grid grid-cols-2 gap-6 max-w-lg mx-auto">
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $score }}</div>
                    <div class="text-gray-600">Puntuación Final</div>
                </div>
                
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $correct_answers }}/{{ $questions_answered }}</div>
                    <div class="text-gray-600">Respuestas Correctas</div>
                </div>
            </div>

            @php
                $percentage = ($correct_answers / $questions_answered) * 100;
                $message = match(true) {
                    $percentage == 100 => '¡Perfecto! Eres un genio absoluto.',
                    $percentage >= 80 => '¡Excelente trabajo! Casi perfecto.',
                    $percentage >= 60 => '¡Buen trabajo! Hay espacio para mejorar.',
                    $percentage >= 40 => 'No está mal, sigue practicando.',
                    default => 'Inténtalo de nuevo, ¡la práctica hace al maestro!'
                };
            @endphp

            <div class="mt-6 p-4 bg-white rounded-lg shadow-sm">
                <p class="text-lg text-gray-700">{{ $message }}</p>
            </div>
        </div>

        @if($top_scores->count() > 0)
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-indigo-600">🏆 Tabla de Campeones</h3>
                
                <div class="overflow-hidden rounded-lg shadow">
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <th class="w-1/6">#</th>
                                <th class="w-2/5">Jugador</th>
                                <th class="w-1/5">Puntuación</th>
                                <th class="w-1/5">Correctas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_scores as $index => $score)
                                <tr class="{{ $score->player_name === $player_name ? 'bg-indigo-50' : '' }}">
                                    <td class="font-bold">
                                        @if($index + 1 === 1)
                                            🥇
                                        @elseif($index + 1 === 2)
                                            🥈
                                        @elseif($index + 1 === 3)
                                            🥉
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </td>
                                    <td>{{ $score->player_name }}</td>
                                    <td>{{ $score->score }}</td>
                                    <td>{{ $score->correct_answers }}/{{ $score->questions_answered }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <a href="{{ route('game.index') }}" 
           class="primary-button inline-flex items-center group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Jugar de Nuevo
        </a>
    </div>
</div>

@if($correct_answers === $questions_answered)
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        // Celebration animation for perfect score
        const duration = 3 * 1000;
        const animationEnd = Date.now() + duration;

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        (function frame() {
            const timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) return;

            confetti({
                particleCount: 2,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#818CF8', '#6366F1', '#4F46E5']
            });
            
            confetti({
                particleCount: 2,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#818CF8', '#6366F1', '#4F46E5']
            });

            requestAnimationFrame(frame);
        }());
    </script>
    @endsection
@endif
@endsection
