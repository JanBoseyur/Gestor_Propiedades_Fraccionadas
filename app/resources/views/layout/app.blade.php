
<!DOCTYPE html>

<html lang = "es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Primero frameworks globales opcionales -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- CSS específicos de librerías como Flatpickr -->
    <link rel="stylesheet" href="flatpickr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet" />


    <title>@yield('title', 'Panel Admin')</title>
    <!-- Tailwind -->
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class = "bg-[#FFF6E9] h-screen flex overflow-hidden">

    @stack('scripts')
    @include('components.sidebar')

    <main class = "flex-1 overflow-y-auto bg-[#FFF6E9]">

        @include('components.header')
    
        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @stack('scripts')

</body>

</html>
