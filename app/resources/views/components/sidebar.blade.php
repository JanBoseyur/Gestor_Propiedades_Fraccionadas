
<!-- Contenedor Sidebar -->
<aside class = "bg-[#2E6C6F] w-64 flex-shrink-0 h-[calc(100vh-5rem)] shadow-lg">
    <div class = "flex flex-col h-full">

        <!-- Navegación -->
        <nav class = "flex-1 p-4 overflow-y-auto">
            <ul class = "space-y-2">

                <li>
                    <a href = "{{ route('admin.Dashboard') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('admin.Dashboard')
                                ? 'bg-white text-[#2E6C6F]'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

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
                                ? 'bg-white text-[#2E6C6F]'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

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
                                ? 'bg-white text-[#2E6C6F]'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

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
                                ? 'bg-white text-[#2E6C6F]'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

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
                                ? 'bg-white text-[#2E6C6F]'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

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
                <div
                    class = "h-10 w-10 rounded-full bg-white text-white flex items-center justify-center text-lg font-bold">
                    A
                </div>
                <div class = "ml-3">
                    <p class = "text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Admin
                    </p>
                    <p class = "text-xs text-[#F5D2A0]">
                        Administrador
                    </p>
                </div>
            </div>

            <a href = "{{ route('login') }}"
               class = "flex items-center px-2 py-3 rounded-lg text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]">
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
