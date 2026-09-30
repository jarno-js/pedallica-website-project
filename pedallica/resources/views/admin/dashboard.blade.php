@extends('layouts.app')

@section('title', 'Admin Dashboard - Pedallica')

@section('content')
<style>
    .admin-page {
        background: #0b0b0d;
        min-height: 100vh;
        font-family: Inter, system-ui, -apple-system, sans-serif;
    }
    .admin-page .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px;
    }
    .admin-header {
        margin-bottom: 30px;
    }
    .admin-header h1 {
        font-family: "Bebas Neue", system-ui, sans-serif;
        font-size: 42px;
        color: white;
        margin: 0 0 8px;
    }
    .admin-header .underline {
        width: 60px;
        height: 3px;
        background: #f97316;
        margin-bottom: 12px;
    }
    .admin-header p {
        color: #b9b9c0;
        font-size: 14px;
    }

    /* Alerts */
    .admin-alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .admin-alert.success {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #10b981;
    }
    .admin-alert.error {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
    .admin-alert ul {
        margin: 8px 0 0 0;
        padding-left: 20px;
    }

    /* Tabs */
    .admin-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .admin-tab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: #16161a;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        color: #b9b9c0;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    .admin-tab:hover {
        background: #1f1f24;
        color: white;
    }
    .admin-tab.active {
        background: #f97316;
        color: #111;
        border-color: #f97316;
    }
    .admin-tab svg {
        width: 18px;
        height: 18px;
    }

    /* Content Card */
    .admin-content {
        background: #16161a;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 30px;
    }

    /* Override child styles for dark theme */
    .admin-content h2, .admin-content h3 {
        color: white;
        font-family: "Bebas Neue", system-ui, sans-serif;
    }
    .admin-content h2 {
        font-size: 28px;
        margin-bottom: 20px;
    }
    .admin-content h3 {
        font-size: 22px;
    }
    .admin-content p {
        color: #b9b9c0;
    }
    .admin-content label {
        color: #e8e8ea;
    }
    .admin-content input[type="text"],
    .admin-content input[type="email"],
    .admin-content input[type="url"],
    .admin-content input[type="file"],
    .admin-content textarea,
    .admin-content select {
        background: #0b0b0d;
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        border-radius: 8px;
        padding: 10px 14px;
    }
    .admin-content input:focus,
    .admin-content textarea:focus,
    .admin-content select:focus {
        outline: none;
        border-color: #f97316;
    }
    .admin-content input::placeholder {
        color: #666;
    }
    .admin-content table {
        width: 100%;
        border-collapse: collapse;
    }
    .admin-content thead {
        background: #0b0b0d;
    }
    .admin-content th {
        color: #b9b9c0;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .admin-content td {
        padding: 14px 16px;
        color: #e8e8ea;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        font-size: 14px;
    }
    .admin-content tbody tr:hover {
        background: rgba(255,255,255,0.02);
    }

    /* Cards in grid */
    .admin-content .grid {
        display: grid;
        gap: 16px;
    }
    .admin-content .card {
        background: #0b0b0d;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        padding: 16px;
    }
    .admin-content .card:hover {
        border-color: rgba(255,255,255,0.15);
    }

    /* Buttons */
    .admin-content .btn-primary,
    .admin-content button[type="submit"].bg-orange-500,
    .admin-content .bg-orange-500 {
        background: #f97316 !important;
        color: #111 !important;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .admin-content .btn-primary:hover,
    .admin-content .bg-orange-500:hover {
        background: #ea580c !important;
    }
    .admin-content .bg-blue-500 {
        background: #3b82f6 !important;
    }
    .admin-content .bg-blue-500:hover {
        background: #2563eb !important;
    }
    .admin-content .bg-green-500 {
        background: #10b981 !important;
    }
    .admin-content .bg-green-500:hover {
        background: #059669 !important;
    }
    .admin-content .bg-red-500 {
        background: #ef4444 !important;
    }
    .admin-content .bg-red-500:hover {
        background: #dc2626 !important;
    }
    .admin-content .bg-purple-500 {
        background: #8b5cf6 !important;
    }
    .admin-content .bg-purple-500:hover {
        background: #7c3aed !important;
    }
    .admin-content .bg-gray-500 {
        background: #6b7280 !important;
    }
    .admin-content .bg-gray-500:hover {
        background: #4b5563 !important;
    }
    .admin-content .bg-gray-300 {
        background: #374151 !important;
        color: #e8e8ea !important;
    }
    .admin-content .bg-gray-300:hover {
        background: #4b5563 !important;
    }

    /* Status badges */
    .admin-content .bg-purple-100 {
        background: rgba(139, 92, 246, 0.2) !important;
        color: #a78bfa !important;
    }
    .admin-content .bg-green-100 {
        background: rgba(16, 185, 129, 0.2) !important;
        color: #34d399 !important;
    }
    .admin-content .bg-yellow-100 {
        background: rgba(245, 158, 11, 0.2) !important;
        color: #fbbf24 !important;
    }

    /* Warning box */
    .admin-content .bg-yellow-50 {
        background: rgba(245, 158, 11, 0.1) !important;
        border-color: rgba(245, 158, 11, 0.3) !important;
    }
    .admin-content .text-yellow-700 {
        color: #fbbf24 !important;
    }

    /* Modal overrides */
    .admin-content #userModal > div,
    .admin-content #sponsorModal > div,
    .admin-content #eventModal > div,
    .admin-content #ritModal > div,
    #userModal > div,
    #sponsorModal > div,
    #eventModal > div,
    #ritModal > div {
        background: #16161a !important;
        border: 1px solid rgba(255,255,255,0.1);
    }
    #userModal h3, #userModal h4,
    #sponsorModal h3,
    #eventModal h3,
    #ritModal h3 {
        color: white !important;
    }
    #userModal p,
    #sponsorModal p,
    #eventModal p,
    #ritModal p {
        color: #b9b9c0 !important;
    }
    #userModal .text-gray-900,
    #sponsorModal .text-gray-900,
    #eventModal .text-gray-900,
    #ritModal .text-gray-900 {
        color: white !important;
    }
    #userModal .text-gray-500,
    #sponsorModal .text-gray-500,
    #eventModal .text-gray-500,
    #ritModal .text-gray-500 {
        color: #b9b9c0 !important;
    }
    #userModal .border-b,
    #sponsorModal .border-b,
    #eventModal .border-b,
    #ritModal .border-b {
        border-color: rgba(255,255,255,0.1) !important;
    }

    /* Profile pictures */
    .admin-content .bg-gray-200 {
        background: #2a2a30 !important;
    }
    .admin-content .text-gray-600 {
        color: #b9b9c0 !important;
    }
    .admin-content .text-gray-500 {
        color: #888 !important;
    }
    .admin-content .text-gray-900 {
        color: white !important;
    }
    .admin-content .text-gray-700 {
        color: #e8e8ea !important;
    }

    /* Shadows and borders */
    .admin-content .shadow,
    .admin-content .shadow-sm,
    .admin-content .shadow-md {
        box-shadow: none !important;
    }
    .admin-content .border-gray-200,
    .admin-content .border-gray-100 {
        border-color: rgba(255,255,255,0.08) !important;
    }
    .admin-content .bg-white {
        background: #1f1f24 !important;
    }
    .admin-content .bg-gray-50 {
        background: #16161a !important;
    }

    @media (max-width: 768px) {
        .admin-page .container {
            padding: 20px;
        }
        .admin-header h1 {
            font-size: 32px;
        }
        .admin-tabs {
            gap: 6px;
        }
        .admin-tab {
            padding: 10px 14px;
            font-size: 13px;
        }
        .admin-tab span {
            display: none;
        }
        .admin-content {
            padding: 20px;
        }
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div class="admin-page">
    <div class="container">
        <!-- Header -->
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <div class="underline"></div>
            <p>Beheer leden, sponsors, kalender en ritten</p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="admin-alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="admin-alert error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="admin-alert error">
                <strong>Er zijn fouten opgetreden:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tabs -->
        <div class="admin-tabs">
            <a href="{{ route('admin.dashboard', ['tab' => 'leden']) }}"
               class="admin-tab {{ $tab === 'leden' ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Leden</span>
            </a>
            <a href="{{ route('admin.dashboard', ['tab' => 'sponsors']) }}"
               class="admin-tab {{ $tab === 'sponsors' ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Sponsors</span>
            </a>
            <a href="{{ route('admin.dashboard', ['tab' => 'kalender']) }}"
               class="admin-tab {{ $tab === 'kalender' ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Kalender</span>
            </a>
            <a href="{{ route('admin.dashboard', ['tab' => 'ritten']) }}"
               class="admin-tab {{ $tab === 'ritten' ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                <span>Ritten</span>
            </a>
        </div>

        <!-- Content -->
        <div class="admin-content">
            @if($tab === 'leden')
                @include('admin.tabs.leden')
            @elseif($tab === 'sponsors')
                @include('admin.tabs.sponsors')
            @elseif($tab === 'kalender')
                @include('admin.tabs.kalender')
            @elseif($tab === 'ritten')
                @include('admin.tabs.ritten')
            @endif
        </div>
    </div>
</div>
@endsection
