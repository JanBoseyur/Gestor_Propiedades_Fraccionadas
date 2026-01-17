
<!DOCTYPE html>

<html lang = "es">

<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src = "https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href = "https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel = "stylesheet">

    <title>@yield('title', 'Panel Admin')</title>

    {{-- CSS / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Head extra por vista --}}
    @stack('head')
</head>

<body class = "bg-[#FFF6E9] h-screen flex overflow-hidden">

    @include('components.sidebar')

    <main class = "flex-1 overflow-y-auto bg-[#FFF6E9]">

        @include('components.header')
    
        @yield('content')

    </main>

</body>



</html>
