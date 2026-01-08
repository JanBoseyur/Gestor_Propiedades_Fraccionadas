
<!DOCTYPE html>

<html lang = "es">

<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" conten t= "width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Admin')</title>

    {{-- CSS / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Head extra por vista --}}
    @stack('head')
</head>

<body class = "">
    
    @include('components.header')

    <div class = "flex flex-col flex-1">
        @include('components.sidebar')

        <main class = "">
            @yield('content')
        </main>
    </div>

</body>


</html>
