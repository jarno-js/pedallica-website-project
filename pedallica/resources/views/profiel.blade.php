@extends('layouts.app')

@section('title', 'Mijn Profiel - Pedallica')

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
    .inner { max-width: 900px; margin: 0 auto; }

    .card {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card-header {
        background: var(--accent);
        padding: .85rem 1.5rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .card-header h2 {
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.2rem;
        letter-spacing: .06em;
        color: #fff;
        margin: 0;
    }
    .card-body { padding: 1.75rem; }

    .auth-label {
        display: block;
        font-size: .78rem;
        font-weight: 600;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: .4rem;
    }
    .auth-input, .auth-textarea {
        width: 100%;
        background: var(--bg2);
        border: 1px solid var(--ring);
        color: var(--text);
        padding: .65rem 1rem;
        border-radius: .5rem;
        font-size: .95rem;
        font-family: Inter, sans-serif;
        transition: border-color .2s;
        outline: none;
        box-sizing: border-box;
    }
    .auth-input:focus, .auth-textarea:focus { border-color: var(--accent); }
    .auth-input.error, .auth-textarea.error { border-color: #ef4444; }
    .auth-input::placeholder, .auth-textarea::placeholder { color: var(--muted); }
    .auth-textarea { resize: vertical; }
    .field-error { color: #f87171; font-size: .8rem; margin-top: .3rem; }
    .field-hint { color: var(--muted); font-size: .78rem; margin-top: .3rem; }

    .btn-primary {
        background: var(--accent);
        color: #fff;
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.05rem;
        letter-spacing: .08em;
        padding: .65rem 1.75rem;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .2s, transform .1s;
    }
    .btn-primary:hover { background: #ea6b0b; }
    .btn-primary:active { transform: scale(.98); }

    .btn-danger {
        background: rgba(239,68,68,.15);
        color: #f87171;
        border: 1px solid rgba(239,68,68,.3);
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.05rem;
        letter-spacing: .08em;
        padding: .65rem 1.75rem;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-danger:hover { background: rgba(239,68,68,.25); }

    .alert-success {
        background: rgba(34,197,94,.1);
        border: 1px solid rgba(34,197,94,.25);
        color: #86efac;
        padding: .75rem 1rem;
        border-radius: .5rem;
        font-size: .9rem;
        margin-bottom: 1.5rem;
    }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    @media (max-width: 600px) { .grid-2 { grid-template-columns: 1fr; } }

    .section-sep {
        border: none;
        border-top: 1px solid var(--ring);
        margin: 1.5rem 0 1.25rem;
    }
    .section-label {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    /* Profielfoto */
    .avatar-wrap {
        width: 6rem;
        height: 6rem;
        border-radius: 50%;
        border: 3px solid var(--accent);
        overflow: hidden;
        flex-shrink: 0;
        background: var(--bg2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-wrap img { width: 100%; height: 100%; object-fit: cover; }

    .file-input-label {
        display: inline-block;
        background: var(--bg2);
        border: 1px solid var(--ring);
        color: var(--muted);
        padding: .5rem 1rem;
        border-radius: .5rem;
        font-size: .85rem;
        cursor: pointer;
        transition: border-color .2s, color .2s;
    }
    .file-input-label:hover { border-color: var(--accent); color: var(--text); }
    input[type="file"] { display: none; }
</style>

<div class="page-wrap">
    <div class="inner">

        {{-- Paginatitel --}}
        <div style="margin-bottom:1.75rem;">
            <h1 class="font-head" style="font-size:2rem; color:var(--text); margin:0 0 .25rem;">Mijn Profiel</h1>
            <p style="color:var(--muted); font-size:.9rem; margin:0;">Bekijk en wijzig je persoonlijke gegevens</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Profielfoto --}}
        <div class="card">
            <div class="card-header">
                <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2>Profielfoto</h2>
            </div>
            <div class="card-body">
                <div style="display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap;">
                    <div class="avatar-wrap">
                        @if($user->profile_picture)
                            <img src="{{ asset($user->profile_picture) }}" alt="Profielfoto">
                        @else
                            <svg width="36" height="36" fill="none" stroke="#b9b9c0" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('profiel.picture') }}" enctype="multipart/form-data" style="flex:1; min-width:220px;">
                        @csrf
                        @method('PUT')
                        <div style="margin-bottom:1rem;">
                            <label for="profile_picture" class="file-input-label">Nieuwe foto kiezen</label>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
                            @error('profile_picture')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                            <p class="field-hint">JPG, PNG of GIF — max. 2MB</p>
                        </div>
                        <div style="display:flex; gap:.75rem; flex-wrap:wrap;">
                            <button type="submit" class="btn-primary">Foto Uploaden</button>
                            @if($user->profile_picture)
                                <button type="button" class="btn-danger"
                                    onclick="document.getElementById('delete-picture-form').submit();">
                                    Foto Verwijderen
                                </button>
                            @endif
                        </div>
                    </form>

                    @if($user->profile_picture)
                        <form id="delete-picture-form" method="POST" action="{{ route('profiel.picture.delete') }}" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Persoonlijke gegevens --}}
        <div class="card">
            <div class="card-header">
                <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h2>Persoonlijke Gegevens</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profiel.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid-2" style="margin-bottom:1.25rem;">
                        <div>
                            <label for="first_name" class="auth-label">Voornaam <span style="color:var(--accent)">*</span></label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required class="auth-input @error('first_name') error @enderror">
                            @error('first_name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="last_name" class="auth-label">Achternaam <span style="color:var(--accent)">*</span></label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required class="auth-input @error('last_name') error @enderror">
                            @error('last_name') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid-2" style="margin-bottom:1.25rem;">
                        <div>
                            <label for="username" class="auth-label">Gebruikersnaam <span style="color:var(--accent)">*</span></label>
                            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required class="auth-input @error('username') error @enderror">
                            @error('username') <p class="field-error">{{ $message }}</p> @enderror
                            <p class="field-hint">Zichtbaar op je profiel</p>
                        </div>
                        <div>
                            <label for="email" class="auth-label">E-mailadres <span style="color:var(--accent)">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="auth-input @error('email') error @enderror">
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid-2" style="margin-bottom:1.25rem;">
                        <div>
                            <label for="phone" class="auth-label">Telefoonnummer</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="auth-input @error('phone') error @enderror">
                            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="birth_date" class="auth-label">Geboortedatum</label>
                            <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('d/m/Y') : '') }}" placeholder="dd/mm/jjjj" class="auth-input @error('birth_date') error @enderror">
                            @error('birth_date') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="margin-bottom:1.25rem;">
                        <label for="about_me" class="auth-label">Over mij</label>
                        <textarea id="about_me" name="about_me" rows="4" maxlength="500" placeholder="Vertel iets over jezelf..." class="auth-textarea @error('about_me') error @enderror">{{ old('about_me', $user->about_me) }}</textarea>
                        @error('about_me') <p class="field-error">{{ $message }}</p> @enderror
                        <p class="field-hint">Maximaal 500 karakters</p>
                    </div>

                    <hr class="section-sep">
                    <p class="section-label">Adresgegevens</p>

                    <div class="grid-2" style="margin-bottom:1.25rem;">
                        <div>
                            <label for="street" class="auth-label">Straat</label>
                            <input type="text" id="street" name="street" value="{{ old('street', $user->street) }}" class="auth-input @error('street') error @enderror">
                            @error('street') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="house_number" class="auth-label">Huisnummer</label>
                            <input type="text" id="house_number" name="house_number" value="{{ old('house_number', $user->house_number) }}" class="auth-input @error('house_number') error @enderror">
                            @error('house_number') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid-2" style="margin-bottom:1.5rem;">
                        <div>
                            <label for="postal_code" class="auth-label">Postcode</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" class="auth-input @error('postal_code') error @enderror">
                            @error('postal_code') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="city" class="auth-label">Stad</label>
                            <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" class="auth-input @error('city') error @enderror">
                            @error('city') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end;">
                        <button type="submit" class="btn-primary">Gegevens Opslaan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Wachtwoord wijzigen --}}
        <div class="card">
            <div class="card-header">
                <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <h2>Wachtwoord Wijzigen</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profiel.password') }}" style="max-width:440px;">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom:1.25rem;">
                        <label for="current_password" class="auth-label">Huidig wachtwoord <span style="color:var(--accent)">*</span></label>
                        <input type="password" id="current_password" name="current_password" required class="auth-input @error('current_password') error @enderror" placeholder="••••••••">
                        @error('current_password') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom:1.25rem;">
                        <label for="password" class="auth-label">Nieuw wachtwoord <span style="color:var(--accent)">*</span></label>
                        <input type="password" id="password" name="password" required class="auth-input @error('password') error @enderror" placeholder="••••••••">
                        @error('password') <p class="field-error">{{ $message }}</p> @enderror
                        <p class="field-hint">Minimaal 8 karakters</p>
                    </div>

                    <div style="margin-bottom:1.5rem;">
                        <label for="password_confirmation" class="auth-label">Bevestig nieuw wachtwoord <span style="color:var(--accent)">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="auth-input" placeholder="••••••••">
                    </div>

                    <div style="display:flex; justify-content:flex-end;">
                        <button type="submit" class="btn-primary">Wachtwoord Wijzigen</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    const birthDateInput = document.getElementById('birth_date');
    if (birthDateInput) {
        birthDateInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) value = value.slice(0, 2) + '/' + value.slice(2);
            if (value.length >= 5) value = value.slice(0, 5) + '/' + value.slice(5, 9);
            e.target.value = value;
        });
    }
</script>
@endsection
