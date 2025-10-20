@extends('layouts.app')

@section('title', $ploeg->name . ' | Pedallica')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Terug knop -->
        <a href="{{ route('fotos-ploegen') }}" class="inline-flex items-center text-orange-500 hover:text-orange-600 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Terug naar ploegen
        </a>

        <h1 class="text-4xl font-bold text-center text-black mb-4">
            <span class="text-orange-500">{{ $ploeg->name }}</span>
        </h1>

        @if($ploeg->description)
            <p class="text-center text-gray-600 mb-12">{{ $ploeg->description }}</p>
        @endif

        <!-- Ritten sectie -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-black mb-6">Ritten</h2>

            @if($ritten->isEmpty())
                <div class="bg-gray-100 rounded-lg p-8 text-center">
                    <p class="text-gray-600">Er zijn nog geen ritten voor deze ploeg.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ritten as $rit)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($rit->photo)
                                <img src="{{ asset($rit->photo) }}" alt="{{ $rit->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-black mb-2">{{ $rit->title }}</h3>

                                @if($rit->route_name)
                                    <p class="text-sm text-orange-500 mb-2">{{ $rit->route_name }}</p>
                                @endif

                                @if($rit->description)
                                    <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($rit->description, 100) }}</p>
                                @endif

                                <div class="space-y-2 text-sm text-gray-700">
                                    @if($rit->date)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $rit->date->format('d/m/Y') }}</span>
                                        </div>
                                    @endif

                                    @if($rit->start_time)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $rit->start_time }}</span>
                                        </div>
                                    @endif

                                    @if($rit->location || $rit->start_address)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $rit->location ?? $rit->start_address }}</span>
                                        </div>
                                    @endif

                                    @if($rit->distance)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                            <span>{{ $rit->distance }} km</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- GPX Download - alleen voor leden -->
                                @auth
                                    @if($rit->gpx_file)
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <a href="{{ asset($rit->gpx_file) }}"
                                               download
                                               class="inline-flex items-center text-sm text-orange-500 hover:text-orange-600 font-semibold">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                                Download GPX
                                            </a>
                                        </div>
                                    @elseif($rit->download_link)
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <a href="{{ $rit->download_link }}"
                                               target="_blank"
                                               class="inline-flex items-center text-sm text-orange-500 hover:text-orange-600 font-semibold">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                                Download GPX
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
