
<header class = "flex justify-end bg-[white] items-center justify-between py-4">

    <div class = "flex items-center space-x-4 px-5">
        <span class = "flex flex-col items-center justify-center text-sm text-[#2C7474]">
            Bienvenido

            <strong class = "flex flex-col text-lg">
                @if(Auth::check())
                    {{ Auth::user()->name }}
                @endif
            </strong>

        </span>

        <div class = "h-8 w-8 rounded-full bg-[#2C7474] text-white flex items-center justify-center font-bold">
            @if(Auth::check())
               {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            @endif
        </div>
    </div>

</header>