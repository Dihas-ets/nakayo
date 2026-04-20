@extends('layouts.app')

@section('title', 'gallerie')

@section('content')

{{-- 1. NAVBAR (Optionnelle si déjà dans layout) --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-sm bg-white">
        @include('components.navbar')
    </header>
@endif

@
<!-- GLightbox (Zoom images) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    .animate-kenburns { animation: kenburns 20s ease-out infinite alternate; }
    .masonry-grid { column-gap: 2rem; }
    .masonry-item { break-inside: avoid; margin-bottom: 2rem; }
</style>

<!-- 1. HERO SECTION : DESIGN WOUAH -->
<section class="relative h-[600px] flex flex-col items-center justify-center text-white overflow-hidden font-sans">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1920" 
             alt="Prestige Background" 
             class="w-full h-full object-cover animate-kenburns">
        <!-- Overlay sombre profond exclusif -->
        <div class="absolute inset-0 bg-[#00261C]/85 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#F8FAFC]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
        <span class="text-[#FF9F29] font-black uppercase tracking-[7px] text-[10px] mb-6 block">Portfolio Excellence</span>
        <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-none mb-8 uppercase">
            L'Impact <br> <span class="text-[#FF9F29]">Visuel</span>
        </h1>
        <div class="h-2 w-24 bg-[#FF9F29] mx-auto rounded-full shadow-[0_0_20px_rgba(255,159,41,0.6)]"></div>
    </div>
</section>

<!-- 2. GALERIE DYNAMIQUE MASONRY -->
<section class="py-24 bg-[#F8FAFC]" x-data="{ activeFilter: 'tous' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Filtres Interactifs -->
        <div class="flex flex-wrap justify-center gap-3 mb-20">
            @foreach(['tous', 'piscine', 'immobilier', 'agro', 'industrie'] as $filter)
            <button 
                @click="activeFilter = '{{ $filter }}'"
                :class="activeFilter === '{{ $filter }}' ? 'bg-[#1B2E58] text-white scale-110 shadow-xl' : 'bg-white text-[#1B2E58] hover:bg-gray-100'"
                class="px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all duration-500 border border-gray-100 italic">
                {{ $filter }}
            </button>
            @endforeach
        </div>

        <!-- Grille Masonry -->
        <div class="columns-1 md:columns-2 lg:columns-3 masonry-grid">
            
            @php
                $gallery = [
                    ['cat' => 'piscine',    'url' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=800', 'title' => 'Villa Horizon', 'h' => 'h-[450px]'],
                    ['cat' => 'immobilier', 'url' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=800', 'title' => 'Résidence Nakayo', 'h' => 'h-[300px]'],
                    ['cat' => 'agro',       'url' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?q=80&w=800', 'title' => 'Ferme Connectée', 'h' => 'h-[550px]'],
                    ['cat' => 'industrie',  'url' => 'https://images.unsplash.com/photo-1600857062241-98e5dba7f214?q=80&w=800', 'title' => 'Unité Savonnerie', 'h' => 'h-[350px]'],
                    ['cat' => 'piscine',    'url' => 'https://images.unsplash.com/photo-1534433843472-62c648cae61c?q=80&w=800', 'title' => 'Bassin Design', 'h' => 'h-[400px]'],
                    ['cat' => 'immobilier', 'url' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=800', 'title' => 'Salon de Prestige', 'h' => 'h-[320px]'],
                    ['cat' => 'agro',       'url' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800', 'title' => 'Culture Durable', 'h' => 'h-[480px]'],
                    ['cat' => 'piscine',    'url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800', 'title' => 'Éclat Nocturne', 'h' => 'h-[500px]'],
                    ['cat' => 'industrie',  'url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=800', 'title' => 'Hub Logistique', 'h' => 'h-[300px]'],
                ];
            @endphp

            @foreach($gallery as $item)
            <div 
                x-show="activeFilter === 'tous' || activeFilter === '{{ $item['cat'] }}'"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                class="masonry-item group relative overflow-hidden rounded-[3rem] bg-white shadow-sm cursor-pointer border border-gray-100">
                
                <!-- Zone Image -->
                <div class="{{ $item['h'] }} overflow-hidden">
                    <img src="{{ $item['url'] }}" 
                         class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">
                </div>

                <!-- Overlay au survol (Design Luxe) -->
                <div class="absolute inset-0 bg-[#1B2E58]/90 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-md flex flex-col justify-end p-12">
                    <div class="translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <span class="text-[#FF9F29] font-black text-[10px] uppercase tracking-[4px] mb-3 block italic">{{ $item['cat'] }}</span>
                        <h3 class="text-white text-3xl font-black uppercase tracking-tighter mb-8 leading-none">{{ $item['title'] }}</h3>
                        
                        <a href="{{ $item['url'] }}" class="glightbox inline-flex items-center justify-center w-14 h-14 bg-white text-[#1B2E58] rounded-full hover:bg-[#FF9F29] hover:text-white transition-all shadow-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Badge Catégorie permanent (Design Minimal) -->
                <div class="absolute top-8 left-8 bg-white/10 backdrop-blur-xl border border-white/20 text-white px-5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest group-hover:opacity-0 transition-opacity">
                    {{ $item['cat'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. SECTION FINALE : APPEL À L'ACTION -->
<section class="py-24 bg-[#1B2E58] relative overflow-hidden">
    <!-- Décoration de fond -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    
    <div class="max-w-4xl mx-auto text-center px-6 relative z-10">
        <h2 class="text-white text-4xl md:text-6xl font-black mb-10 uppercase tracking-tight leading-none">
            Prêt à réaliser <br> votre <span class="text-[#FF9F29]">chef-d'œuvre</span> ?
        </h2>
        <a href="https://wa.me/2290166556161" target="_blank" class="inline-flex items-center gap-4 bg-[#FF9F29] text-[#1B2E58] px-12 py-5 rounded-2xl font-black uppercase text-xs tracking-[3px] hover:bg-white hover:scale-105 transition-all shadow-2xl">
            Lancer mon projet <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            zoomable: true
        });
    });
</script>
@endsection