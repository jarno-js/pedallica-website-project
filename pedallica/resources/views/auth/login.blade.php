@extends('layouts.app')

@section('title', 'Inloggen - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Welkom terug!</h1>
            <p class="text-gray-600">Log in op je Pedallica account</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-mailadres <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Wachtwoord -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Wachtwoord <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Onthoud mij -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Onthoud mij
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-4">
                    <button
                        type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg transition-colors"
                    >
                        Inloggen
                    </button>

                    <a
                        href="{{ route('home') }}"
                        class="w-full text-center text-gray-600 hover:text-gray-900 py-2"
                    >
                        Terug naar home
                    </a>
                </div>

                <p class="text-center text-gray-600 mt-6 pt-6 border-t border-gray-200">
                    Heb je nog geen account?
                    <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                        Registreer hier
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
