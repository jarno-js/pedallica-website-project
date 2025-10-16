@extends('layouts.app')

@section('title', 'Admin Dashboard - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-2 text-gray-600">Beheer gebruikers, nieuws, sponsors en evenementen</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px overflow-x-auto">
                    <a href="{{ route('admin.dashboard', ['tab' => 'leden']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap {{ $tab === 'leden' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Leden
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'newsletter']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap {{ $tab === 'newsletter' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Newsletter
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'sponsors']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap {{ $tab === 'sponsors' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Sponsors
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'evenementen']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap {{ $tab === 'evenementen' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Evenementen
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'ritten']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm whitespace-nowrap {{ $tab === 'ritten' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Ritten
                    </a>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                @if($tab === 'leden')
                    @include('admin.tabs.leden')
                @elseif($tab === 'newsletter')
                    @include('admin.tabs.newsletter')
                @elseif($tab === 'sponsors')
                    @include('admin.tabs.sponsors')
                @elseif($tab === 'evenementen')
                    @include('admin.tabs.evenementen')
                @elseif($tab === 'ritten')
                    @include('admin.tabs.ritten')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
