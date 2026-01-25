
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
        <div class = "p-4">

            <div class = "flex items-center mb-4">
                
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