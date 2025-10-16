<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Sponsorbeheer</h2>
        <button onclick="openSponsorModal()" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors font-semibold">
            + Sponsor Toevoegen
        </button>
    </div>

    @if($sponsors->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sponsors as $sponsor)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex flex-col items-center">
                        @if($sponsor->logo)
                            <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                 class="w-32 h-32 object-contain mb-4" onerror="this.src='{{ asset('placeholder.png') }}'">
                        @else
                            <div class="w-32 h-32 bg-gray-200 flex items-center justify-center mb-4 rounded">
                                <span class="text-gray-400 text-xs text-center">Geen logo</span>
                            </div>
                        @endif
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $sponsor->name }}</h3>
                        @if($sponsor->website)
                            <a href="{{ $sponsor->website }}" target="_blank"
                               class="text-sm text-blue-600 hover:text-blue-800 mb-4">
                                Website bezoeken
                            </a>
                        @endif
                        <div class="flex gap-2 mt-4">
                            <button onclick='editSponsor({{ $sponsor->id }}, "{{ addslashes($sponsor->name) }}", "{{ $sponsor->website ?? "" }}")'
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-sm">
                                Bewerken
                            </button>
                            <form action="{{ route('admin.sponsors.delete', $sponsor->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je deze sponsor wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors text-sm">
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
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-gray-500">Nog geen sponsors toegevoegd.</p>
        </div>
    @endif
</div>

<!-- Sponsor Modal -->
<div id="sponsorModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold text-gray-900" id="sponsorModalTitle">Sponsor Toevoegen</h3>
            <button onclick="closeSponsorModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="sponsorForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="sponsorMethod" value="POST">
            <div class="space-y-4">
                <div>
                    <label for="sponsor_name" class="block text-sm font-medium text-gray-700 mb-1">Naam</label>
                    <input type="text" name="name" id="sponsor_name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label for="sponsor_logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" id="sponsor_logo" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <p class="text-xs text-gray-500 mt-1" id="logoHelp">Upload een afbeelding (max 2MB)</p>
                </div>
                <div>
                    <label for="sponsor_website" class="block text-sm font-medium text-gray-700 mb-1">Website (optioneel)</label>
                    <input type="url" name="website" id="sponsor_website"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                           placeholder="https://www.example.com">
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="closeSponsorModal()"
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
function openSponsorModal() {
    document.getElementById('sponsorModalTitle').textContent = 'Sponsor Toevoegen';
    document.getElementById('sponsorForm').action = "{{ route('admin.sponsors.store') }}";
    document.getElementById('sponsorMethod').value = 'POST';
    document.getElementById('sponsor_name').value = '';
    document.getElementById('sponsor_logo').value = '';
    document.getElementById('sponsor_logo').required = true;
    document.getElementById('logoHelp').textContent = 'Upload een afbeelding (max 2MB)';
    document.getElementById('sponsor_website').value = '';
    document.getElementById('sponsorModal').classList.remove('hidden');
}

function editSponsor(id, name, website) {
    document.getElementById('sponsorModalTitle').textContent = 'Sponsor Bewerken';
    document.getElementById('sponsorForm').action = `/admin/sponsors/${id}`;
    document.getElementById('sponsorMethod').value = 'PUT';
    document.getElementById('sponsor_name').value = name;
    document.getElementById('sponsor_logo').required = false;
    document.getElementById('logoHelp').textContent = 'Laat leeg om huidige logo te behouden';
    document.getElementById('sponsor_website').value = website || '';
    document.getElementById('sponsorModal').classList.remove('hidden');
}

function closeSponsorModal() {
    document.getElementById('sponsorModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('sponsorModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSponsorModal();
    }
});
</script>
