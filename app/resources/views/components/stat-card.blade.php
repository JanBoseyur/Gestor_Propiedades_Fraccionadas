
<div
    class="bg-[#2C7474]
           p-4 sm:p-5
           mx-3 sm:mx-5
           rounded-xl
           shadow-lg
           flex flex-col sm:flex-row
           items-center
           text-center sm:text-left
           space-y-3 sm:space-y-0 sm:space-x-5
           w-full max-w-xs
           overflow-hidden
           transform hover:-translate-y-1 hover:shadow-2xl
           transition-all duration-300"
>

    <!-- Icono -->
    <div class = "p-2 sm:p-3 rounded-full bg-white flex items-center justify-center">
        @isset($icon)
            <i class = "{{ $icon }} text-lg sm:text-xl text-[#2C7474]"></i>
        @endisset

        @isset($iconSlot)
            {{ $iconSlot }}
        @endisset
    </div>

    <!-- Texto -->
    <div>
        <p class = "text-sm sm:text-base font-medium text-white">
            {{ $title }}
        </p>
        <p class = "text-xl sm:text-2xl font-bold text-white">
            {{ $value }}
        </p>
    </div>

</div>

