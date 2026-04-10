@props(['title', 'icon', 'route' => '#', 'active' => false, 'type' => 'link'])

<div x-data="{ open: {{ $active ? 'true' : 'false' }} }" class="w-full px-4 mb-1">
    @if($type === 'dropdown')
        {{-- MENU DÉROULANT --}}
        <button @click="open = !open" 
            class="w-full flex items-center justify-between px-6 py-3.5 rounded-xl transition-all duration-200 group {{ $active ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            <div class="flex items-center gap-4">
                <i class="{{ $icon }} text-lg opacity-80 group-hover:opacity-100 transition-opacity"></i>
                <span class="font-medium text-[14px] tracking-wide text-left">{{ $title }}</span>
            </div>
            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
        </button>

        {{-- SOUS-MENU (Ligne verticale blanche) --}}
        <div x-show="open" x-collapse x-cloak class="ml-10 border-l border-white/10 mt-1 space-y-1">
            {{ $slot }}
        </div>
    @else
        {{-- LIEN SIMPLE (Style Orange si actif) --}}
        <a href="{{ $route }}" 
            class="flex items-center gap-4 px-6 py-3.5 rounded-xl transition-all duration-200 {{ $active ? 'bg-[#FF9F29] text-white shadow-lg font-bold scale-[1.02]' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            <i class="{{ $icon }} text-lg"></i>
            <span class="text-[14px]">{{ $title }}</span>
        </a>
    @endif
</div>