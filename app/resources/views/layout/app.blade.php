
<!DOCTYPE html>

<html lang = "es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="stripe-key" content="{{ env('STRIPE_KEY') }}">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Primero frameworks globales opcionales -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- CSS específicos de librerías como Flatpickr -->
    <link rel="stylesheet" href="flatpickr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>@yield('title', 'Panel Admin')</title>
    
    <!-- Tailwind -->
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    @stack('styles')
</head>

<body class = "bg-[#FFF6E9] h-screen flex overflow-hidden">

    @stack('scripts')
    @include('components.sidebar')

    <main class = "flex-1 overflow-y-auto bg-[#EDFAFA]">

        @unless(View::hasSection('hideHeader'))
            @include('components.header')
        @endunless

        @yield('content')

    </main>

    <script src = "https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @stack('scripts')

</body>

</html>
