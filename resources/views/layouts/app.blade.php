<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #E0E7FF 0%, #EEF2FF 100%);
            min-height: 100vh;
        }
    </style>
    @yield('styles')
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <h1 class="text-2xl font-bold text-indigo-600 text-center">
                    Trivia
                </h1>
            </div>
        </header>

        <main class="flex-grow container mx-auto px-4 py-8">
            @yield('content')
        </main>

        <footer class="bg-white shadow-sm mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <p class="text-center text-gray-500 text-sm">
                    Creado por <a href="https://github.com/andermendz/" class="text-indigo-600 hover:text-indigo-700 transition-colors" target="_blank" rel="noopener noreferrer">Anderson Mendoza</a> | 
                    <a href="https://github.com/andermendz/juego-interactivo" class="text-indigo-600 hover:text-indigo-700 transition-colors" target="_blank" rel="noopener noreferrer">Ver código fuente</a>
                </p>
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
