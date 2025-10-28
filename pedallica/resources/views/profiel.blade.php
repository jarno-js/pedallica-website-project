@extends('layouts.app')

@section('title', 'Mijn Profiel - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mijn Profiel</h1>
            <p class="mt-2 text-gray-600">Bekijk en wijzig je persoonlijke gegevens</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profielfoto -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="bg-orange-500 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Profielfoto</h2>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    <!-- Huidige Foto -->
                    <div class="flex-shrink-0">
                        @if($user->profile_picture)
                            <img src="{{ asset($user->profile_picture) }}" alt="Profielfoto"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-orange-500">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center border-4 border-gray-300">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Upload Form -->
                    <div class="flex-grow">
                        <form method="POST" action="{{ route('profiel.picture') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nieuwe profielfoto uploaden
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('profile_picture') border-red-500 @enderror">
                                @error('profile_picture')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">JPG, PNG of GIF. Maximaal 2MB.</p>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-colors">
                                    Foto Uploaden
                                </button>

                                @if($user->profile_picture)
                                    <button type="button" onclick="event.preventDefault(); document.getElementById('delete-picture-form').submit();"
                                            class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition-colors">
                                        Foto Verwijderen
                                    </button>
                                @endif
                            </div>
                        </form>

                        @if($user->profile_picture)
                            <form id="delete-picture-form" method="POST" action="{{ route('profiel.picture.delete') }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Profiel Informatie -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="bg-orange-500 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Persoonlijke Gegevens</h2>
            </div>

            <form method="POST" action="{{ route('profiel.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Voornaam -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Voornaam *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Achternaam -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Achternaam *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mailadres *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telefoon -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefoonnummer</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Geboortedatum -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Geboortedatum</label>
                        <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('d/m/Y') : '') }}" placeholder="dd/mm/jjjj"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Adres sectie -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Adresgegevens</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Straat -->
                        <div>
                            <label for="street" class="block text-sm font-medium text-gray-700 mb-2">Straat</label>
                            <input type="text" id="street" name="street" value="{{ old('street', $user->street) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('street') border-red-500 @enderror">
                            @error('street')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Huisnummer -->
                        <div>
                            <label for="house_number" class="block text-sm font-medium text-gray-700 mb-2">Huisnummer</label>
                            <input type="text" id="house_number" name="house_number" value="{{ old('house_number', $user->house_number) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('house_number') border-red-500 @enderror">
                            @error('house_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Postcode -->
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postcode</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('postal_code') border-red-500 @enderror">
                            @error('postal_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stad -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Stad</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-colors">
                        Gegevens Opslaan
                    </button>
                </div>
            </form>
        </div>

        <!-- Wachtwoord Wijzigen -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-orange-500 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Wachtwoord Wijzigen</h2>
            </div>

            <form method="POST" action="{{ route('profiel.password') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 max-w-md">
                    <!-- Huidig Wachtwoord -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Huidig Wachtwoord *</label>
                        <input type="password" id="current_password" name="current_password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nieuw Wachtwoord -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nieuw Wachtwoord *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Minimaal 8 karakters</p>
                    </div>

                    <!-- Bevestig Nieuw Wachtwoord -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Bevestig Nieuw Wachtwoord *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-orange-500 text-white font-semibold rounded-md hover:bg-orange-600 transition-colors">
                        Wachtwoord Wijzigen
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // Datum input formatter (dd/mm/yyyy)
    const birthDateInput = document.getElementById('birth_date');
    if (birthDateInput) {
        birthDateInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }
            if (value.length >= 5) {
                value = value.slice(0, 5) + '/' + value.slice(5, 9);
            }
            e.target.value = value;
        });
    }

    // Validatie bij submit van profiel formulier
    const profielForm = document.querySelector('form[action="{{ route('profiel.update') }}"]');
    if (profielForm) {
        profielForm.addEventListener('submit', function(e) {
            const dateValue = birthDateInput.value;
            if (dateValue) {
                const datePattern = /^(\d{2})\/(\d{2})\/(\d{4})$/;
                const match = dateValue.match(datePattern);

                if (!match) {
                    e.preventDefault();
                    alert('Voer een geldige datum in (dd/mm/jjjj)');
                    return false;
                }

                const day = parseInt(match[1]);
                const month = parseInt(match[2]);
                const year = parseInt(match[3]);

                if (day < 1 || day > 31 || month < 1 || month > 12 || year < 1900 || year > new Date().getFullYear()) {
                    e.preventDefault();
                    alert('Voer een geldige datum in');
                    return false;
                }
            }
        });
    }
</script>
@endsection
