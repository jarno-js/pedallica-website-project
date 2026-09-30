@extends('layouts.app')

@section('title', 'Registreren - Pedallica')

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

    .auth-wrap {
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 3rem 1rem;
        background: var(--bg);
    }
    .auth-card {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: 1rem;
        padding: 2.5rem;
        width: 100%;
        max-width: 680px;
    }
    .auth-label {
        display: block;
        font-size: .8rem;
        font-weight: 600;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: .4rem;
    }
    .auth-input {
        width: 100%;
        background: var(--bg2);
        border: 1px solid var(--ring);
        color: var(--text);
        padding: .65rem 1rem;
        border-radius: .5rem;
        font-size: .95rem;
        transition: border-color .2s;
        outline: none;
        box-sizing: border-box;
    }
    .auth-input:focus { border-color: var(--accent); }
    .auth-input.error { border-color: #ef4444; }
    .auth-input::placeholder { color: var(--muted); }
    .auth-select {
        width: 100%;
        background: var(--bg2);
        border: 1px solid var(--ring);
        color: var(--text);
        padding: .65rem 1rem;
        border-radius: .5rem;
        font-size: .95rem;
        outline: none;
        appearance: none;
        cursor: pointer;
        transition: border-color .2s;
        box-sizing: border-box;
    }
    .auth-select:focus { border-color: var(--accent); }
    .auth-select option { background: var(--bg2); }
    .auth-btn {
        background: var(--accent);
        color: #fff;
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.15rem;
        letter-spacing: .08em;
        padding: .75rem 2rem;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .2s, transform .1s;
    }
    .auth-btn:hover { background: #ea6b0b; }
    .auth-btn:active { transform: scale(.98); }
    .field-error { color: #f87171; font-size: .8rem; margin-top: .3rem; }
    .field-hint { color: var(--muted); font-size: .78rem; margin-top: .3rem; }
    .divider { border-color: var(--ring); }
    .link-muted { color: var(--muted); font-size: .9rem; text-decoration: none; transition: color .2s; }
    .link-muted:hover { color: var(--text); }
    .link-accent { color: var(--accent); font-weight: 600; text-decoration: none; }
    .link-accent:hover { color: #ea6b0b; }

    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .grid-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; }
    .grid-3r { display: grid; grid-template-columns: 1fr 2fr; gap: 1.25rem; }
    @media (max-width: 600px) {
        .grid-2, .grid-3, .grid-3r { grid-template-columns: 1fr; }
    }

    .photo-preview {
        width: 5rem;
        height: 5rem;
        border-radius: 50%;
        background: var(--bg2);
        border: 2px solid var(--ring);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }
    .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
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

    .section-title {
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--accent);
        margin: 1.75rem 0 1rem;
        padding-bottom: .5rem;
        border-bottom: 1px solid var(--ring);
    }
</style>

<div class="auth-wrap">
    <div class="auth-card">
        {{-- Titel --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <p class="font-head" style="font-size:2.5rem; color:var(--accent); margin:0 0 .25rem;">Pedallica</p>
            <h1 class="font-head" style="font-size:1.6rem; color:var(--text); margin:0 0 .4rem;">Account aanmaken</h1>
            <p style="color:var(--muted); font-size:.9rem; margin:0;">Word lid van de Pedallica community</p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            {{-- Profielfoto --}}
            <p class="section-title">Profielfoto</p>
            <div style="display:flex; align-items:center; gap:1rem;">
                <div class="photo-preview" id="photoWrap">
                    <img id="preview" class="hidden" alt="Preview" style="display:none;">
                    <svg id="photoIcon" width="28" height="28" fill="none" stroke="#b9b9c0" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <label for="profile_picture" class="file-input-label">Foto kiezen (optioneel)</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    @error('profile_picture')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Naam --}}
            <p class="section-title">Persoonlijke gegevens</p>
            <div class="grid-2" style="margin-bottom:1.25rem;">
                <div>
                    <label for="first_name" class="auth-label">Voornaam <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="auth-input @error('first_name') error @enderror" placeholder="Jan">
                    @error('first_name') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="last_name" class="auth-label">Achternaam <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="auth-input @error('last_name') error @enderror" placeholder="Janssen">
                    @error('last_name') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="birth_date" class="auth-label">Geboortedatum <span style="color:var(--accent)">*</span></label>
                <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required placeholder="dd/mm/jjjj" class="auth-input @error('birth_date') error @enderror">
                @error('birth_date') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="phone" class="auth-label">GSM-nummer <span style="color:var(--accent)">*</span></label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="+32 123 45 67 89" class="auth-input @error('phone') error @enderror">
                @error('phone') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            {{-- Account --}}
            <p class="section-title">Account gegevens</p>
            <div class="grid-2" style="margin-bottom:1.25rem;">
                <div>
                    <label for="email" class="auth-label">E-mailadres <span style="color:var(--accent)">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="auth-input @error('email') error @enderror" placeholder="jouw@email.be">
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="username" class="auth-label">Gebruikersnaam <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required class="auth-input @error('username') error @enderror" placeholder="jouwusername">
                    @error('username') <p class="field-error">{{ $message }}</p> @enderror
                    <p class="field-hint">Zichtbaar op je profiel</p>
                </div>
            </div>

            <div class="grid-2" style="margin-bottom:1.25rem;">
                <div>
                    <label for="password" class="auth-label">Wachtwoord <span style="color:var(--accent)">*</span></label>
                    <input type="password" name="password" id="password" required class="auth-input @error('password') error @enderror" placeholder="••••••••">
                    @error('password') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="auth-label">Herhaal wachtwoord <span style="color:var(--accent)">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="auth-input" placeholder="••••••••">
                </div>
            </div>

            {{-- Adres --}}
            <p class="section-title">Adres</p>
            <div class="grid-3" style="margin-bottom:1.25rem;">
                <div>
                    <label for="street" class="auth-label">Straat <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="street" id="street" value="{{ old('street') }}" required class="auth-input @error('street') error @enderror" placeholder="Kerkstraat">
                    @error('street') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="house_number" class="auth-label">Huisnr. <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="house_number" id="house_number" value="{{ old('house_number') }}" required class="auth-input @error('house_number') error @enderror" placeholder="12A">
                    @error('house_number') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid-3r" style="margin-bottom:1.25rem;">
                <div>
                    <label for="postal_code" class="auth-label">Postcode <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required class="auth-input @error('postal_code') error @enderror" placeholder="1000">
                    @error('postal_code') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="city" class="auth-label">Stad <span style="color:var(--accent)">*</span></label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" required class="auth-input @error('city') error @enderror" placeholder="Brussel">
                    @error('city') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label for="country" class="auth-label">Land <span style="color:var(--accent)">*</span></label>
                <select name="country" id="country" required class="auth-select @error('country') error @enderror">
                    <option value="">Selecteer een land</option>
                    <option value="België"     {{ old('country') == 'België'     ? 'selected' : '' }}>België</option>
                    <option value="Nederland"  {{ old('country') == 'Nederland'  ? 'selected' : '' }}>Nederland</option>
                    <option value="Frankrijk"  {{ old('country') == 'Frankrijk'  ? 'selected' : '' }}>Frankrijk</option>
                    <option value="Duitsland"  {{ old('country') == 'Duitsland'  ? 'selected' : '' }}>Duitsland</option>
                    <option value="Luxemburg"  {{ old('country') == 'Luxemburg'  ? 'selected' : '' }}>Luxemburg</option>
                    <option value="Anders"     {{ old('country') == 'Anders'     ? 'selected' : '' }}>Anders</option>
                </select>
                @error('country') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            {{-- Submit --}}
            <hr class="divider" style="margin:1.75rem 0 1.25rem;">
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <a href="{{ route('home') }}" class="link-muted">Terug naar home</a>
                <button type="submit" class="auth-btn">Account aanmaken</button>
            </div>

            <p style="text-align:center; color:var(--muted); font-size:.9rem; margin-top:1.25rem 0 0;">
                Al een account?
                <a href="{{ route('login') }}" class="link-accent">Log hier in</a>
            </p>
        </form>
    </div>
</div>

<script>
    // Profielfoto preview
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
                document.getElementById('photoIcon').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    // Datum formatter (dd/mm/yyyy)
    const birthDateInput = document.getElementById('birth_date');
    birthDateInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) value = value.slice(0, 2) + '/' + value.slice(2);
        if (value.length >= 5) value = value.slice(0, 5) + '/' + value.slice(5, 9);
        e.target.value = value;
    });

    // Validatie datum bij submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const dateValue = birthDateInput.value;
        const match = dateValue.match(/^(\d{2})\/(\d{2})\/(\d{4})$/);
        if (!match) {
            e.preventDefault();
            alert('Voer een geldige datum in (dd/mm/jjjj)');
            return false;
        }
        const day = parseInt(match[1]), month = parseInt(match[2]), year = parseInt(match[3]);
        if (day < 1 || day > 31 || month < 1 || month > 12 || year < 1900 || year > new Date().getFullYear()) {
            e.preventDefault();
            alert('Voer een geldige datum in');
            return false;
        }
    });
</script>
@endsection
