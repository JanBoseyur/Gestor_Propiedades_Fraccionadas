
@extends('layout.app')

@section('title', 'Gestión de Gasto Común')

@section('content')

<div class = "p-4 sm:p-6 max-w-7xl mx-auto">

    <!-- TÍTULO -->
    <h2 class = "text-2xl sm:text-3xl font-extrabold text-[#2E6C6F] text-center mb-8">
        Gestión de Gasto Común
    </h2>

    <!-- ================= FILTROS ================= -->
    <form method = "GET"
        class = "bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-4 sm:p-6 mb-8 flex flex-wrap gap-6">

        {{-- Año --}}
        <div class = "">
            <label class = "block text-sm font-medium mb-1">Año</label>
            
            <select name = "anio"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">

                <option value = "">Todos</option>

                @for($y = now()->year - 5; $y <= now()->year + 1; $y++)
                    <option value = "{{ $y }}" @selected(request('anio') == $y)>
                        {{ $y }}
                    </option>
                @endfor
            </select>

        </div>

        {{-- Mes --}}
        <div class = "">
            <label class = "block text-sm font-medium mb-1">Mes</label>
            
            <select name = "mes"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">

                <option value="">Todos</option>

                @foreach(range(1,12) as $m)
                    <option value = "{{ $m }}" @selected(request('mes') == $m)>
                        {{ ucfirst(\Carbon\Carbon::create()->month($m)->locale('es')->monthName) }}
                    </option>
                @endforeach
            </select>

        </div>

        {{-- Propiedad --}}
        <div class = ""> 
            <label class = "block text-sm font-medium mb-1">Propiedad</label>
            
            <select name = "propiedad_id"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">
                
                <option value = "">Todas</option>
                
                @foreach($propiedades as $prop)

                    <option value = "{{ $prop->id }}"
                        @selected(request('propiedad_id') == $prop->id)>
                        {{ $prop->nombre }}
                    </option>

                @endforeach

            </select>

        </div>

        {{-- Estado --}}
        <div class = "">
            <label class = "block text-sm font-medium mb-1">Estado</label>
            
            <select name = "estado"
                class = "rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">
                <option value = "">Todos</option>
                
                <option value = "pendiente" @selected(request('estado') == 'pendiente')>
                    Pendiente
                </option>

                <option value = "pagado" @selected(request('estado') == 'pagado')>
                    Pagado
                </option>

            </select>

        </div>

        <div class = "flex items-end">

            <button class = "px-4 py-2 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300 cursor-pointer">
                Filtrar
            </button>

        </div>

    </form>

    <!-- ================= RESUMEN ================= -->
    @php
        $totalPagado = $pagos->where('estado','pagado')->sum('monto');
        $totalPendiente = $pagos->where('estado','pendiente')->sum('monto');
    @endphp

    <div class = "grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        
        <div class = "p-6 rounded-2xl bg-[#2E6C6F] text-white shadow">
            <p class = "text-sm">Total Recaudado</p>
            <p class = "text-2xl font-bold">
                ${{ number_format($totalPagado,0,',','.') }}
            </p>
        </div>

        <div class = "p-6 rounded-2xl bg-[#D89C83] text-white shadow">
            <p clas = "text-sm">Total Pendiente</p>
            <p class = "text-2xl font-bold">
                ${{ number_format($totalPendiente,0,',','.') }}
            </p>
        </div>

    </div>

    <!-- ================= TABLA DESKTOP ================= -->
    <div class = "hidden md:block bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 overflow-x-auto">

        <table class = "min-w-full text-sm text-gray-700">

            <thead class = "bg-[#2E6C6F] text-white">
                
                <tr>
                    <th class = "px-6 py-4 text-center">Propiedad</th>
                    <th class = "px-6 py-4 text-center">Periodo</th>
                    <th class = "px-6 py-4 text-center">Monto</th>
                    <th class = "px-6 py-4 text-center">Estado</th>
                    <th class = "px-6 py-4 text-center">Acciones</th>
                </tr>

            </thead>

            <tbody class = "divide-y">

                @forelse($pagos as $pago)

                <tr class = "hover:bg-[#F3FAFA] transition">

                    <td class = "px-6 py-4 text-center">
                        {{ $pago->propiedad->nombre }}
                    </td>

                    <td class = "px-6 py-4 text-center">
                        Semana {{ $pago->semana }} <br>
                        
                        <span class = "text-xs text-gray-500">
                            {{ $pago->fecha_inicio->format('d/m') }} —
                            {{ $pago->fecha_fin->format('d/m') }}
                        </span>

                    </td>

                    <td class = "px-6 py-4 text-center">
                        ${{ number_format($pago->monto,0,',','.') }}
                    </td>

                    <td class = "px-6 py-4 text-center">

                        <span class = "px-3 py-1 rounded-full text-xs font-medium
                            {{ $pago->estado === 'pagado'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($pago->estado) }}
                        </span>

                    </td>

                    <td class = "px-6 py-4 text-center">
                    
                        @if($pago->estado === 'pendiente')

                            <!-- MODAL -->
                            <div x-data = "{ open: false }">

                                <!-- BOTÓN ABRIR -->
                                <button
                                    @click = "open = true"
                                    class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition cursor-pointer"
                                >
                                    Pagar
                                </button>

                                <!-- OVERLAY -->
                                <div
                                    x-show = "open"
                                    x-transition.opacity
                                    class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                                    @click.self = "open = false"
                                >
                                    <!-- MODAL BOX -->
                                    <div class = "bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

                                        <!-- HEADER -->
                                        <h2 class = "text-xl font-bold text-gray-800 text-center">
                                            Pagando Gastos en {{ $pago->propiedad->nombre }}
                                        </h2>

                                        <div class = "mt-1 mb-5 inline-block px-4 py-1 bg-[#2C7474]/10 text-[#2C7474] rounded-full text-sm font-medium">
                                            {{ $pago->fecha_inicio->format('d/m/Y') }}
                                            —
                                            {{ $pago->fecha_fin->format('d/m/Y') }}
                                        </div>

                                        <!-- CONTENIDO -->
                                        @if($pago->estado === 'pendiente')
                                            
                                            <div
                                                id = "stripe-container-{{ $pago->id }}"
                                                class = "space-y-4"
                                            >
                                                <div
                                                    id = "card-element-{{ $pago->id }}"
                                                    class = "border border-gray-300 rounded-lg p-3 bg-white"
                                                ></div>

                                                <!-- Botones -->
                                                <div class = "flex flex-row items-center justify-center gap-4">
                                                    
                                                    <button
                                                        @click = "open = false"
                                                        class = "px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition"
                                                    >
                                                        Cerrar
                                                    </button>

                                                    <button
                                                        type = "button"
                                                        onclick = "pagarGasto({{ $pago->id }})"
                                                        class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition cursor-pointer"
                                                    >
                                                        Pagar
                                                    </button>

                                                </div>

                                            </div>

                                        @else
                                            <p class = "text-center text-gray-600">
                                                Este gasto ya fue pagado.
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            
                        @endif

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan = "6" class = "text-center py-16 text-gray-500">
                        No hay pagos con los filtros seleccionados
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- ================= CARDS MÓVIL ================= -->
    <div class = "md:hidden space-y-4">

        @forelse($pagos as $pago)
        <div class = "bg-white rounded-2xl shadow p-4 space-y-3">

            <div>
                <p class = "text-xs text-gray-500">Propiedad</p>
                <p class = "font-medium">{{ $pago->propiedad->nombre }}</p>
            </div>

            <div>
                <p class = "text-xs text-gray-500">Periodo</p>
                <p>
                    {{ ucfirst(\Carbon\Carbon::create()->month($pago->mes)->locale('es')->monthName) }}
                    {{ $pago->anio }}
                </p>
            </div>

            <div>
                <p class = "text-xs text-gray-500">Monto</p>
                <p class = "font-semibold">
                    ${{ number_format($pago->monto,0,',','.') }}
                </p>
            </div>

            <div>
                <p class = "text-xs text-gray-500">Estado</p>
                <span class = "rounded-full text-xs font-medium
                    {{ $pago->estado === 'pagado'
                        ? 'text-green-500'
                        : 'text-yellow-500' }}">
                    {{ ucfirst($pago->estado) }}
                </span>
            </div>
    
            @if($pago->estado === 'pendiente')

                <!-- MODAL -->
                <div x-data = "{ open: false }">

                    <!-- BOTÓN ABRIR -->
                    <button
                        @click = "open = true"
                        class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition cursor-pointer"
                    >
                        Pagar
                    </button>

                    <!-- OVERLAY -->
                    <div
                        x-show = "open"
                        x-transition.opacity
                        class = "fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                        @click.self = "open = false"
                    >
                        <!-- MODAL BOX -->
                        <div class = "bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

                            <!-- HEADER -->
                            <h2 class = "text-xl font-bold text-gray-800 text-center">
                                Pagando Gastos en {{ $pago->propiedad->nombre }}
                            </h2>

                            <div class = "mt-1 mb-5 inline-block px-4 py-1 bg-[#2C7474]/10 text-[#2C7474] rounded-full text-sm font-medium">
                                {{ $pago->fecha_inicio->format('d/m/Y') }}
                                —
                                {{ $pago->fecha_fin->format('d/m/Y') }}
                            </div>

                            <!-- CONTENIDO -->
                            @if($pago->estado === 'pendiente')
                                
                                <div
                                    id = "stripe-container-{{ $pago->id }}"
                                    class = "space-y-4"
                                >
                                    <div
                                        id = "card-element-{{ $pago->id }}"
                                        class = "border border-gray-300 rounded-lg p-3 bg-white"
                                    ></div>

                                    <!-- Botones -->
                                    <div class = "flex flex-row items-center justify-center gap-4">
                                        
                                        <button
                                            @click = "open = false"
                                            class = "px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition"
                                        >
                                            Cerrar
                                        </button>

                                        <button
                                            type = "button"
                                            onclick = "pagarGasto({{ $pago->id }})"
                                            class = "px-4 py-2 bg-[#2C7474] text-white rounded-xl hover:bg-[#245f5f] transition cursor-pointer"
                                        >
                                            Pagar
                                        </button>

                                    </div>

                                </div>

                            @else
                                <p class = "text-center text-gray-600">
                                    Este gasto ya fue pagado.
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
                
            @endif

        </div>

        @empty
            <div class = "text-center py-16 text-gray-500">
                No hay pagos con los filtros seleccionados
            </div>
        @endforelse

    </div>

</div>

@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/stripe-pagos.js') }}"></script>
@endpush

