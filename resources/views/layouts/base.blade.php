<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#F7F8FA">
    <title>@yield('title', 'TaskFlow')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-canvas font-sans text-ink antialiased">
    {{-- Enlace de salto para navegación con teclado (WCAG 2.4.1) --}}
    <a href="#contenido"
       class="sr-only focus:not-sr-only focus:fixed focus:left-3 focus:top-3 focus:z-[100]
              focus:rounded-xl focus:bg-surface focus:px-4 focus:py-3
              focus:text-sm focus:font-semibold focus:text-brand-700
              focus:shadow-lift focus:ring-2 focus:ring-brand-500">
        Saltar al contenido principal
    </a>

    @yield('body')
</body>
</html>
