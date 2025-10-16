@extends('layouts.app')

@section('title', 'Ploegen | Pedallica')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-center text-black mb-12">
            Onze <span class="text-orange-500">Ploegen</span>
        </h1>

        <!-- Bovenste rij: drie fotos-ploegen -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            <!-- Pedallica A -->
            <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="h-56 bg-gray-300 bg-center bg-cover flex items-center justify-center"
                     style="background-image: url('{{ asset('A.jpg') }}');">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition"></div>
                    <h2 class="relative z-10 text-white text-2xl font-bold">Pedallica A</h2>
                </div>
            </div>

            <!-- Pedallica B -->
            <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="h-56 bg-gray-300 bg-center bg-cover flex items-center justify-center"
                     style="background-image: url('{{ asset('B.jpg') }}');">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition"></div>
                    <h2 class="relative z-10 text-white text-2xl font-bold">Pedallica B</h2>
                </div>
            </div>

            <!-- Pedallica C -->
            <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="h-56 bg-gray-300 bg-center bg-cover flex items-center justify-center"
                     style="background-image: url('{{ asset('C.jpg') }}');">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition"></div>
                    <h2 class="relative z-10 text-white text-2xl font-bold">Pedallica C</h2>
                </div>
            </div>
        </div>

        <!-- Onderste rij: twee fotos-ploegen, gecentreerd -->
        <div class="flex flex-wrap justify-center gap-8">
            <!-- MTB -->
            <div class="w-full sm:w-[350px] lg:w-[380px] relative group rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="h-56 bg-gray-300 bg-center bg-cover flex items-center justify-center"
                     style="background-image: url('{{ asset('MTB.jpg') }}');">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition"></div>
                    <h2 class="relative z-10 text-white text-2xl font-bold">MTB</h2>
                </div>
            </div>

            <!-- Pedallicava -->
            <div class="w-full sm:w-[350px] lg:w-[380px] relative group rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="h-56 bg-gray-300 bg-center bg-cover flex items-center justify-center"
                     style="background-image: url('{{ asset('Pedallicava.jpg') }}');">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition"></div>
                    <h2 class="relative z-10 text-white text-2xl font-bold">Pedallicava</h2>
                </div>
            </div>
        </div>

    </div>
@endsection
