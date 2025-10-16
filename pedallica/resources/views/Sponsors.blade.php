@extends('layouts.app')

@section('title', 'Sponsors - Pedallica')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Onze Sponsors</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Wij zijn trots op de samenwerking met onze sponsors. Zonder hun steun kunnen wij niet blijven groeien en presteren.
        </p>
    </div>

    <!-- Sponsors Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">

        @forelse($sponsors as $sponsor)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="h-48 bg-gray-200 flex items-center justify-center">
                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-h-full max-w-full object-contain p-4">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sponsor->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $sponsor->description }}</p>
                @if($sponsor->website)
                <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" class="text-orange-500 hover:text-orange-600 font-medium inline-flex items-center">
                    Bezoek website
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-600 text-lg">Er zijn momenteel geen sponsors beschikbaar.</p>
        </div>
        @endforelse

    </div>

    <!-- Call to Action Section -->
    <div class="bg-orange-500 rounded-lg shadow-xl p-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Word ook sponsor!</h2>
        <p class="text-white text-lg mb-6">
            Wil je ons team steunen en onderdeel worden van onze sponsorfamilie? Neem contact met ons op!
        </p>
        <a href="mailto:pedallica@outlook.be" class="inline-block bg-white text-orange-500 font-bold px-8 py-3 rounded-lg hover:bg-gray-100 transition-colors">
            pedallica@outlook.be
        </a>
    </div>

</div>
@endsection
