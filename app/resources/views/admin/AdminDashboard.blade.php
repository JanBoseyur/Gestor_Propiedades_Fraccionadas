
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <h2 class = "text-2xl font-bold my-5">Admin Dashboard</h2>

    <div class = "flex flex-block">

        <!-- Componente de Carta -->
        <x-stat-card
        title="Total de Propiedades"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Total de Socios"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Semanas Reservadas"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>

        <!-- Componente de Carta -->
        <x-stat-card
        title="Ocupacion de Socios"
        :value="128"
        color="bg-blue-500"
        >

            <x-slot:icon>
                <svg class = "w-5 h-5 text-white">...</svg>
            </x-slot:icon>

        </x-stat-card>
    </div>

    <!-- Componente de Propiedades -->  
    <h2 class = "text-2xl font-bold my-5">Vista Rápida de Propiedades</h2>

    <div class = "grid grid-cols-3 gap-6">

        <x-property-card
            title="Ocupacion de Socios"
            background="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop"
            :partners=8
            location="Punta Cana, Dominican Republic"
            >
        </x-property-card>

        <x-property-card
            title="Ocupacion de Socios"
            background="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop"
            :partners=8
            location="Punta Cana, Dominican Republic"
            >
        </x-property-card>

        <x-property-card
            title="Ocupacion de Socios"
            background="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop"
            :partners=8
            location="Punta Cana, Dominican Republic"
            >
        </x-property-card>

        <x-property-card
            title="Ocupacion de Socios"
            background="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop"
            :partners=8
            location="Punta Cana, Dominican Republic"
            >
        </x-property-card>

        <x-property-card
            title="Ocupacion de Socios"
            background="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop"
            :partners=8
            location="Punta Cana, Dominican Republic"
            >
        </x-property-card>
        
    </div>

@endsection