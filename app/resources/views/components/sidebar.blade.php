
<!-- Contenedor Sidebar -->
<aside class = "bg-[#FFF6E9] w-64 flex-shrink-0 h-[calc(100vh-5rem)]z-50">
    <div class = "flex flex-col h-full p-4">

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

                        <i class = "{{ request()->routeIs('AdminDashboard')
                            ? 'text-2xl mr-3 ri-dashboard-fill'
                            : 'text-2xl mr-3 ri-dashboard-line' }}">
                        </i>
                        Dashboard
                    </a>
                </li>
        
        @role('admin')

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
                    <a href = "{{ route('admin.reserved-weeks') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('admin.reserved-weeks')
                                ? 'bg-[#2C7474] text-white'
                                : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <i class = "{{ request()->routeIs('admin.reserved-weeks')
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

    @endrole
    
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

            <form method = "POST" action = "{{ route('logout') }}">
                @csrf

                <button type = "submit"
                    class = "flex items-center w-full px-2 py-3 rounded-lg text-[#2C7474]
                        hover:bg-[#B3D3D3] hover:text-[#2E6C6F] cursor-pointer">

                    <i class = "{{ request()->routeIs('BillingPage')
                        ? 'text-2xl mr-3 ri-logout-box-fill'
                        : 'text-2xl mr-3 ri-logout-box-r-line' }}">
                    </i>

                    Cerrar Sesión
                </button>
            </form>

        </div>
    </div>
</aside>