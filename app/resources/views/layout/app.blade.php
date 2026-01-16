
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

<body class = "bg-[#2E6C6F] h-screen overflow-hidden">
    
    @include('components.header')

    <div class = "flex h-[calc(100vh-4rem)]">
        @include('components.sidebar')

        <main class = "bg-white rounded-xl flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>


</html>
