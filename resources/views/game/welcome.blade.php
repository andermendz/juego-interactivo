@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="text-center">
        <h2 class="text-2xl font-semibold mb-6">¡Bienvenido a Trivia Aventura!</h2>
        
        <p class="mb-6 text-gray-600">
            Pon a prueba tus conocimientos en este emocionante juego de preguntas y respuestas.
        </p>

        <form action="{{ route('game.start') }}" method="POST" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-4">
                <input type="text" 
                       name="player_name" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500 @error('player_name') border-red-500 @enderror"
                       placeholder="Ingresa tu nombre"
                       required>
                
                @error('player_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                ¡Comenzar a Jugar!
            </button>
        </form>
    </div>
@endsection
