@extends('layouts.app')

@section('title', 'Contact - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Neem Contact Op</h1>
            <p class="text-lg text-gray-600">Heb je een vraag of wil je meer informatie? Stuur ons een bericht!</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <x-alert type="success" class="mb-6">
                {{ session('success') }}
            </x-alert>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <x-alert type="error" class="mb-6">
                {{ session('error') }}
            </x-alert>
        @endif

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <!-- Naam -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Naam <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-mailadres <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Onderwerp -->
                <div class="mb-6">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                        Onderwerp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bericht -->
                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                        Bericht <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" id="message" rows="6" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Maximaal 5000 karakters</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                        Terug naar home
                    </a>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg transition-colors shadow-md">
                        Verzenden
                    </button>
                </div>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-orange-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <a href="mailto:pedallica@outlook.be" class="text-orange-500 hover:text-orange-600">
                            pedallica@outlook.be
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-orange-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Locatie</h3>
                        <p class="text-gray-600">Café In de Rustberg</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
