<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Evenementenbeheer</h2>
        <button onclick="openEventModal()" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors font-semibold">
            + Evenement Toevoegen
        </button>
    </div>

    @if($events->count() > 0)
        <div class="space-y-4">
            @foreach($events as $event)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex gap-4">
                        <!-- Poster Preview -->
                        <div class="flex-shrink-0">
                            @if($event->poster)
                                <img src="{{ asset($event->poster) }}" alt="{{ $event->title }}"
                                     class="w-32 h-32 object-cover rounded" onerror="this.parentElement.innerHTML='<div class=\'w-32 h-32 bg-gray-200 flex items-center justify-center rounded\'><span class=\'text-gray-400 text-xs text-center\'>Geen poster</span></div>'">
                            @else
                                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded">
                                    <span class="text-gray-400 text-xs text-center">Geen poster</span>
                                </div>
                            @endif
                        </div>

                        <!-- Event Details -->
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                </div>
                                @if($event->location)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $event->location }}
                                    </div>
                                @endif
                            </div>
                            @if($event->description)
                                <p class="text-gray-700">{{ $event->description }}</p>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2">
                            <button onclick='editEvent({{ $event->id }}, "{{ addslashes($event->title) }}", "{{ addslashes($event->description ?? "") }}", "{{ $event->date }}", "{{ addslashes($event->location ?? "") }}")'
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-sm whitespace-nowrap">
                                Bewerken
                            </button>
                            <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je dit evenement wilt verwijderen?')">
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
        <div class="text-center py-12 bg-white rounded-lg shadow">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-gray-500">Nog geen evenementen toegevoegd.</p>
        </div>
    @endif
</div>

<!-- Event Modal -->
<div id="eventModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold text-gray-900" id="eventModalTitle">Evenement Toevoegen</h3>
            <button onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="eventForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="eventMethod" value="POST">
            <div class="space-y-4">
                <div>
                    <label for="event_title" class="block text-sm font-medium text-gray-700 mb-1">Titel</label>
                    <input type="text" name="title" id="event_title" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label for="event_poster" class="block text-sm font-medium text-gray-700 mb-1">Poster</label>
                    <input type="file" name="poster" id="event_poster" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <p class="text-xs text-gray-500 mt-1" id="posterHelp">Upload een afbeelding (max 2MB)</p>
                </div>
                <div>
                    <label for="event_description" class="block text-sm font-medium text-gray-700 mb-1">Beschrijving (optioneel)</label>
                    <textarea name="description" id="event_description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Datum</label>
                    <input type="date" name="date" id="event_date" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label for="event_location" class="block text-sm font-medium text-gray-700 mb-1">Locatie (optioneel)</label>
                    <input type="text" name="location" id="event_location"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="closeEventModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Annuleren
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                        Opslaan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openEventModal() {
    document.getElementById('eventModalTitle').textContent = 'Evenement Toevoegen';
    document.getElementById('eventForm').action = "{{ route('admin.events.store') }}";
    document.getElementById('eventMethod').value = 'POST';
    document.getElementById('event_title').value = '';
    document.getElementById('event_poster').value = '';
    document.getElementById('event_poster').required = false;
    document.getElementById('posterHelp').textContent = 'Upload een afbeelding (max 2MB)';
    document.getElementById('event_description').value = '';
    document.getElementById('event_date').value = '';
    document.getElementById('event_location').value = '';
    document.getElementById('eventModal').classList.remove('hidden');
}

function editEvent(id, title, description, date, location) {
    document.getElementById('eventModalTitle').textContent = 'Evenement Bewerken';
    document.getElementById('eventForm').action = `/admin/events/${id}`;
    document.getElementById('eventMethod').value = 'PUT';
    document.getElementById('event_title').value = title;
    document.getElementById('event_poster').required = false;
    document.getElementById('posterHelp').textContent = 'Laat leeg om huidige poster te behouden';
    document.getElementById('event_description').value = description;
    document.getElementById('event_date').value = date;
    document.getElementById('event_location').value = location;
    document.getElementById('eventModal').classList.remove('hidden');
}

function closeEventModal() {
    document.getElementById('eventModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('eventModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEventModal();
    }
});
</script>
