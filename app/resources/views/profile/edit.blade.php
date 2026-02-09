
@extends('layout.app')

@section('title', 'Mi Perfil')

@section('content')

<div class = "w-full min-h-screen rounded-tl-xl px-10">

    <!-- TÍTULO -->
    <div class = "">
        <h2 class = "text-4xl font-extrabold text-[#2C7474] tracking-tight">
            Mi Perfil
        </h2>
        <p class = "mt-2 text-gray-500">
            Administra tu información personal
        </p>
    </div>

    <!-- ALERTA -->
    @if(session('success'))
        <div class = "mb-6 p-4 rounded-xl bg-green-50 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- CARD -->
    <div class = "bg-white rounded-3xl shadow-xl overflow-hidden my-8">

        {{-- HEADER PERFIL --}}
        <div class = "bg-gradient-to-r from-[#2C7474] to-[#3a8f8f] p-8 text-white">
            <div class = "flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">

                {{-- AVATAR --}}
                <div class = "w-24 h-24 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold ring-4 ring-white/40">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                {{-- INFO --}}
                <div>
                    <h3 class = "text-2xl font-semibold">
                        {{ $user->name }}
                    </h3>
                    <p class = "text-sm opacity-90">
                        {{ $user->email }}
                    </p>

                    <span class = "bg-white inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full text-[#2C7474]">
                        {{ $user->rol_legible }}
                    </span>
                </div>

            </div>
        </div>

        <!-- FORMULARIO -->
        <form action = "{{ route('profile.update') }}" method = "POST" class = "p-8 space-y-8">
            @csrf

            <div class = "grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NOMBRE -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">Nombre completo</label>
                    <input type = "text" name = "name" value = "{{ old('name', $user->name) }}"
                        class = "mt-1 w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- EMAIL -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type = "email" name = "email" value = "{{ old('email', $user->email) }}"
                        class = "mt-1 w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- ID -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">ID de usuario</label>
                    <input type = "text" value = "{{ $user->id }}" disabled
                        class = "mt-1 w-full border border-gray-300 bg-gray-100 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                </div>

                <!-- CARD -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type = "text" name = "phone" value = "{{ old('phone', $user->phone) }}"
                        class = "mt-1 w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- DIRECCIÓN -->
                <div class = "md:col-span-2">
                    <label class = "block text-sm font-medium text-gray-700">Dirección</label>
                    <input type = "text" name = "address" value = "{{ old('address', $user->address) }}"
                        class = "mt-1 w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('address')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- CIUDAD -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">Ciudad</label>
                    <input typ = "text" name = "city" value = "{{ old('city', $user->city) }}"
                        class = "mt-1 w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('city')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- PAIS -->
                <div>
                    <label class = "block text-sm font-medium text-gray-700">País</label>
                    <input type = "text" name = "country" value = "{{ old('country', $user->country) }}"
                        class = "w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#2E6C6F] focus:border-transparent transition">
                    @error('country')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

            </div>

            <!-- BOTÓN -->
            <div class = "flex justify-end pt-6">
                <button type = "submit"
                    class = "px-10 py-3 rounded-xl bg-[#2C7474] text-white font-semibold shadow-lg hover:bg-[#245f5f] hover:scale-105 transition-transform cursor-pointer">
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
