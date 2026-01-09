@extends('layouts.app')

@section('title', $user->username . ' - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profiel Header -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-32"></div>

            <div class="px-6 pb-6">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-12">
                    <!-- Profielfoto -->
                    <div class="relative">
                        @if($user->profile_picture)
                            <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->username }}"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Gebruikersinfo -->
                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $user->username }}</h1>
                        <p class="text-lg text-gray-600 mt-1">{{ $user->first_name }} {{ $user->last_name }}</p>

                        @if($user->birth_date)
                            <p class="text-sm text-gray-500 mt-2">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Lid sinds {{ $user->created_at->format('F Y') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Over Mij Sectie -->
        @if($user->about_me)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Over Mij
                </h2>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $user->about_me }}</p>
            </div>
        @endif

        <!-- Informatie Kaarten -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Persoonlijke Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informatie
                </h3>

                <div class="space-y-3">
                    @if($user->birth_date)
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Verjaardag: {{ $user->birth_date->format('d F') }}</span>
                        </div>
                    @endif

                    @if($user->city && $user->country)
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $user->city }}, {{ $user->country }}</span>
                        </div>
                    @endif

                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Lid sinds {{ $user->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Pedallica Badge -->
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-md p-6 text-white">
                <h3 class="text-xl font-bold mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Pedallica Lid
                </h3>

                <p class="text-white opacity-90">
                    {{ $user->username }} is een actief lid van de Pedallica fietsclub en deel uit van onze community.
                </p>

                @if($user->is_admin)
                    <div class="mt-4 bg-white bg-opacity-20 rounded-lg p-3">
                        <p class="font-semibold flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Club Administrator
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Terug knop -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-orange-500 hover:text-orange-600 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Terug naar home
            </a>
        </div>
    </div>
</div>
@endsection
