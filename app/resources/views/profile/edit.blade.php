
@extends('layout.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-4xl font-extrabold text-[#2C7474] mb-10 text-center md:text-left">Mi Perfil</h2>

    @if(session('success'))
        <div class="max-w-2xl mx-auto mb-6 p-4 text-green-800 bg-green-100 rounded-xl shadow transition duration-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-2xl mx-auto bg-[#FFF6E9] p-8 rounded-2xl shadow-xl transition duration-300 hover:shadow-2xl">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8">
            {{-- Avatar --}}
            <div class="w-24 h-24 rounded-full bg-[#2C7474] flex items-center justify-center text-white text-3xl font-bold shadow-md">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            {{-- Info del usuario --}}
            <div class="flex-1">
                <h3 class="text-2xl font-semibold text-[#2C7474]">{{ $user->name }}</h3>
                <p class="text-sm text-[#2C7474] mt-1">{{ $user->email }}</p>
                <span class="mt-2 inline-block px-2 py-1 text-xs font-semibold rounded
                    {{ $user->hasRole('admin') ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ $user->rol_legible }}
                </span>
            </div>
        </div>

        {{-- Formulario de edición --}}
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nombre --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-[#2C7474]">Nombre Completo</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200" required>
                    @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-[#2C7474]">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200" required>
                    @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- ID Usuario --}}
                <div>
                    <label for="partner_id" class="block text-sm font-medium text-[#2C7474]">Nro. Identificación</label>
                    <input type="text" id="partner_id" value="{{ $user->id }}" disabled 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-100 shadow-sm cursor-not-allowed">
                </div>

                {{-- Teléfono --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-[#2C7474]">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200">
                    @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Dirección --}}
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-[#2C7474]">Dirección</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200">
                    @error('address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Ciudad --}}
                <div>
                    <label for="city" class="block text-sm font-medium text-[#2C7474]">Ciudad</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200">
                    @error('city')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- País --}}
                <div>
                    <label for="country" class="block text-sm font-medium text-[#2C7474]">País</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-white shadow-sm focus:border-[#2C7474] focus:ring focus:ring-[#2C7474]/50 transition duration-200">
                    @error('country')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Botón --}}
            <div class="flex justify-end pt-4">
                <button type="submit" class="px-10 py-3 bg-[#2C7474] text-white font-semibold rounded-xl shadow-lg hover:bg-[#265a5c] hover:scale-105 transition transform duration-300">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
