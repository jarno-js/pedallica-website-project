@extends('layouts.app')

@section('title', 'Home - Pedallica')

@section('content')

{{-- Hoofd HTML structuur voor de homepage --}}
    <!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedallica</title>

    {{-- Lettertypen van Google (Bebas Neue en Inter) --}}
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        /* Kleuren die op de hele website gebruikt worden */
        :root{
            --bg: #0b0b0d;        /* Donkere achtergrond */
            --bg2:#111114;        /* Iets lichtere achtergrond */
            --card:#16161a;       /* Kleur voor kaarten */
            --text:#e8e8ea;       /* Lichte tekstkleur */
            --muted:#b9b9c0;      /* Grijze tekst voor minder belangrijke info */
            --accent:#f97316;     /* Oranje accent kleur */
            --ring: rgba(255,255,255,.08); /* Dunne witte randjes */
        }

        /* Basis instellingen voor alle elementen */
        *{box-sizing:border-box}
        html,body{margin:0;padding:0;background:var(--bg);color:var(--text);font-family:Inter,system-ui,-apple-system,sans-serif}
        img{max-width:100%;height:auto;display:block}
        a{color:inherit}
        .container{max-width:1180px;margin:0 auto;padding:0 20px}

        /* Oranje kleur voor het woord "Pedallica" */
        .pedallica {
            color: var(--accent);
        }

        /* Stijl voor koppen met het Bebas lettertype */
        .font-head{font-family:"Bebas Neue",system-ui,sans-serif;letter-spacing:.5px}

        /* HERO SECTIE (bovenaan de pagina met logo) */
        .hero{
            background: radial-gradient(1000px 400px at 50% -10%, #1a1a1f, #0b0b0d 70%);
            padding:56px 0 48px;
            text-align:center;
        }
        .hero .logo{width:180px;filter: drop-shadow(0 10px 30px rgba(0,0,0,.5)); margin:0 auto 14px}
        .hero h1{font-size:56px;line-height:1; margin:8px 0 6px}
        .hero .slogan{font-size:24px;color:white(--accent)}
        .hero p.lead{color:var(--muted);max-width:820px;margin:14px auto 0}

        /* Algemene stijl voor secties op de pagina */
        section{padding:56px 0}
        .section-title{font-size:34px;margin:0 0 14px}
        .card{background:var(--card);border:1px solid var(--ring);border-radius:16px;padding:20px}

        /* Foto galerij in kolommen (masonry layout) */
        .masonry{column-count:1;column-gap:16px}
        .masonry .item{break-inside:avoid;margin:0 0 16px;border-radius:14px;overflow:hidden;border:1px solid var(--ring)}
        /* Op tablets: 2 kolommen */
        @media(min-width:640px){.masonry{column-count:2}}
        /* Op desktop: 3 kolommen */
        @media(min-width:1024px){.masonry{column-count:3}}

        /* Grid layout voor "Wie we zijn" sectie */
        .grid{display:grid;gap:28px}
        /* Op grote schermen: foto's links (2/3) en tekst rechts (1/3) */
        @media(min-width:992px){.grid{grid-template-columns:2fr 1fr}}

        /* Google Maps iframe styling */
        .map{position:relative;padding-top:56.25%;border-radius:18px;overflow:hidden;border:1px solid var(--ring)}
        .map iframe{position:absolute;inset:0;width:100%;height:100%;border:0}

        /* Oranje knoppen */
        .btn{
            display:inline-flex;align-items:center;gap:10px;
            background:var(--accent);color:#111;padding:12px 18px;border-radius:12px;
            font-weight:700;text-decoration:none;border:0;cursor:pointer
        }
        .btn:hover{filter:brightness(1.05)}

        /* Lijsten zonder bullets */
        ul.clean{list-style:none;padding:0;margin:0}
        ul.clean li{margin:8px 0;color:var(--muted)}

        /* Footer onderaan de pagina */
        footer{border-top:1px solid var(--ring);color:#9da3ae;text-align:center;padding:22px}
    </style>
</head>
<body>
{{-- HERO SECTIE met logo en slogan --}}
<header class="hero">
    <div class="container">
        <img class="logo" src="{{ asset('Pedallica_LOGO.png') }}" alt="Pedallica logo">
        <div class="slogan font-head"> <span class="pedallica">niet zomaar een club.</span></div>
    </div>
</header>

{{-- SECTIE met foto galerij en "Wie we zijn" tekst --}}
<section>
    <div class="container grid">
        <div>
            {{-- Loop door alle foto's en toon ze in de galerij --}}
            <div class="masonry">
                @foreach ([
                    asset('fotos-homepagina/pedallica7.jpg'),
                    asset('fotos-homepagina/pedallica2.jpg'),
                    asset('fotos-homepagina/pedallica3.jpg'),
                    asset('fotos-homepagina/pedallica4.jpg'),
                    asset('fotos-homepagina/pedallica5.jpg'),
                    asset('fotos-homepagina/pedallica6.jpg'),
                    asset('fotos-homepagina/pedallica1.jpg'),
                ] as $src)
                    <figure class="item">
                        <img src="{{ $src }}" alt="Pedallica ride">
                    </figure>
                @endforeach
            </div>
        </div>

        {{-- Info kaart met tekst over de club --}}
        <article class="card">
            <h2 class="section-title font-head">Wie we zijn</h2>
            <p style="color:var(--muted)">
                Pedallica is een fietsclub voor iedereen met een liefde voor gravel, weg en modder.
                Ritjes door weer en wind, eentje in de rusdtberg na afloop,
                en een club die elkaar vooruit duwt.
            </p>

            <h3 class="font-head" style="font-size:24px;margin-top:18px">Wat je kan verwachten</h3>
            <ul class="clean">
                <li>• Wekelijkse ritten in verschillende niveaus</li>
                <li>• Toffe events en trips</li>
                <li>• Techniek-workshops & onderhoud</li>
                <li>• Nieuwe vrienden en veel plezier</li>
            </ul>
        </article>
    </div>
</section>

{{-- LOCATIE SECTIE met Google Maps --}}
<section style="background:var(--bg2);border-top:1px solid var(--ring);border-bottom:1px solid var(--ring)">
    <div class="container">
        <h2 class="section-title font-head">Onze vestiging</h2>
        <p style="color:var(--muted);margin-top:-6px">Café In de Rustberg – vertrek en après-ride.</p>
        {{-- Ingesloten Google Maps kaart --}}
        <div class="map" style="margin-top:16px">
            <iframe
                src="https://www.google.com/maps?q=Caf%C3%A9%20In%20de%20Rustberg&output=embed"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

{{-- CONTACT SECTIE met witte achtergrond en email knop --}}
<section style="background:white; color:#111; padding:70px 0; border-top:1px solid #ddd;">
    <div class="container" style="text-align:center; max-width:800px;">
        <h2 class="section-title font-head" style="color:#111;">CONTACT</h2>
        <p style="color:#555; font-size:17px; margin-bottom:25px;">
            Vragen of zin om lid te worden? Stuur ons een mailtje:
        </p>
        {{-- Email link gestyled als oranje knop --}}
        <a href="mailto:pedallica@outlook.be"
           style="background:#f97316; color:#111; font-weight:700; text-decoration:none;
                  padding:12px 22px; border-radius:12px; display:inline-block;
                  box-shadow:0 5px 12px rgba(249,115,22,0.25); transition:all .2s;">
            pedallica@outlook.be
        </a>
    </div>
</section>

</body>
</html>

@endsection
