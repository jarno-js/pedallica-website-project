@extends('layouts.app')

@section('title', 'Registreren - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Account aanmaken</h1>
            <p class="text-gray-600">Word lid van de Pedallica community</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Profielfoto -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Profielfoto (optioneel)
                    </label>
                    <div class="flex items-center space-x-4">
                        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            <img id="preview" class="hidden w-full h-full object-cover" alt="Preview">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>
                    @error('profile_picture')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Voornaam en Achternaam -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Voornaam <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Achternaam <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email en Username -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            E-mailadres <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Gebruikersnaam <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Deze naam wordt op je profiel getoond</p>
                    </div>
                </div>

                <!-- Wachtwoord en Herhaal Wachtwoord -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Wachtwoord <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Herhaal wachtwoord <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <!-- Geboortedatum -->
                <div class="mb-6">
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Geboortedatum <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required placeholder="dd/mm/jjjj" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('birth_date') border-red-500 @enderror">
                    @error('birth_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GSM-nummer -->
                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        GSM-nummer <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="+32 123 45 67 89" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Straat en Huisnummer -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label for="street" class="block text-sm font-medium text-gray-700 mb-2">
                            Straat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="street" id="street" value="{{ old('street') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('street') border-red-500 @enderror">
                        @error('street')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="house_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Huisnummer <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="house_number" id="house_number" value="{{ old('house_number') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('house_number') border-red-500 @enderror">
                        @error('house_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Postcode en Stad -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                            Postcode <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('postal_code') border-red-500 @enderror">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                            Stad <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('city') border-red-500 @enderror">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Land -->
                <div class="mb-6">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                        Land <span class="text-red-500">*</span>
                    </label>
                    <select name="country" id="country" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500 @error('country') border-red-500 @enderror">
                        <option value="">Selecteer een land</option>
                        <option value="België" {{ old('country') == 'België' ? 'selected' : '' }}>België</option>
                        <option value="Nederland" {{ old('country') == 'Nederland' ? 'selected' : '' }}>Nederland</option>
                        <option value="Frankrijk" {{ old('country') == 'Frankrijk' ? 'selected' : '' }}>Frankrijk</option>
                        <option value="Duitsland" {{ old('country') == 'Duitsland' ? 'selected' : '' }}>Duitsland</option>
                        <option value="Luxemburg" {{ old('country') == 'Luxemburg' ? 'selected' : '' }}>Luxemburg</option>
                        <option value="Anders" {{ old('country') == 'Anders' ? 'selected' : '' }}>Anders</option>
                    </select>
                    @error('country')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                        Terug naar home
                    </a>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                        Account aanmaken
                    </button>
                </div>

                <p class="text-center text-gray-600 mt-6">
                    Heb je al een account?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                        Log hier in
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview van profielfoto
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                preview.parentElement.querySelector('svg').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Datum input formatter (dd/mm/yyyy)
    const birthDateInput = document.getElementById('birth_date');
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

    // Validatie bij submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const dateValue = birthDateInput.value;
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
    });
</script>
@endsection
