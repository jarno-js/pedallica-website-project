@props(['type' => 'info'])

@php
    $styles = [
        'success' => 'bg-green-50 border-green-500 text-green-800',
        'error' => 'bg-red-50 border-red-500 text-red-800',
        'warning' => 'bg-yellow-50 border-yellow-500 text-yellow-800',
        'info' => 'bg-blue-50 border-blue-500 text-blue-800',
    ];

    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'error' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];

    $iconColors = [
        'success' => 'text-green-500',
        'error' => 'text-red-500',
        'warning' => 'text-yellow-500',
        'info' => 'text-blue-500',
    ];

    $classes = $styles[$type] ?? $styles['info'];
    $icon = $icons[$type] ?? $icons['info'];
    $iconColor = $iconColors[$type] ?? $iconColors['info'];
@endphp

<div {{ $attributes->merge(['class' => 'border-l-4 p-4 rounded-r-md ' . $classes]) }} role="alert">
    <div class="flex items-start">
        <svg class="h-6 w-6 {{ $iconColor }} mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $icon !!}
        </svg>
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>
</div>
