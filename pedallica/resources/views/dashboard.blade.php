@extends('layouts.app')

@section('title', 'Ritten - Pedallica')

@section('content')
<style>
    .ritten-page {
        background: #0b0b0d;
        min-height: 100vh;
        font-family: Inter, system-ui, -apple-system, sans-serif;
    }
    .ritten-page .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px;
    }
    .ritten-header {
        margin-bottom: 40px;
    }
    .ritten-header h1 {
        font-family: "Bebas Neue", system-ui, sans-serif;
        font-size: 42px;
        color: white;
        margin: 0 0 8px;
    }
    .ritten-header .underline {
        width: 60px;
        height: 3px;
        background: #f97316;
        margin-bottom: 12px;
    }
    .ritten-header p {
        color: #b9b9c0;
        font-size: 14px;
    }

    /* Tabs */
    .ploeg-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .ploeg-tab {
        padding: 10px 20px;
        background: #16161a;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        color: #b9b9c0;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    .ploeg-tab:hover {
        background: #1f1f24;
        color: white;
    }
    .ploeg-tab.active {
        background: #f97316;
        color: #111;
        border-color: #f97316;
    }

    /* Search */
    .search-bar {
        position: relative;
        margin-bottom: 30px;
    }
    .search-bar input {
        width: 100%;
        max-width: 400px;
        padding: 12px 16px 12px 44px;
        background: #16161a;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        color: white;
        font-size: 14px;
    }
    .search-bar input::placeholder {
        color: #666;
    }
    .search-bar input:focus {
        outline: none;
        border-color: #f97316;
    }
    .search-bar svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #666;
    }

    /* Ploeg info */
    .ploeg-info {
        margin-bottom: 30px;
    }
    .ploeg-info h2 {
        font-family: "Bebas Neue", system-ui, sans-serif;
        font-size: 32px;
        color: white;
        margin: 0 0 8px;
    }
    .ploeg-info p {
        color: #b9b9c0;
        font-size: 14px;
        margin: 0;
    }

    /* Ritten grid */
    .ritten-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    /* Rit card */
    .rit-card {
        background: #16161a;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.2s;
    }
    .rit-card:hover {
        border-color: rgba(255,255,255,0.15);
        box-shadow: 0 8px 24px rgba(0,0,0,0.35);
    }
    .rit-card-content {
        padding: 20px;
    }
    .rit-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: white;
        margin: 0 0 8px;
    }
    .rit-card .description {
        font-size: 13px;
        color: #b9b9c0;
        margin-bottom: 16px;
    }
    .rit-details {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .rit-detail {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #b9b9c0;
    }
    .rit-detail svg {
        width: 16px;
        height: 16px;
        color: #f97316;
        flex-shrink: 0;
    }
    .rit-actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .rit-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .rit-btn.primary {
        background: #f97316;
        color: #111;
    }
    .rit-btn.primary:hover {
        background: #ea580c;
    }
    .rit-btn.secondary {
        background: rgba(255,255,255,0.1);
        color: white;
    }
    .rit-btn.secondary:hover {
        background: rgba(255,255,255,0.15);
    }
    .rit-btn svg {
        width: 14px;
        height: 14px;
    }

    /* Aanwezigheid */
    .aanwezigheid-sectie {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }
    .aanwezigheid-tellers {
        display: flex;
        gap: 12px;
        margin-bottom: 10px;
        font-size: 12px;
        color: #888;
    }
    .aanwezigheid-teller {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .aanwezigheid-teller .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }
    .dot-aanwezig { background: #22c55e; }
    .dot-twijfel  { background: #eab308; }
    .aanwezigheid-knoppen {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .aanwezigheid-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        background: rgba(255,255,255,0.07);
        color: #aaa;
    }
    .aanwezigheid-btn:hover {
        background: rgba(255,255,255,0.12);
        color: white;
    }
    .aanwezigheid-btn.actief-aanwezig {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.35);
    }
    .aanwezigheid-btn.actief-twijfel {
        background: rgba(234, 179, 8, 0.15);
        color: #eab308;
        border: 1px solid rgba(234, 179, 8, 0.35);
    }
    .aanwezigheid-btn.actief-afwezig {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Oogje naast tellers */
    .deelnemers-oog-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        display: inline-flex;
        align-items: center;
        color: #555;
        transition: color 0.15s;
        margin-left: 2px;
    }
    .deelnemers-oog-btn:hover { color: #f97316; }
    .deelnemers-oog-btn svg { width: 15px; height: 15px; }

    /* Deelnemers popup overlay */
    .deelnemers-popup-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .deelnemers-popup-overlay.open {
        display: flex;
    }
    .deelnemers-popup {
        background: #1c1c21;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        width: 100%;
        max-width: 380px;
        max-height: 80vh;
        overflow-y: auto;
        margin: 20px;
    }
    .deelnemers-popup-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px 14px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        position: sticky;
        top: 0;
        background: #1c1c21;
    }
    .deelnemers-popup-header h4 {
        font-size: 16px;
        font-weight: 700;
        color: white;
        margin: 0;
    }
    .deelnemers-popup-sluit {
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        padding: 0;
        display: flex;
        transition: color 0.15s;
    }
    .deelnemers-popup-sluit:hover { color: white; }
    .deelnemers-popup-sluit svg { width: 20px; height: 20px; }
    .deelnemers-popup-groep {
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .deelnemers-popup-groep:last-child { border-bottom: none; }
    .deelnemers-popup-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin: 0 0 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .deelnemers-popup-label.groen { color: #22c55e; }
    .deelnemers-popup-label.geel  { color: #eab308; }
    .deelnemers-popup-persoon {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
        text-decoration: none;
        color: #ccc;
        font-size: 14px;
        border-radius: 8px;
        transition: color 0.15s;
    }
    .deelnemers-popup-persoon:hover { color: white; }
    .deelnemers-popup-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }
    .deelnemers-popup-initialen {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #2a2a30;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: #888;
        flex-shrink: 0;
    }

    /* Evening ride indicator */
    .evening-indicator {
        background: linear-gradient(to right, #f97316, #ea580c);
        padding: 8px 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    /* Sectie headers */
    .ritten-section-header {
        margin-bottom: 16px;
    }
    .ritten-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }
    .ritten-badge.upcoming {
        background: rgba(249, 115, 22, 0.15);
        color: #f97316;
        border: 1px solid rgba(249, 115, 22, 0.3);
    }
    .ritten-badge.passed {
        background: rgba(255,255,255,0.05);
        color: #666;
        border: 1px solid rgba(255,255,255,0.08);
    }

    /* Gepasseerde kaarten */
    .rit-card--passed {
        opacity: 0.5;
    }
    .rit-card--passed:hover {
        opacity: 0.7;
        transform: none;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state svg {
        width: 64px;
        height: 64px;
        color: #444;
        margin-bottom: 16px;
    }
    .empty-state p {
        color: #666;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .ritten-page .container {
            padding: 20px;
        }
        .ritten-header h1 {
            font-size: 32px;
        }
        .ploeg-tabs {
            gap: 6px;
        }
        .ploeg-tab {
            padding: 8px 14px;
            font-size: 13px;
        }
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="ritten-page">
    <div class="container">
        <!-- Header -->
        <div class="ritten-header">
            <h1>Ritten</h1>
            <div class="underline"></div>
            <p>Welkom terug, {{ Auth::user()->first_name }}! Bekijk hier alle geplande ritten per ploeg.</p>
        </div>

        <!-- Ploeg Tabs -->
        <div class="ploeg-tabs">
            @foreach($ploegenVoorAvond as $ploeg)
                <a href="{{ route('dashboard', ['subtab' => $ploeg->slug]) }}"
                   class="ploeg-tab {{ $subTab === $ploeg->slug ? 'active' : '' }}">
                    {{ $ploeg->name }}
                </a>
            @endforeach

            @if($avondritten)
                <a href="{{ route('dashboard', ['subtab' => $avondritten->slug]) }}"
                   class="ploeg-tab {{ $subTab === $avondritten->slug ? 'active' : '' }}">
                    {{ $avondritten->name }}
                </a>
            @endif

            @foreach($ploegenNaAvond as $ploeg)
                <a href="{{ route('dashboard', ['subtab' => $ploeg->slug]) }}"
                   class="ploeg-tab {{ $subTab === $ploeg->slug ? 'active' : '' }}">
                    {{ $ploeg->name }}
                </a>
            @endforeach
        </div>

        @php
            $currentPloeg = $allePloegen->where('slug', $subTab)->first();
        @endphp

        @if($currentPloeg)
            <!-- Ploeg Info -->
            <div class="ploeg-info">
                <h2>{{ $currentPloeg->name }}</h2>
                @if($currentPloeg->description)
                    <p>{{ $currentPloeg->description }}</p>
                @endif
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" id="rittenZoekbalk" placeholder="Zoek ritten...">
            </div>

            @php
                $toekomstig = $currentPloeg->ritten->filter(fn($r) => $r->date->gte($vandaag));
                $gepasseerd = $currentPloeg->ritten->filter(fn($r) => $r->date->lt($vandaag))->sortByDesc('date');
            @endphp

            @if($currentPloeg->ritten->count() === 0)
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p>Nog geen ritten gepland voor {{ $currentPloeg->name }}</p>
                </div>
            @else

                {{-- TOEKOMSTIGE RITTEN --}}
                @if($toekomstig->count() > 0)
                    <div class="ritten-section-header">
                        <span class="ritten-badge upcoming">Komende ritten</span>
                    </div>
                    <div id="rittenContainer" class="ritten-grid" style="margin-bottom: 40px;">
                        @foreach($toekomstig as $rit)
                            @include('partials.rit-card', ['rit' => $rit, 'ploeg' => $currentPloeg, 'userRitStatus' => $userRitStatuses[$rit->id] ?? null])
                        @endforeach
                    </div>
                @endif

                {{-- GEPASSEERDE RITTEN --}}
                @if($gepasseerd->count() > 0)
                    <div class="ritten-section-header">
                        <span class="ritten-badge passed">Gepasseerde ritten</span>
                    </div>
                    <div class="ritten-grid ritten-passed">
                        @foreach($gepasseerd as $rit)
                            @include('partials.rit-card', ['rit' => $rit, 'ploeg' => $currentPloeg, 'passed' => true])
                        @endforeach
                    </div>
                @endif

            @endif
        @endif
    </div>
</div>

<script>
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
</script>
@endsection
