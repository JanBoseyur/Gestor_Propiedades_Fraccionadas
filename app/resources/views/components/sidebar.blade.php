
<!-- Contenedor Sidebar -->
<aside class = "bg-[#FFF6E9] w-64 flex-shrink-0 h-[calc(100vh-5rem)] transform -translate-x-full transition-transform duration-300 ease-in-out fixed z-50" id = "sidebar">
    <div class = "flex flex-col h-full p-4">

        <button id = "toggleSidebar" class = "p-2 text-[blue] md:hidden">
            <!-- Icono tipo hamburger -->
            <svg class = "w-6 h-6" fill = "none" stroke = "currentColor" viewBox = "0 0 24 24">
                <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                    d = "M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class = "flex justify-center items-center p-3">
            <img 
                src = "{{ asset('images/caribe-logo2.png') }}"
                class = " w-26"
                alt = "Logo"
            />
        </div>

        <!-- Navegación -->
        <nav class = "flex-1 p-4 overflow-y-auto">
            <ul class = "space-y-2">

                <li>
                    <a href = "{{ route('AdminDashboard') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('AdminDashboard')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('admin.Dashboard')
                            ? 'text-2xl mr-3 ri-dashboard-fill'
                            : 'text-2xl mr-3 ri-dashboard-line' }}">
                        </i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href = "{{ route('admin.ManageProperties') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('admin.ManageProperties')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('admin.ManageProperties')
                            ? 'text-2xl mr-3 ri-building-4-fill'
                            : 'text-2xl mr-3 ri-building-4-line' }}">
                        </i>
                        Gestionar Propiedades
                    </a>
                </li>

                <li>
                    <a href = "{{ route('ManagePartners') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('ManagePartners')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('ManagePartners')
                            ? 'text-2xl mr-3 ri-team-fill'
                            : 'text-2xl mr-3 ri-team-line' }}">
                        </i>
                        Gestionar Socios
                    </a>
                </li>

                <li>
                    <a href = "{{ route('ReservedWeeks') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('ReservedWeeks')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('ReservedWeeks')
                            ? 'text-2xl mr-3 ri-calendar-event-fill'
                            : 'text-2xl mr-3 ri-calendar-event-line' }}">
                        </i>
                        Semanas Reservadas
                    </a>
                </li>

                <li>
                    <a href = "{{ route('BillingPage') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('BillingPage')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('BillingPage')
                            ? 'text-2xl mr-3 ri-cash-fill'
                            : 'text-2xl mr-3 ri-cash-line' }}">
                        </i>
                        Gasto Común
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Cuenta y Logout -->
        <div class = "p-4">

            <div class = "flex items-center mb-4">
                <div class = "h-10 w-10 rounded-full bg-[#2C7474] text-white flex items-center justify-center font-bold">
                    @if(Auth::check())
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                
                <div class = "ml-3">          
                    <p class = "text-xl text-[#2C7474]">
                        @if(Auth::check())
                        {{ (Auth::user()->name) }}
                        @endif
                    </p>

                    <p class = "text-xs text-[#2C7474]">
                        Administrador
                    </p>
                </div>
            </div>

            <a href = "{{ route('login') }}"
               class = "flex items-center px-2 py-3 rounded-lg text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]">
                <svg class = "h-6 w-6 mr-3" fill = "none" viewBox = "0 0 24 24"
                     stroke = "currentColor">
                    <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                          d = "M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Cerrar Sesión
            </a>

        </div>
    </div>
</aside>

<div id = "overlay" class = "fixed inset-0 bg-black bg-opacity-25 hidden z-40"></div>

<script>
    const overlay = document.getElementById('overlay');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>