@extends('layouts.app')

@section('title', $user->username . ' - Pedallica')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
    :root {
        --bg: #0b0b0d;
        --bg2: #111114;
        --card: #16161a;
        --text: #e8e8ea;
        --muted: #b9b9c0;
        --accent: #f97316;
        --ring: rgba(255,255,255,.08);
    }
    body { background: var(--bg) !important; color: var(--text); font-family: Inter, system-ui, sans-serif; }
    .font-head { font-family: "Bebas Neue", system-ui, sans-serif; letter-spacing: .5px; }

    .page-wrap {
        min-height: 100vh;
        background: var(--bg);
        padding: 2.5rem 1rem;
    }
    .inner { max-width: 860px; margin: 0 auto; }

    /* Hero banner bovenaan profiel */
    .profile-hero {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .profile-hero-banner {
        height: 7rem;
        background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
        position: relative;
    }
    .profile-hero-body {
        padding: 0 1.75rem 1.75rem;
    }
    .profile-avatar {
        width: 7rem;
        height: 7rem;
        border-radius: 50%;
        border: 4px solid var(--card);
        overflow: hidden;
        background: var(--bg2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: -3.5rem;
        flex-shrink: 0;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }

    .card {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .card-title {
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.15rem;
        letter-spacing: .06em;
        color: var(--text);
        margin: 0 0 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .card-title svg { color: var(--accent); flex-shrink: 0; }

    .info-row {
        display: flex;
        align-items: center;
        gap: .75rem;
        color: var(--muted);
        font-size: .9rem;
        margin-bottom: .65rem;
    }
    .info-row svg { flex-shrink: 0; color: var(--accent); }
    .info-row:last-child { margin-bottom: 0; }

    .badge-card {
        background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        color: #fff;
    }
    .badge-card-title {
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.15rem;
        letter-spacing: .06em;
        margin: 0 0 .75rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .admin-badge {
        background: rgba(255,255,255,.2);
        border-radius: .5rem;
        padding: .5rem .75rem;
        margin-top: .75rem;
        font-size: .85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    @media (max-width: 600px) { .grid-2 { grid-template-columns: 1fr; } }

    .back-link {
        color: var(--accent);
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        transition: color .2s;
    }
    .back-link:hover { color: #ea6b0b; }
</style>

<div class="page-wrap">
    <div class="inner">

        {{-- Profiel hero --}}
        <div class="profile-hero">
            <div class="profile-hero-banner"></div>
            <div class="profile-hero-body">
                <div style="display:flex; align-items:flex-end; gap:1.25rem; flex-wrap:wrap;">
                    <div class="profile-avatar">
                        @if($user->profile_picture)
                            <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->username }}">
                        @else
                            <svg width="40" height="40" fill="none" stroke="#b9b9c0" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>

                    <div style="padding-bottom:.25rem;">
                        <h1 class="font-head" style="font-size:2rem; color:var(--text); margin:0 0 .2rem;">{{ $user->username }}</h1>
                        <p style="color:var(--muted); font-size:.95rem; margin:0;">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <p style="color:var(--muted); font-size:.82rem; margin:.35rem 0 0; display:flex; align-items:center; gap:.35rem;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Lid sinds {{ $user->created_at->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Over mij --}}
        @if($user->about_me)
            <div class="card">
                <h2 class="card-title">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Over Mij
                </h2>
                <p style="color:var(--muted); line-height:1.7; white-space:pre-line; margin:0;">{{ $user->about_me }}</p>
            </div>
        @endif

        {{-- Info + badge --}}
        <div class="grid-2">
            <div class="card" style="margin-bottom:0;">
                <h3 class="card-title">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informatie
                </h3>

                @if($user->birth_date)
                    <div class="info-row">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Verjaardag: {{ $user->birth_date->format('d F') }}
                    </div>
                @endif

                @if($user->city && $user->country)
                    <div class="info-row">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $user->city }}, {{ $user->country }}
                    </div>
                @endif

                <div class="info-row">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Lid sinds {{ $user->created_at->format('d F Y') }}
                </div>
            </div>

            <div class="badge-card">
                <p class="badge-card-title">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Pedallica Lid
                </p>
                <p style="opacity:.9; font-size:.9rem; margin:0;">
                    {{ $user->username }} is een actief lid van de Pedallica fietsclub en maakt deel uit van onze community.
                </p>
                @if($user->is_admin)
                    <div class="admin-badge">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Club Administrator
                    </div>
                @endif
            </div>
        </div>

        {{-- Terug --}}
        <div style="margin-top:2rem; text-align:center;">
            <a href="{{ route('home') }}" class="back-link">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Terug naar home
            </a>
        </div>

    </div>
</div>
@endsection
