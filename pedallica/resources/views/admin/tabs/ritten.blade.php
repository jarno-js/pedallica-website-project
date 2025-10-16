<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Rittenbeheer</h2>
        <button onclick="openRitModal()" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors font-semibold">
            + Rit Toevoegen
        </button>
    </div>

    @if($ritten->count() > 0)
        <div class="space-y-4">
            @foreach($ritten as $rit)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <!-- Photo Preview -->
                        <div class="flex-shrink-0">
                            @if($rit->photo)
                                <img src="{{ asset($rit->photo) }}" alt="{{ $rit->title }}"
                                     class="w-32 h-32 object-cover rounded" onerror="this.parentElement.innerHTML='<div class=\'w-32 h-32 bg-gray-200 flex items-center justify-center rounded\'><span class=\'text-gray-400 text-xs text-center\'>Geen foto</span></div>'">
                            @else
                                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded">
                                    <span class="text-gray-400 text-xs text-center">Geen foto</span>
                                </div>
                            @endif
                        </div>

                        <!-- Rit Details -->
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $rit->title }}</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                    {{ $rit->ploeg->name }}
                                </span>
                            </div>

                            @if($rit->route_name)
                                <p class="text-sm text-gray-600 mb-1"><strong>Route:</strong> {{ $rit->route_name }}</p>
                            @endif

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $rit->date->format('d/m/Y') }}
                                    @if($rit->start_time)
                                        om {{ $rit->start_time }}
                                    @endif
                                </div>
                                @if($rit->distance)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        {{ $rit->distance }} km
                                    </div>
                                @endif
                                @if($rit->location)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $rit->location }}
                                    </div>
                                @endif
                            </div>

                            @if($rit->start_address)
                                <p class="text-sm text-gray-600 mb-2"><strong>Start adres:</strong> {{ $rit->start_address }}</p>
                            @endif

                            @if($rit->description)
                                <p class="text-gray-700 mb-2">{{ Str::limit($rit->description, 150) }}</p>
                            @endif

                            <div class="flex gap-3 mt-2">
                                @if($rit->gpx_file)
                                    <a href="{{ asset($rit->gpx_file) }}" download
                                       class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition-colors">
                                        📥 GPX Download
                                    </a>
                                @endif
                                @if($rit->download_link)
                                    <a href="{{ $rit->download_link }}" target="_blank"
                                       class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                        🔗 Externe Link
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2">
                            <button onclick="editRit({{ $rit->id }}, {{ json_encode($rit) }})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-sm whitespace-nowrap">
                                Bewerken
                            </button>
                            <form action="{{ route('admin.ritten.delete', $rit->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je deze rit wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors text-sm whitespace-nowrap">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg shadow">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Nog geen ritten toegevoegd</h3>
            <p class="text-gray-600">Klik op "Rit Toevoegen" om je eerste rit te plannen.</p>
        </div>
    @endif
</div>

<!-- Rit Modal -->
<div id="ritModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white mb-10">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold text-gray-900" id="ritModalTitle">Rit Toevoegen</h3>
            <button onclick="closeRitModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="ritForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="ritMethod" value="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Ploeg Selection -->
                <div class="md:col-span-2">
                    <label for="rit_ploeg_id" class="block text-sm font-medium text-gray-700 mb-1">Ploeg *</label>
                    <select name="ploeg_id" id="rit_ploeg_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Selecteer een ploeg</option>
                        @foreach($ploegen as $ploeg)
                            <option value="{{ $ploeg->id }}">{{ $ploeg->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="rit_title" class="block text-sm font-medium text-gray-700 mb-1">Titel *</label>
                    <input type="text" name="title" id="rit_title" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Route Name -->
                <div class="md:col-span-2">
                    <label for="rit_route_name" class="block text-sm font-medium text-gray-700 mb-1">Naam van de route</label>
                    <input type="text" name="route_name" id="rit_route_name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Date -->
                <div>
                    <label for="rit_date" class="block text-sm font-medium text-gray-700 mb-1">Datum *</label>
                    <input type="date" name="date" id="rit_date" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Start Time -->
                <div>
                    <label for="rit_start_time" class="block text-sm font-medium text-gray-700 mb-1">Start tijd</label>
                    <input type="time" name="start_time" id="rit_start_time"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Distance -->
                <div>
                    <label for="rit_distance" class="block text-sm font-medium text-gray-700 mb-1">Aantal km</label>
                    <input type="number" name="distance" id="rit_distance"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Location -->
                <div>
                    <label for="rit_location" class="block text-sm font-medium text-gray-700 mb-1">Start locatie</label>
                    <input type="text" name="location" id="rit_location"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Start Address -->
                <div class="md:col-span-2">
                    <label for="rit_start_address" class="block text-sm font-medium text-gray-700 mb-1">Adres van de start locatie</label>
                    <input type="text" name="start_address" id="rit_start_address"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                           placeholder="Straat nummer, postcode stad">
                </div>

                <!-- Download Link -->
                <div class="md:col-span-2">
                    <label for="rit_download_link" class="block text-sm font-medium text-gray-700 mb-1">Download link</label>
                    <input type="url" name="download_link" id="rit_download_link"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                           placeholder="https://...">
                </div>

                <!-- GPX File -->
                <div>
                    <label for="rit_gpx_file" class="block text-sm font-medium text-gray-700 mb-1">GPX bestand</label>
                    <input type="file" name="gpx_file" id="rit_gpx_file" accept=".gpx"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <p class="text-xs text-gray-500 mt-1" id="gpxHelp">Upload een GPX bestand (max 5MB)</p>
                </div>

                <!-- Photo -->
                <div>
                    <label for="rit_photo" class="block text-sm font-medium text-gray-700 mb-1">Foto (optioneel)</label>
                    <input type="file" name="photo" id="rit_photo" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <p class="text-xs text-gray-500 mt-1" id="photoHelp">Upload een foto (max 2MB)</p>
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="rit_description" class="block text-sm font-medium text-gray-700 mb-1">Beschrijving</label>
                    <textarea name="description" id="rit_description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 mt-4 border-t">
                <button type="button" onclick="closeRitModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                    Annuleren
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRitModal() {
    document.getElementById('ritModalTitle').textContent = 'Rit Toevoegen';
    document.getElementById('ritForm').action = "{{ route('admin.ritten.store') }}";
    document.getElementById('ritMethod').value = 'POST';
    document.getElementById('rit_ploeg_id').value = '';
    document.getElementById('rit_title').value = '';
    document.getElementById('rit_route_name').value = '';
    document.getElementById('rit_date').value = '';
    document.getElementById('rit_start_time').value = '';
    document.getElementById('rit_distance').value = '';
    document.getElementById('rit_location').value = '';
    document.getElementById('rit_start_address').value = '';
    document.getElementById('rit_download_link').value = '';
    document.getElementById('rit_gpx_file').value = '';
    document.getElementById('rit_photo').value = '';
    document.getElementById('rit_description').value = '';
    document.getElementById('gpxHelp').textContent = 'Upload een GPX bestand (max 5MB)';
    document.getElementById('photoHelp').textContent = 'Upload een foto (max 2MB)';
    document.getElementById('ritModal').classList.remove('hidden');
}

function editRit(id, rit) {
    document.getElementById('ritModalTitle').textContent = 'Rit Bewerken';
    document.getElementById('ritForm').action = `/admin/ritten/${id}`;
    document.getElementById('ritMethod').value = 'PUT';
    document.getElementById('rit_ploeg_id').value = rit.ploeg_id;
    document.getElementById('rit_title').value = rit.title;
    document.getElementById('rit_route_name').value = rit.route_name || '';
    document.getElementById('rit_date').value = rit.date;
    document.getElementById('rit_start_time').value = rit.start_time || '';
    document.getElementById('rit_distance').value = rit.distance || '';
    document.getElementById('rit_location').value = rit.location || '';
    document.getElementById('rit_start_address').value = rit.start_address || '';
    document.getElementById('rit_download_link').value = rit.download_link || '';
    document.getElementById('rit_description').value = rit.description || '';
    document.getElementById('gpxHelp').textContent = 'Laat leeg om huidig GPX bestand te behouden';
    document.getElementById('photoHelp').textContent = 'Laat leeg om huidige foto te behouden';
    document.getElementById('ritModal').classList.remove('hidden');
}

function closeRitModal() {
    document.getElementById('ritModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('ritModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRitModal();
    }
});
</script>
