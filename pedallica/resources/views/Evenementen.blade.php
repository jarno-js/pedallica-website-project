@extends('layouts.app')

@section('title', 'Evenementen - Pedallica')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Evenementen</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Ontdek onze komende en eerdere wielerevenementen.
        </p>
    </div>

    <!-- Upcoming Events Section -->
    @if($upcomingEvents->count() > 0)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b-4 border-orange-500 pb-2 inline-block">
            Komende Evenementen
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($upcomingEvents as $event)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-gray-100">
                    @if($event->poster)
                        <img src="{{ asset($event->poster) }}" alt="{{ $event->title }}" class="w-full h-auto">
                    @else
                        <div class="text-gray-400 text-center p-8">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>Geen poster beschikbaar</p>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $event->title }}</h3>
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>
                            @if($event->start_date->isSameDay($event->end_date))
                                {{ $event->start_date->format('d/m/Y') }}
                            @else
                                {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}
                            @endif
                        </span>
                    </div>
                    <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full mt-2">
                        Binnenkort
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Passed Events Section -->
    @if($passedEvents->count() > 0)
    <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b-4 border-gray-400 pb-2 inline-block">
            Voorbije Evenementen
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($passedEvents as $event)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 opacity-90">
                <div class="bg-gray-100">
                    @if($event->poster)
                        <img src="{{ asset($event->poster) }}" alt="{{ $event->title }}" class="w-full h-auto">
                    @else
                        <div class="text-gray-400 text-center p-8">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p>Geen poster beschikbaar</p>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $event->title }}</h3>
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>
                            @if($event->start_date->isSameDay($event->end_date))
                                {{ $event->start_date->format('d/m/Y') }}
                            @else
                                {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}
                            @endif
                        </span>
                    </div>
                    <span class="inline-block bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full mt-2">
                        Afgelopen
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- No Events Message -->
    @if($upcomingEvents->count() == 0 && $passedEvents->count() == 0)
    <div class="text-center py-12">
        <div class="text-gray-400 mb-4">
            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <p class="text-gray-600 text-lg">Er zijn momenteel geen evenementen beschikbaar.</p>
    </div>
    @endif

</div>
@endsection
