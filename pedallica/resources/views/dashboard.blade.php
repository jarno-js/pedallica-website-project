@extends('layouts.app')

@section('title', 'Dashboard - Pedallica')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-2 text-gray-600">Welkom terug, {{ Auth::user()->first_name }}!</p>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <!-- Main Tabs -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <a href="{{ route('dashboard', ['tab' => 'ritten']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm {{ $tab === 'ritten' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Ritten
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'leden']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm {{ $tab === 'leden' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Leden
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'nieuws']) }}"
                       class="group inline-flex items-center py-4 px-6 border-b-2 font-medium text-sm {{ $tab === 'nieuws' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Nieuws
                    </a>
                </nav>
            </div>

            <!-- Sub Tabs (alleen voor Ritten) -->
            @if($tab === 'ritten')
                <div class="bg-gray-50 border-b border-gray-200">
                    <nav class="flex -mb-px overflow-x-auto px-2">
                        @foreach($ploegenVoorAvond as $ploeg)
                            <a href="{{ route('dashboard', ['tab' => 'ritten', 'subtab' => $ploeg->slug]) }}"
                               class="inline-flex items-center py-3 px-4 border-b-2 font-medium text-xs whitespace-nowrap {{ $subTab === $ploeg->slug ? 'border-orange-500 text-orange-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                                {{ $ploeg->name }}
                            </a>
                        @endforeach

                        @if($avondritten)
                            <a href="{{ route('dashboard', ['tab' => 'ritten', 'subtab' => $avondritten->slug]) }}"
                               class="inline-flex items-center py-3 px-4 border-b-2 font-medium text-xs whitespace-nowrap {{ $subTab === $avondritten->slug ? 'border-orange-500 text-orange-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                                {{ $avondritten->name }}
                            </a>
                        @endif

                        @foreach($ploegenNaAvond as $ploeg)
                            <a href="{{ route('dashboard', ['tab' => 'ritten', 'subtab' => $ploeg->slug]) }}"
                               class="inline-flex items-center py-3 px-4 border-b-2 font-medium text-xs whitespace-nowrap {{ $subTab === $ploeg->slug ? 'border-orange-500 text-orange-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                                {{ $ploeg->name }}
                            </a>
                        @endforeach
                    </nav>
                </div>
            @endif

            <!-- Tab Content -->
            <div class="p-6">
                @php
                    $currentPloeg = null;
                    if ($tab === 'ritten') {
                        $currentPloeg = $allePloegen->where('slug', $subTab)->first();
                    }
                @endphp

                @if($tab === 'ritten' && $currentPloeg)
                    <!-- Ploeg Ritten Tab -->
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $currentPloeg->name }}</h2>
                                @if($currentPloeg->description)
                                    <p class="text-gray-600 mt-2">{{ $currentPloeg->description }}</p>
                                @endif
                            </div>
                            <button class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors font-semibold">
                                + Rit Toevoegen
                            </button>
                        </div>

                        <!-- Zoekbalk voor ritten -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" id="rittenZoekbalk" placeholder="Zoek ritten op naam, locatie, datum..."
                                       class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        @if($currentPloeg->ritten->count() > 0)
                            <div id="rittenContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($currentPloeg->ritten as $rit)
                                    <div class="bg-white rounded-lg shadow-md border {{ $currentPloeg->is_evening_rides ? 'border-orange-300' : 'border-gray-200' }} overflow-hidden hover:shadow-lg transition-shadow">
                                        <div class="p-5">
                                            <div class="flex justify-between items-start mb-3">
                                                <h3 class="text-lg font-bold text-gray-900">{{ $rit->title }}</h3>
                                                <button class="text-gray-400 hover:text-gray-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </button>
                                            </div>

                                            @if($rit->description)
                                                <p class="text-sm text-gray-600 mb-4">{{ $rit->description }}</p>
                                            @endif

                                            <div class="space-y-2 text-sm">
                                                <div class="flex items-center text-gray-700">
                                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $rit->date->format('d/m/Y') }}
                                                </div>

                                                @if($rit->start_time)
                                                    <div class="flex items-center text-gray-700">
                                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $rit->start_time }}
                                                    </div>
                                                @endif

                                                @if($rit->location)
                                                    <div class="flex items-center text-gray-700">
                                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $rit->location }}
                                                    </div>
                                                @endif

                                                @if($rit->distance)
                                                    <div class="flex items-center text-gray-700">
                                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                                        </svg>
                                                        {{ $rit->distance }} km
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if($currentPloeg->is_evening_rides)
                                            <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2">
                                                <p class="text-xs text-white font-semibold">Avondrit</p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16">
                                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 text-lg">Nog geen ritten gepland voor {{ $currentPloeg->name }}</p>
                                <p class="text-gray-400 text-sm mt-2">Klik op "Rit Toevoegen" om een nieuwe rit te plannen</p>
                            </div>
                        @endif
                    </div>

                @elseif($tab === 'leden')
                    <!-- Leden Tab -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Leden Overzicht</h2>

                        <!-- Zoekbalk voor personen -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" id="ledenZoekbalk" placeholder="Zoek leden op naam, email, telefoon..."
                                       class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefoon</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($leden as $lid)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($lid->profile_picture)
                                                        <img src="{{ asset($lid->profile_picture) }}" alt="{{ $lid->first_name }}"
                                                             class="w-10 h-10 rounded-full object-cover mr-3">
                                                    @else
                                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                            <span class="text-gray-600 font-semibold">{{ substr($lid->first_name, 0, 1) }}{{ substr($lid->last_name, 0, 1) }}</span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $lid->first_name }} {{ $lid->last_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $lid->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $lid->phone ?? '-' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <button onclick="showUserDetails({{ $lid->id }})"
                                                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                                                    Zie alle gegevens
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($leden->count() === 0)
                            <p class="text-center text-gray-500 py-8">Geen goedgekeurde leden gevonden.</p>
                        @endif
                    </div>

                @elseif($tab === 'nieuws')
                    <!-- Nieuws Tab (zonder toevoegen knop) -->
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Nieuws</h2>

                        @if($nieuws->count() > 0)
                            <div class="space-y-4">
                                @foreach($nieuws as $item)
                                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                                        <div class="text-sm text-gray-500 mb-3">
                                            Door {{ $item->author->first_name }} {{ $item->author->last_name }} •
                                            {{ $item->published_at->format('d/m/Y H:i') }}
                                        </div>
                                        <div class="text-gray-700 prose max-w-none">
                                            {{ Str::limit($item->content, 200) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <p class="mt-2 text-gray-500">Nog geen nieuwsberichten gepubliceerd.</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- User Details Modal -->
<div id="userModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold text-gray-900">Gebruikersgegevens</h3>
            <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="userModalContent" class="space-y-4">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
const ledenData = @json($leden);

function showUserDetails(userId) {
    const user = ledenData.find(u => u.id === userId);
    if (!user) return;

    const content = `
        <div class="flex items-center gap-4 mb-6 pb-6 border-b">
            ${user.profile_picture ?
                `<img src="/${user.profile_picture}" alt="${user.first_name}" class="w-24 h-24 rounded-full object-cover">` :
                `<div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-3xl text-gray-600 font-semibold">${user.first_name[0]}${user.last_name[0]}</span>
                </div>`
            }
            <div>
                <h4 class="text-2xl font-bold text-gray-900">${user.first_name} ${user.last_name}</h4>
                <p class="text-gray-600">${user.email}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="text-gray-900">${user.email}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Telefoon</p>
                <p class="text-gray-900">${user.phone || '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Geboortedatum</p>
                <p class="text-gray-900">${user.birth_date ? new Date(user.birth_date).toLocaleDateString('nl-NL') : '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Land</p>
                <p class="text-gray-900">${user.country || '-'}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm font-medium text-gray-500">Adres</p>
                <p class="text-gray-900">
                    ${user.street && user.house_number ? `${user.street} ${user.house_number}<br>` : ''}
                    ${user.postal_code && user.city ? `${user.postal_code} ${user.city}` : '-'}
                </p>
            </div>
        </div>
    `;

    document.getElementById('userModalContent').innerHTML = content;
    document.getElementById('userModal').classList.remove('hidden');
}

function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('userModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUserModal();
    }
});

// Zoekfunctie voor ritten
const rittenZoekbalk = document.getElementById('rittenZoekbalk');
if (rittenZoekbalk) {
    rittenZoekbalk.addEventListener('input', function(e) {
        const zoekterm = e.target.value.toLowerCase();
        const rittenCards = document.querySelectorAll('#rittenContainer > div');

        rittenCards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(zoekterm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
}

// Zoekfunctie voor leden
const ledenZoekbalk = document.getElementById('ledenZoekbalk');
if (ledenZoekbalk) {
    ledenZoekbalk.addEventListener('input', function(e) {
        const zoekterm = e.target.value.toLowerCase();
        const ledenRows = document.querySelectorAll('tbody tr');

        ledenRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(zoekterm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}
</script>
@endsection
