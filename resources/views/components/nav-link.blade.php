@props(['active'])

@php
    $inactiveClasses = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-100 focus:outline-none focus:text-white focus:border-gray-100 transition duration-150 ease-in-out';

    $activeClasses = 'inline-flex items-center px-1 pt-1 border-b-2 border-white text-white text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $active ? $activeClasses : $inactiveClasses]) }}>
    {{ $slot }}
</a>
