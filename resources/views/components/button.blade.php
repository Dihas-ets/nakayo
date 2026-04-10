@props(['variant' => 'primary', 'icon' => null])

@php
    $variants = [
        'primary' => 'bg-[#1B2E58] hover:bg-[#00261C] text-white',
        'orange'  => 'bg-[#FF9F29] hover:bg-[#e88f24] text-white',
        'danger'  => 'bg-red-600 hover:bg-red-700 text-white',
        'outline' => 'border-2 border-[#1B2E58] text-[#1B2E58] hover:bg-[#1B2E58] hover:text-white',
    ];
    $class = $variants[$variant] ?? $variants['primary'];
@endphp

<button {{ $attributes->merge(['class' => "$class px-6 py-2.5 rounded-xl font-bold transition-all duration-200 flex items-center justify-center gap-2 active:scale-95 shadow-sm"]) }}>
    @if($icon) <i class="{{ $icon }}"></i> @endif
    {{ $slot }}
</button>