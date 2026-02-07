
@extends('layout.app')

@section('title', 'Gestión de Gasto Común')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl p-10 lg:p-0 lg:px-15">

    <!-- TÍTULO -->
    <div class = "mb-8">

        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            Gestión de Pagos
        </h2>
        <p class = "mt-2 text-gray-500">
            Revisa todos los pagos registrados
        </p>
        
    </div>


    <!-- ================= FILTROS ================= -->
    <form method = "GET"
        class = "bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 p-4 sm:p-6 mb-8 flex flex-wrap gap-6">

        {{-- Año --}}
        <div>
            <label class = "block text-sm font-medium mb-1">Año</label>
            <select name = "anio"
                class="rounded-lg border-gray-300 focus:ring-2 focus:ring-[#2E6C6F]">

                <option value="">Todos</option>

                @for($y = now()->year - 5; $y <= now()->year + 1; $y++)
                    <option value="{{ $y }}" @selected(request('anio') == $y)>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- Mes --}}
        <div>
            <label class = "block text-sm font-medium mb-1">Mes</label>
            <select name="mes"
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
        <div>
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
        <div>

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
                    <th class = "px-6 py-4 text-center">Socio</th>
                    <th class = "px-6 py-4 text-center">Periodo</th>
                    <th class = "px-6 py-4 text-center">Monto</th>
                    <th class = "px-6 py-4 text-center">Estado</th>
                    <th class = "px-6 py-4 text-center">Acciones</th>
                </tr>

            </thead>

            <tbody class = "divide-y">

                @forelse($pagos as $pago)

                <tr class = "hover:bg-[#F3FAFA] transition">

                    <td class = "px-6 py-4 font-medium text-center">
                        {{ $pago->propiedad->nombre }}
                    </td>

                    <td class = "px-6 py-4 text-center">
                        {{ $pago->usuario->name }}
                    </td>

                    <td class = "px-6 py-4 text-center">
                        {{ ucfirst(\Carbon\Carbon::create()->month($pago->mes)->locale('es')->monthName) }}
                        {{ $pago->anio }}
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
                            <form method = "POST"
                                  action = "{{ route('gastos.marcarPagado',$pago->id) }}">
                                
                                @csrf
                                @method('PUT')

                                <button class = "px-3 py-2 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300 cursor-pointer">
                                    Marcar como Pagado
                                </button>
                                
                            </form>
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
                <p class = "text-xs text-gray-500">Socio</p>
                <p>{{ $pago->usuario->name }}</p>
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

                <form method = "POST"
                      action = "{{ route('gastos.marcarPagado',$pago->id) }}">
                    @csrf
                    @method('PUT')

                    <div class = "flex justify-center">
                        <button class = "justify-center align-center text-center mt-2 px-3 py-2 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300 cursor-pointer">
                            Marcar como Pagado
                        </button>
                    </div>

                </form>
                
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
