<div class="rit-card {{ isset($passed) && $passed ? 'rit-card--passed' : '' }}">
    <div class="rit-card-content">
        <h3>{{ $rit->title }}</h3>

        @if($rit->description)
            <p class="description">{{ $rit->description }}</p>
        @endif

        <div class="rit-details">
            <div class="rit-detail">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $rit->date->format('d/m/Y') }}
            </div>

            @if($rit->start_time)
                <div class="rit-detail">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $rit->start_time }}
                </div>
            @endif

            @if($rit->location)
                <div class="rit-detail">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $rit->location }}
                </div>
            @endif

            @if($rit->distance)
                <div class="rit-detail">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    {{ $rit->distance }} km
                </div>
            @endif

            @if($rit->elevation_gain)
                <div class="rit-detail">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 15l5-5 4 4 8-8" />
                    </svg>
                    {{ $rit->elevation_gain }} m hoogtemeters
                </div>
            @endif
        </div>

        @if($rit->gpx_file || $rit->download_link)
            <div class="rit-actions">
                @if($rit->gpx_file)
                    <a href="{{ asset($rit->gpx_file) }}" download class="rit-btn primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        GPX Downloaden
                    </a>
                @endif
                @if($rit->download_link)
                    <a href="{{ $rit->download_link }}" target="_blank" rel="noopener noreferrer" class="rit-btn secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Route Bekijken
                    </a>
                @endif
            </div>
        @endif

        {{-- Aanwezigheid: alleen tonen voor toekomstige ritten --}}
        @if(!isset($passed) || !$passed)
            @php
                $aanwezigeUsers = $rit->users->filter(fn($u) => $u->pivot->status === 'aanwezig');
                $twijfelUsers   = $rit->users->filter(fn($u) => $u->pivot->status === 'twijfel');
                $aantalAanwezig = $aanwezigeUsers->count();
                $aantalTwijfel  = $twijfelUsers->count();
                $huidigStatus   = $userRitStatus ?? null;
                $popupId        = 'deelnemers-popup-' . $rit->id;
            @endphp

            <div class="aanwezigheid-sectie" id="aanwezigheid-{{ $rit->id }}" data-status="{{ $huidigStatus ?? '' }}">
                {{-- Tellers met oogje --}}
                <div class="aanwezigheid-tellers">
                    <span class="aanwezigheid-teller">
                        <span class="dot dot-aanwezig"></span>
                        <span id="count-aanwezig-{{ $rit->id }}">{{ $aantalAanwezig }}</span> aanwezig
                    </span>
                    <span class="aanwezigheid-teller">
                        <span class="dot dot-twijfel"></span>
                        <span id="count-twijfel-{{ $rit->id }}">{{ $aantalTwijfel }}</span> twijfel
                    </span>
                    <button class="deelnemers-oog-btn"
                            id="oog-{{ $rit->id }}"
                            onclick="document.getElementById('{{ $popupId }}').classList.add('open')"
                            title="Bekijk wie meerijd"
                            style="{{ ($aantalAanwezig > 0 || $aantalTwijfel > 0) ? '' : 'display:none' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>

                {{-- Aanwezigheidsbuttons - AJAX, geen form submit --}}
                <div class="aanwezigheid-knoppen">
                    <button class="aanwezigheid-btn {{ $huidigStatus === 'aanwezig' ? 'actief-aanwezig' : '' }}"
                            id="btn-aanwezig-{{ $rit->id }}"
                            onclick="toggleAanwezigheid({{ $rit->id }}, 'aanwezig')">
                        ✓ Aanwezig
                    </button>
                    <button class="aanwezigheid-btn {{ $huidigStatus === 'twijfel' ? 'actief-twijfel' : '' }}"
                            id="btn-twijfel-{{ $rit->id }}"
                            onclick="toggleAanwezigheid({{ $rit->id }}, 'twijfel')">
                        ? Twijfel
                    </button>
                    <button class="aanwezigheid-btn actief-afwezig"
                            id="btn-afwezig-{{ $rit->id }}"
                            onclick="toggleAanwezigheid({{ $rit->id }}, '')"
                            style="{{ $huidigStatus === null ? 'display:none' : '' }}">
                        ✕ Afwezig
                    </button>
                </div>
            </div>

            {{-- Deelnemers popup: via @push zodat hij buiten alle kaarten staat (position:fixed werkt dan correct) --}}
            @push('popups')
                <div class="deelnemers-popup-overlay" id="{{ $popupId }}" onclick="if(event.target===this)this.classList.remove('open')">
                    <div class="deelnemers-popup">
                        <div class="deelnemers-popup-header">
                            <h4>{{ $rit->title }}</h4>
                            <button class="deelnemers-popup-sluit" onclick="document.getElementById('{{ $popupId }}').classList.remove('open')">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        @if($aanwezigeUsers->count() > 0)
                            <div class="deelnemers-popup-groep">
                                <p class="deelnemers-popup-label groen">
                                    <span style="width:7px;height:7px;border-radius:50%;background:#22c55e;display:inline-block;"></span>
                                    Aanwezig ({{ $aanwezigeUsers->count() }})
                                </p>
                                @foreach($aanwezigeUsers as $deelnemer)
                                    <a href="{{ route('profiel.public', $deelnemer->username) }}" class="deelnemers-popup-persoon">
                                        @if($deelnemer->profile_picture)
                                            <img src="{{ asset($deelnemer->profile_picture) }}" alt="{{ $deelnemer->first_name }}" class="deelnemers-popup-avatar">
                                        @else
                                            <div class="deelnemers-popup-initialen">{{ strtoupper(substr($deelnemer->first_name,0,1).substr($deelnemer->last_name,0,1)) }}</div>
                                        @endif
                                        <span>{{ $deelnemer->first_name }} {{ $deelnemer->last_name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if($twijfelUsers->count() > 0)
                            <div class="deelnemers-popup-groep">
                                <p class="deelnemers-popup-label geel">
                                    <span style="width:7px;height:7px;border-radius:50%;background:#eab308;display:inline-block;"></span>
                                    Twijfel ({{ $twijfelUsers->count() }})
                                </p>
                                @foreach($twijfelUsers as $deelnemer)
                                    <a href="{{ route('profiel.public', $deelnemer->username) }}" class="deelnemers-popup-persoon">
                                        @if($deelnemer->profile_picture)
                                            <img src="{{ asset($deelnemer->profile_picture) }}" alt="{{ $deelnemer->first_name }}" class="deelnemers-popup-avatar">
                                        @else
                                            <div class="deelnemers-popup-initialen">{{ strtoupper(substr($deelnemer->first_name,0,1).substr($deelnemer->last_name,0,1)) }}</div>
                                        @endif
                                        <span>{{ $deelnemer->first_name }} {{ $deelnemer->last_name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if($aanwezigeUsers->count() === 0 && $twijfelUsers->count() === 0)
                            <div class="deelnemers-popup-groep">
                                <p style="color:#666;font-size:14px;margin:0;">Nog niemand ingeschreven.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endpush
        @endif
    </div>

    @if($ploeg->is_evening_rides)
        <div class="evening-indicator">Avondrit</div>
    @endif
</div>

@once
<script>
function toggleAanwezigheid(ritId, nieuweStatus) {
    const sectie = document.getElementById('aanwezigheid-' + ritId);
    const huidigStatus = sectie.dataset.status;

    // Als dezelfde status opnieuw geklikt wordt, toggle naar leeg (= afwezig)
    const statusToSend = (huidigStatus === nieuweStatus) ? '' : nieuweStatus;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/ritten/' + ritId + '/aanwezigheid', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ status: statusToSend })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        const newStatus = data.status ?? '';

        // Sla nieuwe status op
        sectie.dataset.status = newStatus;

        // Update tellers
        document.getElementById('count-aanwezig-' + ritId).textContent = data.aantalAanwezig;
        document.getElementById('count-twijfel-' + ritId).textContent  = data.aantalTwijfel;

        // Update knopstijlen
        var btnAanwezig = document.getElementById('btn-aanwezig-' + ritId);
        var btnTwijfel  = document.getElementById('btn-twijfel-'  + ritId);
        var btnAfwezig  = document.getElementById('btn-afwezig-'  + ritId);
        var oogBtn      = document.getElementById('oog-'          + ritId);

        btnAanwezig.classList.remove('actief-aanwezig');
        btnTwijfel.classList.remove('actief-twijfel');

        if (newStatus === 'aanwezig') {
            btnAanwezig.classList.add('actief-aanwezig');
        } else if (newStatus === 'twijfel') {
            btnTwijfel.classList.add('actief-twijfel');
        }

        // Afwezig-knop tonen/verbergen
        btnAfwezig.style.display = newStatus ? '' : 'none';

        // Oog-knop tonen/verbergen
        if (oogBtn) {
            oogBtn.style.display = (data.aantalAanwezig > 0 || data.aantalTwijfel > 0) ? '' : 'none';
        }
    });
}
</script>
@endonce
