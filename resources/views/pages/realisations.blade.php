@extends('layouts.app')

@section('title', 'Réalisations')

@section('content')

{{-- 1. NAVBAR (Optionnelle si déjà dans layout) --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-sm bg-white">
        @include('components.navbar')
    </header>
@endif

{{-- 2. HERO SECTION : PLUS COMPACTE ET CLAIRE --}}
<section class="relative h-[550px] flex flex-col items-center justify-center text-white overflow-hidden">
    <!-- Image de fond avec l'overlay spécifique -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1920" 
             alt="Réalisations" 
             class="w-full h-full object-cover">
        <!-- Overlay teinté (Multiply) pour le look professionnel sombre -->
        <div class="absolute inset-0 bg-[#0a1d21]/85 mix-blend-multiply"></div>
    </div>

    <!-- Contenu Central -->
    <div class="container mx-auto px-6 relative z-10 text-center">
        <!-- Titre Massive (font-black) -->
        <h1 class="text-5xl md:text-7xl font-black mb-6 tracking-tight leading-tight">
            L'impact de nos <br> <span class="text-white">Financements</span>
        </h1>

        <!-- Sous-titre aéré -->
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed mb-10 font-medium">
            Découvrez comment nous accompagnons les entrepreneurs béninois dans la concrétisation de leurs projets à travers tout le territoire.
        </p>

        <!-- Bouton Blanc Arrondi -->
        <div class="flex justify-center">
            <a href="#" class="bg-white text-[#0a1d21] px-10 py-4 rounded-xl font-bold flex items-center gap-3 hover:bg-gray-100 transition shadow-lg group">
                Nous Contactez
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Fil d'ariane (Breadcrumbs) : En bas au centre -->
    <div class="absolute bottom-10 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-2 text-sm font-medium text-gray-300">
            <a href="/" class="hover:text-white transition">Accueil</a>
            <span class="text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white font-semibold">Réalisations</span>
        </nav>
    </div>
</section><br><br><br>

{{-- 3. SECTION CHIFFRES CLÉS : STYLE MINIMALISTE --}}
<!-- SECTION : IMPACT & STATISTIQUES (4 CARTES) -->
<section class="relative z-20 -mt-10 md:-mt-14 font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            
            @php
                $stats = [
                    [
                        'icon' => 'fa-check-circle', 
                        'num' => '15 000+', 
                        'label' => 'Projets financés',
                        'bg_icon' => 'bg-blue-50',
                        'text_icon' => 'text-[#1B2E58]'
                    ],
                    [
                        'icon' => 'fa-users', 
                        'num' => '85%', 
                        'label' => 'Taux de satisfaction',
                        'bg_icon' => 'bg-orange-50',
                        'text_icon' => 'text-orange-500'
                    ],
                    [
                        'icon' => 'fa-map-marker-alt', 
                        'num' => '17', 
                        'label' => 'Agences au Bénin',
                        'bg_icon' => 'bg-green-50',
                        'text_icon' => 'text-green-600'
                    ],
                    [
                        'icon' => 'fa-calendar-check', 
                        'num' => '12 ans', 
                        'label' => "D'accompagnement",
                        'bg_icon' => 'bg-red-50',
                        'text_icon' => 'text-red-500'
                    ]
                ];
            @endphp

            @foreach($stats as $stat)
            <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-xl shadow-blue-900/5 border-b-4 border-[#FFB75E] flex flex-col items-center text-center transform hover:-translate-y-2 transition-all duration-300 group">
                <!-- Icône avec cercle de couleur -->
                <div class="w-14 h-14 rounded-2xl {{ $stat['bg_icon'] }} flex items-center justify-center {{ $stat['text_icon'] }} mb-5 group-hover:bg-[#1B2E58] group-hover:text-white transition-colors duration-300">
                    <i class="fas {{ $stat['icon'] }} text-2xl"></i>
                </div>
                
                <!-- Chiffre -->
                <span class="text-3xl font-black text-[#1B2E58] tracking-tight">
                    {{ $stat['num'] }}
                </span>
                
                <!-- Label (Petit texte en haut) -->
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-[2px] mt-2 leading-tight">
                    {{ $stat['label'] }}
                </p>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- 4. GRILLE DES RÉALISATIONS : STYLE "PORTFOLIO PRO" --}}
<section class="py-20 bg-white" x-data="{ filter: 'all' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div>
                <h2 class="text-[#1B2E58] text-3xl font-black uppercase mb-2">Success Stories</h2>
                <div class="w-16 h-1 bg-[#FFB75E]"></div>
            </div>
            
            <!-- Filtres Minimalistes -->
            <div class="flex flex-wrap gap-2">
                @foreach(['all' => 'Tous', 'agri' => 'Agriculture', 'comm' => 'Commerce', 'ind' => 'Industrie'] as $val => $label)
                <button @click="filter = '{{ $val }}'" 
                        :class="filter === '{{ $val }}' ? 'bg-[#1B2E58] text-white shadow-lg' : 'bg-gray-50 text-gray-400 hover:bg-gray-100'" 
                        class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <!-- Exemple de Carte (Agriculture) -->
            <div x-show="filter === 'all' || filter === 'agri'" class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1595841696677-6489ff3f8cd1?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Agriculture">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-[#1B2E58] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm">Agriculture</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-[#1B2E58] text-xl font-bold mb-3 leading-tight">Soutien à la filière Ananas d'Allada</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Accompagnement de 50 coopératives locales pour la modernisation des systèmes d'irrigation et l'exportation.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#FFB75E] font-bold text-xs uppercase tracking-widest hover:gap-4 transition-all">
                        Lire le témoignage <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Exemple de Carte (Commerce) -->
            <div x-show="filter === 'all' || filter === 'comm'" class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Commerce">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-[#1B2E58] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm">Commerce</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-[#1B2E58] text-xl font-bold mb-3 leading-tight">Modernisation TPE Textile Cotonou</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Financement de l'acquisition de nouveaux métiers à tisser pour une production artisanale de haute qualité.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#FFB75E] font-bold text-xs uppercase tracking-widest hover:gap-4 transition-all">
                        Lire le témoignage <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Exemple de Carte (Industrie) -->
            <div x-show="filter === 'all' || filter === 'ind'" class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Industrie">
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-[#1B2E58] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm">Industrie</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-[#1B2E58] text-xl font-bold mb-3 leading-tight">Transformation Agro-alimentaire</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Financement d'une unité de transformation de noix de cajou, créant plus de 30 emplois locaux directs.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#FFB75E] font-bold text-xs uppercase tracking-widest hover:gap-4 transition-all">
                        Lire le témoignage <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 5. SECTION APPEL À L'ACTION (CTA) --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <div class="bg-white p-12 rounded-[3rem] shadow-xl border border-gray-100">
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black mb-6">Prêt à développer <br> votre activité ?</h2>
            <p class="text-gray-500 text-lg mb-10">Rejoignez les milliers d'entrepreneurs qui nous font confiance pour bâtir l'avenir du Bénin.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-[#1B2E58] text-white px-10 py-4 rounded-2xl font-bold hover:bg-[#FFB75E] transition-all shadow-lg shadow-blue-900/20">
                    Demander un financement
                </a>
                <a href="#" class="bg-white border-2 border-gray-100 text-[#1B2E58] px-10 py-4 rounded-2xl font-bold hover:bg-gray-50 transition-all">
                    Nos produits
                </a>
            </div>
        </div>
    </div>
</section>

@endsection