<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'TaskFlow')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- Enlace de salto para navegación con teclado (WCAG 2.4.1) --}}
    <a href="#contenido"
       class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100]
              focus:rounded-xl focus:bg-white focus:px-4 focus:py-3
              focus:text-sm focus:font-semibold focus:text-blue-700
              focus:shadow-lg focus:ring-2 focus:ring-blue-600">
        Saltar al contenido principal
    </a>

    @yield('body')
</body>
</html>
