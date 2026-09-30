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

        /* HERO SLIDESHOW SECTIE */
        .hero-slideshow {
            position: relative;
            width: 100%;
            aspect-ratio: 1920 / 1000;
            overflow: hidden;
        }
        .hero-slideshow .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .hero-slideshow .slide.active {
            opacity: 1;
        }
        .hero-slideshow .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-slideshow .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 5%;
            padding-top: 10%;
        }
        .hero-slideshow .hero-title {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: clamp(28px, 5vw, 48px);
            color: white;
            font-style: normal;
            line-height: 1.05;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
            max-width: 500px;
            text-transform: uppercase;
        }

        /* INFO SLIDESHOW SECTIE */
        .info-slideshow {
            position: relative;
            background: white;
            padding: 100px 0;
        }
        .info-slideshow .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 80px;
        }
        .info-slide {
            display: none;
            align-items: center;
            gap: 120px;
        }
        .info-slide.active {
            display: flex;
        }
        .info-slide .image-side {
            flex: 0 0 45%;
        }
        .info-slide .image-side img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 16px;
        }
        .info-slide .text-side {
            flex: 1;
            min-width: 0;
        }
        .info-slide .label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        .info-slide .label::before {
            content: '';
            width: 4px;
            height: 20px;
            background: var(--accent);
            border-radius: 2px;
        }
        .info-slide .text-side h2 {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: 38px;
            color: #111;
            margin: 0 0 28px;
            line-height: 1.1;
        }
        .info-slide .text-side p {
            color: #555;
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 22px;
        }
        .info-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 45px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            z-index: 10;
        }
        .info-nav:hover {
            background: #f5f5f5;
        }
        .info-nav.prev {
            left: 15px;
        }
        .info-nav.next {
            right: 15px;
        }
        .info-nav svg {
            width: 20px;
            height: 20px;
            stroke: #333;
        }
        @media(max-width: 768px) {
            .info-slideshow {
                padding: 40px 0 80px;
            }
            .info-slide {
                flex-direction: column;
                gap: 36px;
            }
            .info-slide .image-side,
            .info-slide .text-side {
                max-width: 100%;
            }
            .info-slide .image-side img {
                height: 320px;
            }
            .info-slideshow .container {
                padding: 0 20px;
            }
            .info-nav {
                position: absolute;
                top: auto;
                bottom: 16px;
                transform: none;
                width: 38px;
                height: 38px;
            }
            .info-nav.prev {
                left: calc(50% - 48px);
            }
            .info-nav.next {
                right: calc(50% - 48px);
            }
        }

        /* PLOEGEN SECTIE */
        .ploegen-section {
            background: #1a1a1d;
            padding: 60px 0 80px;
        }
        .ploegen-section .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .ploegen-section .section-header {
            margin-bottom: 40px;
        }
        .ploegen-section .section-header h2 {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: 42px;
            color: white;
            margin: 0 0 8px;
        }
        .ploegen-section .section-header .underline {
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin-bottom: 16px;
        }
        .ploegen-section .section-header p {
            color: var(--muted);
            font-size: 14px;
            max-width: 600px;
            line-height: 1.6;
        }
        .ploegen-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }
        .ploeg-card {
            text-align: center;
        }
        .ploeg-card .ploeg-image {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid var(--ring);
        }
        .ploeg-card .ploeg-name {
            color: white;
            font-size: 15px;
            font-weight: 500;
        }
        @media(max-width: 900px) {
            .ploegen-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media(max-width: 600px) {
            .ploegen-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* KALENDER SECTIE */
        .kalender-section {
            background: #1a1a1d;
            padding: 60px 0 80px;
        }
        .kalender-section .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .kalender-section .section-header {
            margin-bottom: 40px;
        }
        .kalender-section .section-header h2 {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: 42px;
            color: white;
            margin: 0 0 8px;
        }
        .kalender-section .section-header .underline {
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin-bottom: 16px;
        }
        .kalender-section .section-header p {
            color: var(--muted);
            font-size: 14px;
            max-width: 500px;
            line-height: 1.6;
        }
        .kalender-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        .kalender-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--ring);
        }
        .kalender-item .datum {
            min-width: 50px;
            text-align: left;
        }
        .kalender-item .datum .dag {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: 36px;
            color: white;
            line-height: 1;
        }
        .kalender-item .datum .maand {
            font-size: 12px;
            color: var(--muted);
            text-transform: lowercase;
        }
        .kalender-item .info h3 {
            font-size: 15px;
            font-weight: 600;
            color: white;
            margin: 0 0 4px;
        }
        .kalender-item .info p {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }
        @media(max-width: 900px) {
            .kalender-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media(max-width: 600px) {
            .kalender-grid {
                grid-template-columns: 1fr;
            }
        }

        /* SPONSORS SECTIE */
        .sponsors-section {
            background: #1a1a1d;
            padding: 60px 0 120px;
        }
        .sponsors-section .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .sponsors-section .section-header {
            margin-bottom: 50px;
        }
        .sponsors-section .section-header h2 {
            font-family: "Bebas Neue", system-ui, sans-serif;
            font-size: 42px;
            color: white;
            margin: 0 0 8px;
        }
        .sponsors-section .section-header .underline {
            width: 60px;
            height: 3px;
            background: var(--accent);
        }
        .sponsors-grid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        .sponsors-grid a,
        .sponsors-grid img {
            height: 90px;
            width: auto;
            object-fit: contain;
        }
        .sponsors-grid img {
            filter: brightness(0) invert(1);
            transition: transform 0.2s ease;
        }
        .sponsors-grid a:hover img {
            transform: scale(1.05);
        }
        @media(max-width: 768px) {
            .sponsors-grid {
                justify-content: center;
            }
            .sponsors-grid img {
                height: 70px;
            }
        }

        /* FOOTER */
        .site-footer {
            background: var(--accent);
            padding: 40px 0;
        }
        .site-footer .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .site-footer .footer-left {
            color: #111;
            font-size: 13px;
            line-height: 1.8;
            text-align: left;
        }
        .site-footer .footer-right {
            color: #111;
            font-size: 13px;
            font-style: italic;
            text-align: right;
        }
        @media(max-width: 600px) {
            .site-footer .container {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }

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
{{-- Success/Error meldingen --}}
@if(session('success'))
<div style="background:#10b981;color:white;padding:16px;text-align:center;font-weight:600;border-bottom:1px solid rgba(255,255,255,.1)">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background:#ef4444;color:white;padding:16px;text-align:center;font-weight:600;border-bottom:1px solid rgba(255,255,255,.1)">
    {{ session('error') }}
</div>
@endif

{{-- HERO SLIDESHOW --}}
<div class="hero-slideshow">
    <div class="slide active">
        <img src="{{ asset('fotos-homepagina/Banner homepage/slideshow.jpg') }}" alt="Pedallica ride">
    </div>
    <div class="slide">
        <img src="{{ asset('fotos-homepagina/Banner homepage/slideshow2.jpg') }}" alt="Pedallica ride">
    </div>
    <div class="slide">
        <img src="{{ asset('fotos-homepagina/Banner homepage/slideshow3.jpg') }}" alt="Pedallica ride">
    </div>
    <div class="slide">
        <img src="{{ asset('fotos-homepagina/Banner homepage/slideshow4.jpg') }}" alt="Pedallica ride">
    </div>
    <div class="overlay">
        <h1 class="hero-title">NIET ZOMAAR EEN<br>ZOVEELSTE FIETSCLUB</h1>
    </div>
</div>

<script>
    // Slideshow functionaliteit
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slideshow .slide');
        let currentSlide = 0;

        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        // Wissel elke 5 seconden
        setInterval(nextSlide, 5000);
    });
</script>

{{-- INFO SLIDESHOW SECTIE --}}
<section class="info-slideshow">
    <button class="info-nav prev" onclick="changeInfoSlide(-1)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="info-nav next" onclick="changeInfoSlide(1)">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <div class="container">
        {{-- Slide 1: Wat is Pedallica --}}
        <div class="info-slide active">
            <div class="image-side">
                <img src="{{ asset('fotos-homepagina/Kuiper 1.JPG') }}" alt="Pedallica groep">
            </div>
            <div class="text-side">
                <div class="label">PEDALLICA</div>
                <h2>Wat is Pedallica?</h2>
                <p>Pedallica is niet zomaar een gewone fietsclub. We zijn een groep vrienden, en bieden een unieke fietservaring aan voor fietsers op elk niveau. Pedallica heeft zijn oorsprong in het Schepdaalse en is ontstaan in 2020. Momenteel tellen wij een 70-tal leden en zijn wij nog steeds groeiende.</p>
                <p>De bedoeling blijft om een leuke, familiale club te zijn. Daarom zijn er verschillende niveaus, voor elk wat wils. Wij hebben 5 groepen: A-, B-, C-, mtb- en vrouwengroep. In de zomer bieden we ook op donderdagavond een rit aan.</p>
            </div>
        </div>

        {{-- Slide 2: Waar vertrekt Pedallica --}}
        <div class="info-slide">
            <div class="image-side">
                <img src="{{ asset('fotos-homepagina/Kuiper vertrek.JPG') }}" alt="Cafe De Rustberg">
            </div>
            <div class="text-side">
                <div class="label">PEDALLICA</div>
                <h2>Waar vertrekt Pedallica?</h2>
                <p>Pedallica vertrekt elke zondag om 8u30 aan ons clubcafe In de Rustberg.</p>
                <p>Dit is gelegen op de Scheestraat 129 te Schepdaal en in de volksmond beter gekend als "bij Kuiper" of als het supporterscafe van Remco Evenepoel. Na de rit verzamelen we hier ook met de verschillende ploegen om nog even op adem te komen, tussen pot en pint.</p>
            </div>
        </div>
    </div>
</section>

<script>
    // Info slideshow navigatie
    let currentInfoSlide = 0;
    const infoSlides = document.querySelectorAll('.info-slide');

    function changeInfoSlide(direction) {
        infoSlides[currentInfoSlide].classList.remove('active');
        currentInfoSlide = (currentInfoSlide + direction + infoSlides.length) % infoSlides.length;
        infoSlides[currentInfoSlide].classList.add('active');
    }

    // Automatisch wisselen elke 20 seconden
    setInterval(function() {
        changeInfoSlide(1);
    }, 20000);
</script>

{{-- PLOEGEN SECTIE --}}
<section id="ploegen" class="ploegen-section">
    <div class="container">
        <div class="section-header">
            <h2>Onze Ploegen</h2>
            <div class="underline"></div>
            <p>Momenteel beschikken wij over 5 verschillende ploegen. Iedereen is vrij zelf te kiezen bij welk team hij aansluit. Je bevestigt je aanwezigheid via de website op de gekozen rit.</p>
        </div>

        <div class="ploegen-grid">
            @php
                $ploegImages = [
                    'pedallica-a' => 'A-ploeg.JPG',
                    'pedallica-b' => 'B-ploeg.JPG',
                    'pedallica-c' => 'C-ploeg.JPG',
                    'mtb' => 'MTB.jpg',
                    'pedallicava' => 'Cava.jpeg',
                ];
            @endphp
            @foreach($ploegen as $ploeg)
                <div class="ploeg-card" onclick="openPloegModal('{{ $ploeg->slug }}')" style="cursor: pointer;">
                    <img src="{{ asset('fotos-homepagina/' . ($ploegImages[$ploeg->slug] ?? 'A-ploeg.JPG')) }}" alt="{{ $ploeg->name }}" class="ploeg-image">
                    <span class="ploeg-name">{{ $ploeg->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- KALENDER SECTIE --}}
<section id="kalender" class="kalender-section">
    <div class="container">
        <div class="section-header">
            <h2>Kalender</h2>
            <div class="underline"></div>
            <p>Ontdek onze komende en eerdere wielerevenementen. Dit zijn speciale gebeurtenissen buiten onze wekelijkse ritten.</p>
        </div>

        <div class="kalender-grid">
            @php
                $maanden = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];
            @endphp
            @foreach($events as $event)
                <div class="kalender-item">
                    <div class="datum">
                        <div class="dag">{{ $event->date->format('d') }}</div>
                        <div class="maand">{{ $maanden[$event->date->format('n') - 1] }}</div>
                    </div>
                    <div class="info">
                        <h3>{{ $event->title }}</h3>
                        @if($event->description)
                            <p>{{ $event->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SPONSORS SECTIE --}}
<section class="sponsors-section">
    <div class="container">
        <div class="section-header">
            <h2>Onze Hoofdsponsors</h2>
            <div class="underline"></div>
        </div>

        <div class="sponsors-grid">
            @foreach($sponsors as $sponsor)
                @if($sponsor->website)
                    <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}">
                    </a>
                @else
                    <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}">
                @endif
            @endforeach
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="site-footer">
    <div class="container">
        <div class="footer-left">
            <strong>&copy; 2026 Pedallica vzw</strong><br>
            Pedallica@outlook.be | Jan de Trochstraat 166, 1703 Schepdaal<br>
            Ondernemingsnummer BE 0794.688.980
        </div>
        <div class="footer-right">
            Gerealiseerd door Jarno Janssens
        </div>
    </div>
</footer>

{{-- PLOEG RITTEN MODAL --}}
<div id="ploegModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 1000; overflow-y: auto;">
    <div style="position: relative; max-width: 600px; margin: 80px auto; background: white; border-radius: 16px; padding: 30px; max-height: calc(100vh - 160px); overflow-y: auto;">
        <button onclick="closePloegModal()" style="position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
        <h2 id="ploegModalTitle" style="font-family: 'Bebas Neue', sans-serif; font-size: 32px; margin: 0 0 20px; color: #111;"></h2>
        <div id="ploegModalContent"></div>
    </div>
</div>

<style>
    .ritten-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .ritten-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }
    .ritten-list li:last-child {
        border-bottom: none;
    }
    .rit-title {
        font-weight: 600;
        color: #111;
        flex: 1;
    }
    .rit-info {
        display: flex;
        gap: 20px;
        color: #666;
        font-size: 14px;
    }
    .rit-info span {
        white-space: nowrap;
    }
    .no-ritten {
        color: #666;
        font-style: italic;
        padding: 20px 0;
    }
</style>

<script>
    const ploegenData = @json($ploegen);

    function openPloegModal(slug) {
        const ploeg = ploegenData.find(p => p.slug === slug);
        if (!ploeg) return;

        document.getElementById('ploegModalTitle').textContent = 'Ritten ' + ploeg.name;

        let content = '';
        if (ploeg.ritten && ploeg.ritten.length > 0) {
            content = '<ul class="ritten-list">';
            ploeg.ritten.forEach(rit => {
                const date = new Date(rit.date);
                const formattedDate = date.toLocaleDateString('nl-BE', { day: '2-digit', month: '2-digit', year: 'numeric' });
                content += `
                    <li>
                        <span class="rit-title">${rit.title}</span>
                        <div class="rit-info">
                            <span>${formattedDate}</span>
                            <span>${rit.distance ? rit.distance + ' km' : '-'}</span>
                            <span>${rit.elevation_gain ? rit.elevation_gain + ' hm' : '-'}</span>
                        </div>
                    </li>
                `;
            });
            content += '</ul>';
        } else {
            content = '<p class="no-ritten">Nog geen ritten beschikbaar voor deze ploeg.</p>';
        }

        document.getElementById('ploegModalContent').innerHTML = content;
        document.getElementById('ploegModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closePloegModal() {
        document.getElementById('ploegModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // Close modal on background click
    document.getElementById('ploegModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePloegModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePloegModal();
        }
    });
</script>

</body>
</html>

@endsection
