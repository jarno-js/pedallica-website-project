<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">Nieuwsbeheer</h2>
        <button onclick="openNewsModal()" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors font-semibold">
            + Nieuws Toevoegen
        </button>
    </div>

    @if($nieuws->count() > 0)
        <div class="space-y-4">
            @foreach($nieuws as $item)
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $item->title }}</h3>
                                @if($item->published)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Gepubliceerd
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Concept
                                    </span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-500 mb-3">
                                Door {{ $item->author->first_name }} {{ $item->author->last_name }} •
                                {{ $item->created_at->format('d/m/Y H:i') }}
                                @if($item->published_at)
                                    • Gepubliceerd: {{ $item->published_at->format('d/m/Y H:i') }}
                                @endif
                            </div>
                            <div class="text-gray-700 prose max-w-none">
                                {{ Str::limit($item->content, 200) }}
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <button onclick="editNews({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->content) }}', {{ $item->published ? 'true' : 'false' }})"
                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-sm">
                                Bewerken
                            </button>
                            <form action="{{ route('admin.news.delete', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je dit nieuws wilt verwijderen?')">
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
                      d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <p class="mt-2 text-gray-500">Nog geen nieuwsberichten toegevoegd.</p>
        </div>
    @endif
</div>

<!-- News Modal -->
<div id="newsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-2xl font-bold text-gray-900" id="newsModalTitle">Nieuws Toevoegen</h3>
            <button onclick="closeNewsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="newsForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="newsMethod" value="POST">
            <div class="space-y-4">
                <div>
                    <label for="news_title" class="block text-sm font-medium text-gray-700 mb-1">Titel</label>
                    <input type="text" name="title" id="news_title" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label for="news_content" class="block text-sm font-medium text-gray-700 mb-1">Inhoud</label>
                    <textarea name="content" id="news_content" rows="8" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div>
                    <label for="news_published" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="published" id="news_published" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="0">Concept (niet zichtbaar)</option>
                        <option value="1">Gepubliceerd (zichtbaar voor iedereen)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" onclick="closeNewsModal()"
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
function openNewsModal() {
    document.getElementById('newsModalTitle').textContent = 'Nieuws Toevoegen';
    document.getElementById('newsForm').action = "{{ route('admin.news.store') }}";
    document.getElementById('newsMethod').value = 'POST';
    document.getElementById('news_title').value = '';
    document.getElementById('news_content').value = '';
    document.getElementById('news_published').value = '0';
    document.getElementById('newsModal').classList.remove('hidden');
}

function editNews(id, title, content, published) {
    document.getElementById('newsModalTitle').textContent = 'Nieuws Bewerken';
    document.getElementById('newsForm').action = `/admin/news/${id}`;
    document.getElementById('newsMethod').value = 'PUT';
    document.getElementById('news_title').value = title;
    document.getElementById('news_content').value = content;
    document.getElementById('news_published').value = published ? '1' : '0';
    document.getElementById('newsModal').classList.remove('hidden');
}

function closeNewsModal() {
    document.getElementById('newsModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('newsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeNewsModal();
    }
});
</script>
