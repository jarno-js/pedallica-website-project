<style>
    .nav-desktop { display: none; }
    .nav-mobile-btn { display: flex; margin-left: auto; }
    .nav-mobile-menu { display: none; }
    @media (min-width: 1300px) {
        .nav-desktop { display: flex; align-items: center; gap: 1.5rem; margin-left: auto; }
        .nav-mobile-btn { display: none; }
    }
</style>

{{-- ===== NAVBAR: solide navbar, logo groot gecentreerd ===== --}}
<nav id="top" style="
    background-color: #1a1a1d;
    overflow: visible;
    position: relative;
    z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
">
    <div style="display: flex; align-items: center; height: 130px; padding: 0 2rem; position: relative;">

        {{-- Logo groot gecentreerd --}}
        <a href="{{ route('home') }}" class="logo-wrapper" style="
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-25%);
            display: flex;
            align-items: center;
            z-index: 51;
        ">
            <img
                src="{{ asset('Pedallica_LOGO.png') }}"
                alt="Pedallica logo"
                class="logo-img"
                data-hover="{{ asset('Pedallica_LOGO.png') }}"
                style="height: 140px; width: auto; filter: drop-shadow(0 4px 16px rgba(0,0,0,0.6));"
            >
        </a>

        {{-- Desktop nav links rechts --}}
        <div class="nav-desktop">
            <a href="{{ route('home') }}#top" style="color:#fff; font-weight:600; text-decoration:none; font-family:Inter,sans-serif; transition:color .2s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                Pedallica
            </a>
            <a href="{{ route('home') }}#ploegen" style="color:#fff; font-weight:600; text-decoration:none; font-family:Inter,sans-serif; transition:color .2s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                Ploegen
            </a>
            <a href="{{ route('home') }}#kalender" style="color:#fff; font-weight:600; text-decoration:none; font-family:Inter,sans-serif; transition:color .2s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                Kalender
            </a>

            @auth
                <a href="{{ route('dashboard') }}" style="color:#fff; font-weight:600; text-decoration:none; font-family:Inter,sans-serif; transition:color .2s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                    Ritten
                </a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" style="color:#fff; font-weight:600; text-decoration:none; font-family:Inter,sans-serif; transition:color .2s;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                        Admin
                    </a>
                @endif
            @endauth

            {{-- Account Dropdown --}}
            <div style="position:relative;">
                <button id="account-button" style="display:flex; align-items:center; gap:.3rem; color:#fff; font-weight:600; background:none; border:none; cursor:pointer; font-family:Inter,sans-serif;" onmouseover="this.style.color='#f97316'" onmouseout="this.style.color='#fff'">
                    @auth
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Profielfoto"
                                 style="width:2rem; height:2rem; border-radius:50%; object-fit:cover; border:2px solid #fff;">
                        @else
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    @else
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endauth
                    <span>Account</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="account-dropdown" class="hidden" style="position:absolute; right:0; top:calc(100% + .5rem); width:12rem; background:#1a1a1d; border:1px solid rgba(255,255,255,.1); border-radius:.5rem; overflow:hidden; z-index:100;">
                    @guest
                        <a href="/login" style="display:block; padding:.6rem 1rem; color:#e8e8ea; text-decoration:none; font-size:.9rem; transition:background .2s;" onmouseover="this.style.background='#f97316'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#e8e8ea'">Inloggen</a>
                        <a href="/register" style="display:block; padding:.6rem 1rem; color:#e8e8ea; text-decoration:none; font-size:.9rem; transition:background .2s;" onmouseover="this.style.background='#f97316'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#e8e8ea'">Registreren</a>
                    @else
                        <a href="{{ route('profiel') }}" style="display:block; padding:.6rem 1rem; color:#e8e8ea; text-decoration:none; font-size:.9rem; transition:background .2s;" onmouseover="this.style.background='#f97316'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#e8e8ea'">Profiel</a>
                        <div style="border-top:1px solid rgba(255,255,255,.08);"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="display:block; width:100%; text-align:left; padding:.6rem 1rem; color:#e8e8ea; background:none; border:none; font-size:.9rem; cursor:pointer; transition:background .2s;" onmouseover="this.style.background='#f97316'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#e8e8ea'">Uitloggen</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>

        {{-- Mobile menu knop --}}
        <div class="nav-mobile-btn">
            <button id="mobile-menu-button" style="background:none; border:none; color:#fff; cursor:pointer;">
                <svg id="menu-open-icon" width="50" height="50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-close-icon" style="display:none;" width="50" height="50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" style="display:none; background:rgba(0,0,0,0.85); padding:.5rem 1rem 1rem;">
        <a href="{{ route('home') }}#top" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Pedallica</a>
        <a href="{{ route('home') }}#ploegen" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Ploegen</a>
        <a href="{{ route('home') }}#kalender" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Kalender</a>
        @auth
            <a href="{{ route('dashboard') }}" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Ritten</a>
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Admin</a>
            @endif
            <a href="{{ route('profiel') }}" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Profiel</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="display:block; width:100%; text-align:left; padding:.6rem 1rem; color:#fff; background:none; border:none; font-weight:600; cursor:pointer;">Uitloggen</button>
            </form>
        @else
            <a href="/login" style="display:block; padding:.6rem 1rem; color:#fff; text-decoration:none; border-radius:.4rem; font-weight:600;">Inloggen</a>
        @endauth
    </div>
</nav>
