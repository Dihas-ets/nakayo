@extends('layouts.app')

@section('content')


{{-- 1. NAVBAR (Optionnelle si déjà dans layout) --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-sm bg-white">
        @include('components.navbar')
    </header>
@endif



<style>
    [x-cloak] { display: none !important; }
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    .animate-kenburns { animation: kenburns 20s ease-out infinite alternate; }
</style>

<!-- 1. HERO SECTION LUXE -->
<section class="relative h-[600px] flex flex-col items-center justify-center text-white overflow-hidden font-sans">
    <div class="absolute inset-0 z-0">
        <!-- Image de fond (Bureau d'étude / Chantier Pro) -->
        <img src="https://images.unsplash.com/photo-1503387762-592dee58c460?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover animate-kenburns">
        
        <!-- Overlay Sombre Profond -->
        <div class="absolute inset-0 bg-[#0a1d21]/85 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#F8FAFC]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
        <span class="text-[#FF9F29] font-black uppercase tracking-[7px] text-[10px] mb-6 block">Expertise & Réalisation</span>
        <h1 class="text-5xl md:text-8xl font-black tracking-tighter leading-none mb-8 uppercase">
            Nos Grands <br> <span class="text-[#FF9F29]">Chantiers</span>
        </h1>
        <p class="text-white/80 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed mb-10 font-medium">
            De la conception à la livraison finale, découvrez comment NAKAYO transforme des idées en réalités concrètes et durables au Bénin.
        </p>
        
        <div class="flex justify-center mb-12">
            <a href="https://wa.me/2290166556161" target="_blank" class="inline-flex items-center gap-4 bg-white text-[#1B2E58] px-10 py-4 rounded-2xl font-black uppercase text-xs tracking-[2px] hover:bg-[#FF9F29] hover:text-white transition-all shadow-2xl group">
                Lancer mon projet avec NAKAYO
                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>
    </div>

    <!-- Breadcrumbs bas -->
    <div class="absolute bottom-10 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-3 text-white text-[10px] font-black uppercase tracking-[3px] text-white/60">
            <a href="/" class="hover:text-[#FF9F29] transition">Accueil</a>
            <span class="text-[#FF9F29] opacity-40">/</span>
            <span class="text-white">Réalisations</span>
            <span class="text-[#FF9F29] opacity-40">/</span>
            <span class="text-white">Projets</span>
        </nav>
    </div>
</section>

<!-- 2. SECTION GRILLE DYNAMIQUE -->
<section class="py-24 bg-[#F8FAFC]" x-data="{ activeFilter: 'tous' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <!-- Filtres de Catégories (Alpine.js) -->
        <div class="flex flex-wrap justify-center gap-3 mb-20">
            @foreach(['tous', 'construction', 'immobilier', 'agro', 'industrie'] as $filter)
            <button 
                @click="activeFilter = '{{ $filter }}'"
                :class="activeFilter === '{{ $filter }}' ? 'bg-[#1B2E58] text-white shadow-xl scale-105' : 'bg-white text-[#1B2E58] hover:bg-gray-100'"
                class="px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all duration-300 border border-gray-100">
                {{ $filter }}
            </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
            @php
                $projets = [
                    [
                        'title' => 'Piscine Olympique Villa Horizon', 
                        'cat' => 'construction', 
                        'img' => 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?q=80&w=1200',
                        'desc' => 'Conception d\'un bassin à débordement avec système de filtration intelligent et éclairage LED intégré.'
                    ],
                    [
                        'title' => 'Complexe Résidentiel Nakayo', 
                        'cat' => 'immobilier', 
                        'img' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=1200',
                        'desc' => 'Vente et aménagement d\'une résidence de luxe sécurisée, incluant la gestion locative.'
                    ],
                    [
                        'title' => 'Unité de Savonnerie Industrielle', 
                        'cat' => 'industrie', 
                        'img' => 'https://images.unsplash.com/photo-1600857062241-98e5dba7f214?q=80&w=1200',
                        'desc' => 'Installation d\'une ligne de production artisanale automatisée pour la gamme de savons Nakayo.'
                    ],
                    [
                        'title' => 'Ferme Agro-Connectée', 
                        'cat' => 'agro', 
                        'img' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?q=80&w=1200',
                        'desc' => 'Aménagement de terres agricoles avec système d\'irrigation solaire et élevage moderne.'
                    ],
                ];
            @endphp

            @foreach($projets as $p)
            <div 
                x-show="activeFilter === 'tous' || activeFilter === '{{ $p['cat'] }}'"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="group relative bg-white rounded-[4rem] overflow-hidden shadow-sm hover:shadow-[0_40px_80px_-15px_rgba(27,46,88,0.2)] transition-all duration-700 border border-gray-100">
                
                <!-- Zone Image avec Badge Flottant -->
                <div class="h-[400px] overflow-hidden relative">
                    <img src="{{ $p['img'] }}" class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">
                    <div class="absolute top-8 left-8 bg-white/10 backdrop-blur-xl border border-white/20 text-white px-6 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">
                        {{ $p['cat'] }}
                    </div>
                </div>

                <!-- Zone Texte Luxe -->
                <div class="p-12 lg:p-16">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-px flex-1 bg-gray-100"></div>
                        <span class="text-[#FF9F29] font-black text-[10px] uppercase tracking-[4px]">Détails du Projet</span>
                        <div class="h-px flex-1 bg-gray-100"></div>
                    </div>

                    <h3 class="text-3xl font-black text-[#1B2E58] mb-6 uppercase tracking-tighter leading-none group-hover:text-[#FF9F29] transition-colors duration-500">
                        {{ $p['title'] }}
                    </h3>
                    
                    <p class="text-gray-500 mb-10 leading-relaxed italic text-lg">
                        "{{ $p['desc'] }}"
                    </p>

                    <div class="flex justify-between items-center">
                        <a href="#" class="inline-flex items-center gap-3 text-[#1B2E58] font-black text-xs uppercase tracking-widest group/link transition-all">
                            Voir le dossier complet
                            <span class="w-10 h-10 rounded-full bg-[#F8FAFC] flex items-center justify-center group-hover/link:bg-[#1B2E58] group-hover/link:text-white transition-all">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>
                        <span class="text-gray-300 text-[10px] font-bold">© 2026 Nakayo Corp</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. SECTION CTA FINALE -->
<section class="py-24 bg-[#1B2E58] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" class="w-full h-full object-cover">
    </div>
    
    <div class="max-w-4xl mx-auto text-center px-6 relative z-10">
        <h2 class="text-white text-4xl md:text-6xl font-black mb-10 uppercase tracking-tight leading-none">
            Vous avez un <span class="text-[#FF9F29]">Défi</span> pour nous ?
        </h2>
        <p class="text-blue-100 text-lg mb-12 opacity-80 max-w-2xl mx-auto">
            Nous mettons toute notre expertise technique au service de vos ambitions. Contactez-nous dès aujourd'hui pour une étude de faisabilité.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-4 bg-[#FF9F29] text-[#1B2E58] px-12 py-5 rounded-2xl font-black uppercase text-xs tracking-[3px] hover:bg-white transition-all shadow-2xl">
            Demander un devis gratuit <i class="fas fa-envelope"></i>
        </a>
    </div>
</section>

@endsection