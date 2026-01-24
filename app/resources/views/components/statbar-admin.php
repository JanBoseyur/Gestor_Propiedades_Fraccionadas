
<!-- Sidebar Estadísticas -->
<aside class="bg-[#FFF6E9] w-64 flex-shrink-0 h-[calc(100vh-5rem)] z-50 border-l border-[#E6DED4]">

    <div class="flex flex-col h-full p-4">

        <!-- Título -->
        <h3 class="text-sm font-bold text-[#2C7474] uppercase tracking-wider mb-4">
            Estadísticas
        </h3>

        <!-- Cards -->
        <div class="space-y-4">

            <!-- Propiedades -->
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs text-[#2C7474] font-medium">
                        Propiedades
                    </p>
                    <p class="text-2xl font-extrabold text-[#2E6C6F]">
                        {{ $totalPropiedades ?? 0 }}
                    </p>
                </div>
                <div class="h-10 w-10 rounded-lg bg-[#2C7474] text-white flex items-center justify-center">
                    <i class="ri-building-4-fill text-xl"></i>
                </div>
            </div>

            <!-- Socios -->
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs text-[#2C7474] font-medium">
                        Socios
                    </p>
                    <p class="text-2xl font-extrabold text-[#2E6C6F]">
                        {{ $totalSocios ?? 0 }}
                    </p>
                </div>
                <div class="h-10 w-10 rounded-lg bg-[#B3D3D3] text-[#2E6C6F] flex items-center justify-center">
                    <i class="ri-team-fill text-xl"></i>
                </div>
            </div>

            <!-- Semanas Reservadas -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-xs text-[#2C7474] font-medium">
                        Semanas Reservadas
                    </p>
                    <i class="ri-calendar-event-fill text-[#2C7474] text-lg"></i>
                </div>

                <p class="text-2xl font-extrabold text-[#2E6C6F] mb-2">
                    {{ $semanasReservadas ?? 0 }}
                </p>

                <!-- Barra progreso -->
                <div class="w-full h-2 bg-[#E6DED4] rounded-full overflow-hidden">
                    <div
                        class="h-full bg-[#2C7474] rounded-full"
                        style="width: {{ $porcentajeReservado ?? 0 }}%">
                    </div>
                </div>

                <p class="text-xs text-[#2C7474] mt-1">
                    {{ $porcentajeReservado ?? 0 }}% ocupado
                </p>
            </div>

            <!-- Semanas Disponibles -->
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs text-[#2C7474] font-medium">
                        Disponibles
                    </p>
                    <p class="text-2xl font-extrabold text-[#2E6C6F]">
                        {{ $semanasDisponibles ?? 0 }}
                    </p>
                </div>
                <div class="h-10 w-10 rounded-lg bg-[#B3D3D3] text-[#2E6C6F] flex items-center justify-center">
                    <i class="ri-checkbox-circle-fill text-xl"></i>
                </div>
            </div>

        </div>

        <!-- Footer opcional -->
        <div class="mt-auto pt-4 border-t border-[#E6DED4] text-xs text-[#2C7474] text-center">
            Actualizado hoy
        </div>

    </div>
</aside>
