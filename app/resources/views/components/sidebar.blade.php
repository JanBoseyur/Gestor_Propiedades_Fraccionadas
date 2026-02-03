
<!-- Contenedor Sidebar -->
<div x-data = "{ open: false }" class = "relative">

    <!-- Botón para móviles -->
    <button @click = "open = !open"
        class = "md:hidden fixed top-4 left-4 z-50 bg-[#2C7474] text-white p-2 rounded-md shadow-md">
        <i class = "ri-menu-line text-2xl"></i>
    </button>

    <!-- Contenedor Sidebar -->
    <aside
        :class = "open ? 'translate-x-0' : '-translate-x-full'"
        class = "h-screen min-h-[100dvh] overflow-y-auto bg-[white] w-64 max-w-full flex-shrink-0 fixed top-0 left-0 z-50 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col">
            
    <div class = "flex flex-col h-full">

            <div class = "flex justify-center items-center p-6 flex-shrink-0">
                <img 
                    src = "{{ asset('images/caribe-logo2.png') }}"
                    class = " w-26"
                    alt = "Logo"
                />
            </div>

            <!-- Navegación -->
            <nav class = "flex-1 overflow-y-auto p-8">
                <ul class = "space-y-2">
                
                @role('admin')
                    <li>
                        <a href = "{{ route('admin.admin-dashboard') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('admin.admin-dashboard')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('admin.admin-dashboard')
                                ? 'text-2xl mr-3 ri-dashboard-fill'
                                : 'text-2xl mr-3 ri-dashboard-line' }}">
                            </i>
                            Dashboard
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.manage-properties') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('admin.manage-properties')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('admin.manage-properties')
                                ? 'text-2xl mr-3 ri-building-4-fill'
                                : 'text-2xl mr-3 ri-building-4-line' }}">
                            </i>
                            Gestionar Propiedades
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.manage-partners') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('admin.manage-partners')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('admin.manage-partners')
                                ? 'text-2xl mr-3 ri-team-fill'
                                : 'text-2xl mr-3 ri-team-line' }}">
                            </i>
                            Gestionar Socios
                        </a>
                    </li>
                @endrole

                @role('admin')
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
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.billing') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('admin.billing')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('admin.billing')
                                ? 'text-2xl mr-3 ri-cash-fill'
                                : 'text-2xl mr-3 ri-cash-line' }}">
                            </i>
                            Gasto Común
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.dashboard') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('user.dashboard')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('user.dashboard')
                                ? 'text-2xl mr-3 ri-dashboard-fill'
                                : 'text-2xl mr-3 ri-dashboard-line' }}">
                            </i>
                            Dashboard
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('propiedades') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('propiedades', 'propiedades.show')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('propiedades', 'propiedades.show')
                                ? 'text-2xl mr-3 ri-home-fill'
                                : 'text-2xl mr-3 ri-home-line' }}">
                            </i>
                            Propiedades
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.mis-semanas') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('user.mis-semanas')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('user.mis-semanas')
                                ? 'text-2xl mr-3 ri-calendar-fill'
                                : 'text-2xl mr-3 ri-calendar-line' }}">
                            </i>
                            Semanas
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.billing') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('user.billing')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('user.billing')
                                ? 'text-2xl mr-3 ri-cash-fill'
                                : 'text-2xl mr-3 ri-cash-line' }}">
                            </i>
                            Mis Pagos
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('profile.edit') }}"
                            class = "flex items-center px-4 py-3 rounded-lg
                                {{ request()->routeIs('profile.edit')
                                    ? 'bg-[#2C7474] text-white'
                                    : 'text-[#2C7474] hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                            <i class = "{{ request()->routeIs('profile.edit')
                                ? 'text-2xl mr-3 ri-dashboard-fill'
                                : 'text-2xl mr-3 ri-dashboard-line' }}">
                            </i>
                            Editar Perfil
                        </a>
                    </li>
                @endrole


                </ul>
            </nav>
        
            <!-- Cuenta y Logout -->
            <div class = "flex-shrink-0 p-4 border-t-1 border-[#2C7474]">

                <div class = "flex items-center mb-4 ">
                    
                    @if(Auth::check())
                        
                        <div class = "flex items-center gap-2">
                            <span class = "w-8 h-8 rounded-full bg-[#2C7474] text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>

                    @endif

                    
                    <div class = "ml-3">       

                        <p class = "text-xl text-[#2C7474]">
                            
                            @if(Auth::check())
                                {{ (Auth::user()->name) }}
                            @endif

                        </p>

                        <p class = "text-xs text-[#2C7474] mt-1">

                            <span class = "text-ml rounded
                                {{ Auth::user()->hasRole('admin') ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ Auth::user()->rol_legible }}
                            </span>

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

    <!-- Fondo overlay para móviles -->
    <div
        x-show="open"
        @click="open = false"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 md:hidden bg-transparent"
    ></div>

</div>

