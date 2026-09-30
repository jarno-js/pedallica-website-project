<div>
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Gebruikersbeheer</h2>

    <!-- Zoekbalk voor personen -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" id="adminLedenZoekbalk" placeholder="Zoek gebruikers op naam, email, telefoon..."
                   class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <!-- Pending Users Section -->
    @if($pendingUsers->count() > 0)
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm mr-3">{{ $pendingUsers->count() }}</span>
                Wachtend op goedkeuring
            </h3>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <p class="text-yellow-700">Deze gebruikers wachten op goedkeuring voordat ze toegang krijgen tot het platform.</p>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gebruiker</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefoon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Geregistreerd op</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendingUsers as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($user->profile_picture)
                                            <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->first_name }}"
                                                 class="w-10 h-10 rounded-full object-cover mr-3">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                <span class="text-gray-600 font-semibold">{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->phone ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="showUserDetails({{ $user->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                                        Bekijk
                                    </button>
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                                            Goedkeuren
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                            Verwijderen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Approved Users Section -->
    <div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Goedgekeurde Gebruikers</h3>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gebruiker</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefoon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($approvedUsers as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($user->profile_picture)
                                        <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->first_name }}"
                                             class="w-10 h-10 rounded-full object-cover mr-3">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            <span class="text-gray-600 font-semibold">{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->phone ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->is_admin)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Lid
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick="showUserDetails({{ $user->id }})" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                                    Bekijk
                                </button>
                                @if($user->is_admin)
                                    <form action="{{ route('admin.users.remove-admin', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
                                            Verwijder Admin
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.make-admin', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-3 py-1 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                                            Maak Admin
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                        Verwijderen
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
// Combineer pending en approved users voor modal
const allUsersData = @json($pendingUsers->merge($approvedUsers));

function showUserDetails(userId) {
    const user = allUsersData.find(u => u.id === userId);
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
                ${user.is_admin ? '<span class="inline-block mt-1 px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">Admin</span>' : ''}
                ${user.approved ? '<span class="inline-block mt-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Goedgekeurd</span>' : '<span class="inline-block mt-1 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Wachtend</span>'}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm font-medium text-gray-500">Voornaam</p>
                <p class="text-gray-900">${user.first_name}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Achternaam</p>
                <p class="text-gray-900">${user.last_name}</p>
            </div>
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
            <div>
                <p class="text-sm font-medium text-gray-500">Straat</p>
                <p class="text-gray-900">${user.street || '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Huisnummer</p>
                <p class="text-gray-900">${user.house_number || '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Postcode</p>
                <p class="text-gray-900">${user.postal_code || '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Stad</p>
                <p class="text-gray-900">${user.city || '-'}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Geregistreerd op</p>
                <p class="text-gray-900">${new Date(user.created_at).toLocaleDateString('nl-NL')} ${new Date(user.created_at).toLocaleTimeString('nl-NL', {hour: '2-digit', minute: '2-digit'})}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Email geverifieerd</p>
                <p class="text-gray-900">${user.email_verified_at ? new Date(user.email_verified_at).toLocaleDateString('nl-NL') : 'Nee'}</p>
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

// Zoekfunctie voor leden in admin
const adminLedenZoekbalk = document.getElementById('adminLedenZoekbalk');
if (adminLedenZoekbalk) {
    adminLedenZoekbalk.addEventListener('input', function(e) {
        const zoekterm = e.target.value.toLowerCase();
        const allRows = document.querySelectorAll('tbody tr');

        allRows.forEach(row => {
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
