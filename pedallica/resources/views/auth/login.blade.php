@extends('layouts.app')

@section('title', 'Inloggen - Pedallica')

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
        align-items: center;
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
        max-width: 440px;
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
    }
    .auth-input:focus {
        border-color: var(--accent);
    }
    .auth-input.error { border-color: #ef4444; }
    .auth-input::placeholder { color: var(--muted); }
    .auth-btn {
        width: 100%;
        background: var(--accent);
        color: #fff;
        font-family: "Bebas Neue", sans-serif;
        font-size: 1.15rem;
        letter-spacing: .08em;
        padding: .75rem 1rem;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .2s, transform .1s;
    }
    .auth-btn:hover { background: #ea6b0b; }
    .auth-btn:active { transform: scale(.98); }
    .alert-error {
        background: rgba(239,68,68,.12);
        border: 1px solid rgba(239,68,68,.3);
        color: #fca5a5;
        padding: .75rem 1rem;
        border-radius: .5rem;
        font-size: .9rem;
        margin-bottom: 1.25rem;
    }
    .alert-success {
        background: rgba(34,197,94,.12);
        border: 1px solid rgba(34,197,94,.3);
        color: #86efac;
        padding: .75rem 1rem;
        border-radius: .5rem;
        font-size: .9rem;
        margin-bottom: 1.25rem;
    }
    .field-error { color: #f87171; font-size: .8rem; margin-top: .3rem; }
    .divider { border-color: var(--ring); }
    .link-muted { color: var(--muted); font-size: .9rem; text-decoration: none; transition: color .2s; }
    .link-muted:hover { color: var(--text); }
    .link-accent { color: var(--accent); font-weight: 600; text-decoration: none; }
    .link-accent:hover { color: #ea6b0b; }
    .checkbox-custom {
        accent-color: var(--accent);
        width: 1rem;
        height: 1rem;
        cursor: pointer;
    }
</style>

<div class="auth-wrap">
    <div class="auth-card">
        {{-- Logo / Titel --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <p class="font-head" style="font-size:2.5rem; color:var(--accent); margin:0 0 .25rem;">Pedallica</p>
            <h1 class="font-head" style="font-size:1.6rem; color:var(--text); margin:0 0 .4rem;">Welkom terug</h1>
            <p style="color:var(--muted); font-size:.9rem; margin:0;">Log in op je Pedallica account</p>
        </div>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- E-mail --}}
            <div style="margin-bottom:1.25rem;">
                <label for="email" class="auth-label">E-mailadres <span style="color:var(--accent)">*</span></label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="auth-input @error('email') error @enderror"
                    placeholder="jouw@email.be"
                >
                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Wachtwoord --}}
            <div style="margin-bottom:1.25rem;">
                <label for="password" class="auth-label">Wachtwoord <span style="color:var(--accent)">*</span></label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="auth-input @error('password') error @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Onthoud mij --}}
            <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:1.5rem;">
                <input type="checkbox" name="remember" id="remember" class="checkbox-custom">
                <label for="remember" style="color:var(--muted); font-size:.9rem; cursor:pointer;">Onthoud mij</label>
            </div>

            {{-- Inloggen knop --}}
            <button type="submit" class="auth-btn">Inloggen</button>

            {{-- Terug / Register --}}
            <div style="text-align:center; margin-top:1.25rem;">
                <a href="{{ route('home') }}" class="link-muted">Terug naar home</a>
            </div>

            <hr class="divider" style="margin:1.5rem 0;">

            <p style="text-align:center; color:var(--muted); font-size:.9rem; margin:0;">
                Nog geen account?
                <a href="{{ route('register') }}" class="link-accent">Registreer hier</a>
            </p>
        </form>
    </div>
</div>
@endsection
