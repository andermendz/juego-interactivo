@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<div class="text-center animate-fade-in">
    <div class="game-card">
        <h2 class="text-3xl font-bold text-indigo-600 mb-6 animate-bounce-soft">
            ¡Bienvenido a Trivia!
        </h2>
        
        <p class="mb-8 text-gray-600 text-lg">
            Pon a prueba tus conocimientos en este emocionante juego de preguntas y respuestas.
            ¿Estás listo para el desafío?
        </p>

        <form action="{{ route('game.start') }}" method="POST" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-6">
                <input type="text" 
                       name="player_name" 
                       class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-indigo-500 
                              transition-all duration-300 @error('player_name') border-red-500 @enderror"
                       placeholder="Ingresa tu nombre"
                       required
                       autocomplete="off">
                
                @error('player_name')
                    <p class="text-red-500 text-sm mt-2 animate-fade-in">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="primary-button group">
                <span class="inline-flex items-center">
                    ¡Comenzar Aventura!
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform transition-transform group-hover:translate-x-1" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </button>
        </form>
    </div>

    <div class="mt-8 text-sm text-gray-500">
        <p>¿Cómo jugar?</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div class="p-4 bg-white rounded-lg shadow-sm">
                <div class="text-indigo-500 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <p>Responde 5 preguntas emocionantes</p>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-sm">
                <div class="text-indigo-500 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p>Tienes 30 segundos por pregunta</p>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-sm">
                <div class="text-indigo-500 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <p>Gana puntos y compite por el primer lugar</p>
            </div>
        </div>
    </div>
</div>
@endsection
