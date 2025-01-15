<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Aventura - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-8">Trivia Aventura</h1>
        
        <main class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
            @yield('content')
        </main>
    </div>
    
    @yield('scripts')
</body>
</html>
