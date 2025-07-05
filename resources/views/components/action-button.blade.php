@props([
    'type' => 'link',
    'href' => '#',
    'color' => 'gray',
])

@php
    $colorClasses = match ($color) {
        'green' => 'bg-emerald-500 hover:bg-emerald-600 focus:ring-emerald-500 text-white',
        'yellow' => 'bg-amber-500 hover:bg-amber-600 focus:ring-amber-500 text-white',
        'blue' => 'bg-blue-500 hover:bg-blue-600 focus:ring-blue-500 text-white',
        'red' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white',
        default => 'bg-white border-gray-300 hover:bg-gray-50 focus:ring-indigo-500 text-gray-700',
    };

    $baseClasses = 'inline-flex items-center px-3 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150';
@endphp

@if ($type === 'link')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button type="submit" {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorClasses]) }}>
        {{ $slot }}
    </button>
@endif
