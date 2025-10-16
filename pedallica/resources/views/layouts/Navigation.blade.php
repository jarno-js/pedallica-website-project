<!-- Navigatie Balk -->
<nav class="bg-black shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo + Naam -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group logo-wrapper">
                <img
                    src="{{ asset('Pedallica_LOGO.png') }}"
                    alt="Pedallica logo"
                    class="h-10 w-auto transition-all duration-300 logo-img"
                    data-hover="{{ asset('Pedallica_LOGO_O.png') }}"
                >
                <span class="text-2xl font-bold text-white group-hover:text-orange-500 transition-colors">
                    PEDALLICA
                </span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('fotos-sponsors') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                    Sponsors
                </a>
                <a href="{{ route('fotos-ploegen') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                    Ploegen
                </a>
                <a href="{{ route('evenementen') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                    Evenementen
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                        Dashboard
                    </a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                            Admin Dashboard
                        </a>
                    @endif
                @endauth

                <!-- Account Dropdown -->
                <div class="relative">
                    <button id="account-button" class="flex items-center space-x-1 px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">
                        @auth
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profielfoto"
                                     class="w-8 h-8 rounded-full object-cover border-2 border-white">
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endauth
                        <span>Account</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="account-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        @guest
                            <a href="/login" class="block px-4 py-2 text-gray-700 hover:bg-orange-500 hover:text-white transition-colors">
                                Inloggen
                            </a>
                            <a href="/register" class="block px-4 py-2 text-gray-700 hover:bg-orange-500 hover:text-white transition-colors">
                                Registreren
                            </a>
                        @else
                            <a href="{{ route('profiel') }}" class="block px-4 py-2 text-gray-700 hover:bg-orange-500 hover:text-white transition-colors">
                                Profiel
                            </a>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-orange-500 hover:text-white transition-colors">
                                    Uitloggen
                                </button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white hover:text-orange-500 transition-colors">
                    <svg id="menu-open-icon" class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="menu-close-icon" class="h-7 w-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('fotos-sponsors') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">Sponsors</a>
                <a href="{{ route('fotos-ploegen') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">Ploegen</a>
                <a href="{{ route('evenementen') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">Evenementen</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">Dashboard</a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-white hover:bg-orange-500 hover:text-black rounded-md transition-colors font-medium">Admin Dashboard</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
