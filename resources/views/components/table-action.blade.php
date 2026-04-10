@props(['type' => 'edit', 'click' => ''])

@php
    $colors = [
        'edit' => 'text-blue-500 hover:bg-blue-50',
        'delete' => 'text-red-500 hover:bg-red-50',
        'view' => 'text-gray-500 hover:bg-gray-50'
    ];
    $icons = [
        'edit' => 'fa-pen-to-square',
        'delete' => 'fa-trash-can',
        'view' => 'fa-eye'
    ];
@endphp

<button @click="{{ $click }}" {{ $attributes->merge(['class' => $colors[$type] . " p-2 rounded-lg transition-colors duration-200"]) }}>
    <i class="fa-solid {{ $icons[$type] }} text-lg"></i>
</button>