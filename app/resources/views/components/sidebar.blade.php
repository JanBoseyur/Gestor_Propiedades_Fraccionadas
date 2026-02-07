
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
        style = "height: 100vh; height: 100dvh;"
        class = "overflow-y-auto bg-[#2C7474] w-64 max-w-full flex-shrink-0 fixed top-0 left-0 z-50 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col">
            
    <div class = "flex flex-col h-full overflow-hidden p ">

            <div class = "flex justify-center items-center p-6 flex-shrink-0">
                <img 
                    src = "{{ asset('images/caribe-logo1.png') }}"
                    class = " w-26"
                    alt = "Logo"
                />
            </div>

            <!-- Navegación -->
            <nav class = "flex-1 overflow-y-auto p-4">
                <ul class = "space-y-2">
                
                @role('admin')
                    <li>
                        <a href = "{{ route('admin.admin-dashboard') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('admin.admin-dashboard')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('admin.admin-dashboard')
                                ? 'mr-3 ri-dashboard-fill'
                                : 'mr-3 ri-dashboard-line' }}">
                            </i>
                            Dashboard
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.manage-properties') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('admin.manage-properties')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('admin.manage-properties')
                                ? 'mr-3 ri-building-4-fill'
                                : 'mr-3 ri-building-4-line' }}">
                            </i>
                            Gestionar Propiedades
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.manage-partners') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('admin.manage-partners')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('admin.manage-partners')
                                ? 'mr-3 ri-team-fill'
                                : 'mr-3 ri-team-line' }}">
                            </i>
                            Gestionar Socios
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.reserved-weeks') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('admin.reserved-weeks')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('admin.reserved-weeks')
                                ? 'mr-3 ri-calendar-event-fill'
                                : 'mr-3 ri-calendar-event-line' }}">
                            </i>
                            Semanas Reservadas
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li>
                        <a href = "{{ route('admin.billing') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('admin.billing')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('admin.billing')
                                ? 'mr-3 ri-cash-fill'
                                : 'mr-3 ri-cash-line' }}">
                            </i>
                            Gasto Común
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.dashboard') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('user.dashboard')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('user.dashboard')
                                ? 'mr-3 ri-dashboard-fill'
                                : 'mr-3 ri-dashboard-line' }}">
                            </i>
                            Dashboard
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('propiedades') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('propiedades', 'propiedades.show')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('propiedades', 'propiedades.show')
                                ? 'mr-3 ri-home-fill'
                                : 'mr-3 ri-home-line' }}">
                            </i>
                            Propiedades
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.mis-semanas') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('user.mis-semanas')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('user.mis-semanas')
                                ? 'mr-3 ri-calendar-fill'
                                : 'mr-3 ri-calendar-line' }}">
                            </i>
                            Semanas
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('user.billing') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('user.billing')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('user.billing')
                                ? 'mr-3 ri-cash-fill'
                                : 'mr-3 ri-cash-line' }}">
                            </i>
                            Mis Pagos
                        </a>
                    </li>
                @endrole

                @role('user')
                    <li>
                        <a href = "{{ route('profile.edit') }}"
                            class = "sidebar-link 
                                {{ request()->routeIs('profile.edit')
                                    ? 'bg-white text-[#2C7474]'
                                    : 'text-white hover:bg-[#B3D3D3] hover:text-[#1F4F52]' }}">

                            <i class = "{{ request()->routeIs('profile.edit')
                                ? 'mr-3 ri-dashboard-fill'
                                : 'mr-3 ri-dashboard-line' }}">
                            </i>
                            Editar Perfil
                        </a>
                    </li>
                @endrole

                </ul>
            </nav>

            <div class = "mx-7 h-[3px] bg-white rounded-full"></div>
        
            <!-- Cuenta y Logout -->
            <div class = "flex-shrink-0 px-4 py-4 text-white">

                <div class = "flex items-center mb-4">
                    
                    @if(Auth::check())
                        
                        <div class = "flex items-center gap-2">
                            <span class = "w-8 h-8 rounded-full bg-white text-[#2C7474] flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>

                    @endif

                    
                    <div class = "ml-3">       

                        <p class = "font-bold text-md">
                            
                            @if(Auth::check())
                                {{ (Auth::user()->name) }}
                            @endif

                        </p>

                        <p class = "text-xs mt-1">

                            <span class = "text-ml rounded">
                                {{ Auth::user()->email }}
                            </span>

                        </p>
                    </div>
                </div>

                <form class = "py-2" method = "POST" action = "{{ route('logout') }}">
                    @csrf

                    <button type = "submit"
                        class = "flex items-center w-full px-2 py-2 text-sm
                            hover:bg-[#B3D3D3] hover:text-[#2E6C6F] cursor-pointer rounded-lg">

                            <i class = "text-2xl mr-3 ri-logout-box-line"></i>

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
