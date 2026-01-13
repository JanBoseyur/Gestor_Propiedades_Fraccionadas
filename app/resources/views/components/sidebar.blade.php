
<!-- Contenedor Sidebar -->
<aside class = "bg-[#2E6C6F] w-64 flex-shrink-0 h-[calc(100vh-5rem)] shadow-lg">
    <div class = "flex flex-col h-full">

        <!-- Navegación -->
        <nav class = "flex-1 p-4 overflow-y-auto">
            <ul class = "space-y-1">

                <li>
                    <a href = "{{ route('admin.Dashboard') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('admin.Dashboard')
                                ? 'bg-[#F5D2A0] text-[#FFF6E9]'
                                : 'text-gray-700 hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <svg class = "h-6 w-6 mr-3" fill = "none" viewBox = "0 0 24 24"
                             stroke = "currentColor">
                            <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                                  d  ="M3 12l2-2m0 0l7-7 7 7m-9 2v8" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href = "{{ route('admin.ManageProperties') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('admin.ManageProperties')
                                ? 'bg-[#F5D2A0] text-white'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">
                                
                        <svg class = "h-6 w-6 mr-3 " fill = "none" viewBox = "0 0 24 24"
                             stroke = "currentColor">
                            <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                                  d = "M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Gestionar Propiedades
                    </a>
                </li>

                <li>
                    <a href = "{{ route('ManagePartners') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('ManagePartners')
                                ? 'bg-[#F5D2A0] text-white'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <svg class = "h-6 w-6 mr-3" fill = "none" viewBox = "0 0 24 24"
                             stroke = "currentColor">
                            <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                                  d = "M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857" />
                        </svg>
                        Gestionar Socios
                    </a>
                </li>

                <li>
                    <a href = "{{ route('ReservedWeeks') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('ReservedWeeks')
                                ? 'bg-[#F5D2A0] text-white'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <svg class = "h-6 w-6 mr-3" fill = "none" viewBox = "0 0 24 24"
                             stroke = "currentColor">
                            <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                                  d = "M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857" />
                        </svg>
                        Semanas Reservadas
                    </a>
                </li>

                <li>
                    <a href = "{{ route('BillingPage') }}"
                        class = "flex items-center px-4 py-3 rounded-lg
                            {{ request()->routeIs('BillingPage')
                                ? 'bg-[#F5D2A0] text-white'
                                : 'text-white hover:bg-[#B3D3D3] hover:text-[#2E6C6F]' }}">

                        <svg class = "h-6 w-6 mr-3" fill = "none" viewBox = "0 0 24 24"
                             stroke = "currentColor">
                            <path stroke-linecap = "round" stroke-linejoin = "round" stroke-width = "2"
                                  d = "M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857" />
                        </svg>
                        Gasto Común
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Cuenta y Logout -->
        <div class = "p-4">

            <div class = "flex items-center mb-4">
                <div
                    class = "h-10 w-10 rounded-full bg-[#C7DED9] text-white flex items-center justify-center text-lg font-bold">
                    A
                </div>
                <div class = "ml-3">
                    <p class = "text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Admin
                    </p>
                    <p class = "text-xs text-gray-500 dark:text-gray-400">
                        Administrador
                    </p>
                </div>
            </div>

            <a href = "{{ route('login') }}"
               class = "flex items-center px-2 py-3 rounded-lg text-white hover:bg-[#F5D2A0] hover:text-white">
                <svg class = "h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24"
                     stroke = "currentColor">
                    <path stroke-linecap = "round" stroke-linejoin="round" stroke-width="2"
                          d = "M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Cerrar Sesión
            </a>

        </div>
    </div>
</aside>
