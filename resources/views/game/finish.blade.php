@extends('layouts.app')

@section('title', 'Juego Terminado')

@section('content')
    <div class="text-center">
        <h2 class="text-2xl font-semibold mb-6">¡Juego Terminado!</h2>

        <div class="mb-8">
            <p class="text-lg mb-2">¡Felicitaciones, {{ $player_name }}!</p>
            <p class="text-gray-600 mb-4">Has completado el juego con los siguientes resultados:</p>

            <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto">
                <div class="bg-indigo-50 p-4 rounded-lg">
                    <p class="text-gray-600">Puntuación Final</p>
                    <p class="text-2xl font-bold text-indigo-600">{{ $score }}</p>
                </div>
                
                <div class="bg-indigo-50 p-4 rounded-lg">
                    <p class="text-gray-600">Respuestas Correctas</p>
                    <p class="text-2xl font-bold text-indigo-600">{{ $correct_answers }}/{{ $questions_answered }}</p>
                </div>
            </div>
        </div>

        @if($top_scores->count() > 0)
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Tabla de Puntuaciones</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-indigo-50">
                                <th class="px-4 py-2">Posición</th>
                                <th class="px-4 py-2">Jugador</th>
                                <th class="px-4 py-2">Puntuación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_scores as $index => $score)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $score->player_name }}</td>
                                    <td class="px-4 py-2">{{ $score->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <a href="{{ route('game.index') }}" 
           class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
            Jugar de Nuevo
        </a>
    </div>
@endsection
