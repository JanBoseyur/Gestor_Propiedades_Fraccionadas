
<!DOCTYPE html>

<html lang = "es">

<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>@yield('title', 'Panel Admin')</title>

    {{-- CSS / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Head extra por vista --}}
    @stack('head')
</head>

<body class = "h-screen overflow-hidden">
    
    @include('components.Header')

    <div class = "flex h-[calc(100vh-4rem)]">
        @include('components.Sidebar')

        <main class = "p-5 flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>


</html>
