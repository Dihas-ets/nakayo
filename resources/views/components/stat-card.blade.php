@props(['title', 'value', 'icon', 'trend' => null, 'color' => 'blue'])

@php
    $iconColors = [
        'blue'   => 'bg-blue-50 text-[#1B2E58]',
        'green'  => 'bg-emerald-50 text-[#00261C]',
        'orange' => 'bg-orange-50 text-[#FF9F29]',
    ];
    $selectedColor = $iconColors[$color] ?? $iconColors['blue'];
@endphp

<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $title }}</p>
            <h3 class="text-3xl font-black text-[#1B2E58] mt-1 group-hover:text-[#FF9F29] transition-colors">
                {{ $value }}
            </h3>
            
            @if($trend)
                <div class="flex items-center mt-2 text-[11px] font-bold text-emerald-500">
                    <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                    <span>{{ $trend }}% ce mois</span>
                </div>
            @endif
        </div>

        <div class="w-14 h-14 {{ $selectedColor }} rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 duration-300">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
</div>