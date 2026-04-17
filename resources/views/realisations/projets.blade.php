@extends('layouts.app')

@section('content')

    {{-- 1. HEADER (Déplacé à l'intérieur de la section pour la validité du fichier) --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
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
<section class="relative h-[550px] flex flex-col items-center justify-center text-white overflow-hidden font-sans">
    <!-- Image de fond avec l'overlay spécifique de ton exemplaire -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover">
        <!-- Overlay teinté (Multiply) pour le look professionnel sombre -->
        <div class="absolute inset-0 bg-[#0a1d21]/85 mix-blend-multiply"></div>
    </div>

    <!-- Contenu Central -->
    <div class="container mx-auto px-6 relative z-10 text-center">
        <!-- Titre Massive (font-black pour l'épaisseur maximale) -->
        <h1 class="text-6xl md:text-7xl font-black mb-6 tracking-tight leading-none uppercase">
            Nos Grands Chantiers
        </h1>

        <!-- Sous-titre aéré -->
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed mb-10 font-medium">
            De la conception à la livraison finale, découvrez comment NAKAYO transforme des visions architecturales en réalités concrètes et durables à travers le Bénin.
        </p>

        <!-- Bouton Blanc Arrondi (Look moderne comme l'exemplaire) -->
        <div class="flex justify-center">
            <a href="https://wa.me/2290166556161" target="_blank" class="bg-white text-[#0a1d21] px-10 py-4 rounded-xl font-bold flex items-center gap-3 hover:bg-[#FF9F29] hover:text-white transition shadow-lg group">
                Lancer mon projet
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Fil d'ariane (Breadcrumbs) discret en bas -->
    <div class="absolute bottom-8 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-3 text-white/40 text-[10px] font-bold uppercase tracking-[2px]">
            <a href="/" class="hover:text-white transition">Accueil</a>
            <span>/</span>
            <span class="text-white/80">Réalisations</span>
        </nav>
    </div>
</section>

<!-- 2. SECTION GRILLE DYNAMIQUE -->

<section class="py-24 bg-[#F8FAFC]" x-data="{ activeFilter: 'tous' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        
        <div class="text-center mb-16">
            <h2 class="text-[#1B2E58] text-4xl md:text-5xl font-black uppercase tracking-tighter mb-4">
                Nos Réalisations
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Découvrez l'expertise de Nakayo Corporation à travers nos projets emblématiques dans plusieurs secteurs d'activité.
            </p>
        </div>

        <!-- <div class="flex flex-wrap justify-center gap-3 mb-20">
            <button 
                @click="activeFilter = 'tous'"
                :class="activeFilter === 'tous' ? 'bg-[#1B2E58] text-white shadow-xl scale-105' : 'bg-white text-[#1B2E58] hover:bg-gray-100'"
                class="px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all duration-300 border border-gray-100">
                Tous
            </button>
            
            {{-- On boucle sur les catégories uniques présentes dans vos projets --}}
            @foreach(['construction', 'immobilier', 'agro', 'industrie'] as $filter)
            <button 
                @click="activeFilter = '{{ $filter }}'"
                :class="activeFilter === '{{ $filter }}' ? 'bg-[#1B2E58] text-white shadow-xl scale-105' : 'bg-white text-[#1B2E58] hover:bg-gray-100'"
                class="px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all duration-300 border border-gray-100">
                {{ ucfirst($filter) }}
            </button>
            @endforeach
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
            @forelse($projets as $p)
            <div 
                x-show="activeFilter === 'tous' || activeFilter === '{{ $p->cat_slug }}'"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="group relative bg-white rounded-[4rem] overflow-hidden shadow-sm hover:shadow-[0_40px_80px_-15px_rgba(27,46,88,0.2)] transition-all duration-700 border border-gray-100">
                
                <div class="h-[400px] overflow-hidden relative">
                    <img src="{{ url('storage/' . $p->image) }}" 
                         alt="{{ $p->nom }}"
                         class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">
                    
                    <div class="absolute top-8 left-8 bg-white/10 backdrop-blur-xl border border-white/20 text-white px-6 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">
                        {{ $p->service_nom }}
                    </div>
                </div>

                <div class="p-12 lg:p-16">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="h-px flex-1 bg-gray-100"></div>
                        <span class="text-[#FF9F29] font-black text-[10px] uppercase tracking-[4px]">
                            {{ $p->lieu ?? 'Projet Réalisé' }}
                        </span>
                        <div class="h-px flex-1 bg-gray-100"></div>
                    </div>

                    <h3 class="text-3xl font-black text-[#1B2E58] mb-6 uppercase tracking-tighter leading-none group-hover:text-[#FF9F29] transition-colors duration-500">
                        <a href="{{ route('projets.show', $p->id_projet) }}">
                            {{ $p->nom }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 mb-10 leading-relaxed italic text-lg line-clamp-3">
                        "{{ $p->description }}"
                    </p>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('projets.show', $p->id_projet) }}" 
                           class="inline-flex items-center gap-3 text-[#1B2E58] font-black text-xs uppercase tracking-widest group/link transition-all">
                            Voir le dossier complet
                            <span class="w-10 h-10 rounded-full bg-[#F8FAFC] flex items-center justify-center group-hover/link:bg-[#1B2E58] group-hover/link:text-white transition-all">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>
                        
                        <span class="text-gray-300 text-[10px] font-bold">
                            {{ $p->date_realisation ? \Carbon\Carbon::parse($p->date_realisation)->format('Y') : '2026' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="mb-4 text-6xl">📁</div>
                <p class="text-gray-400 font-bold uppercase tracking-widest">Aucun projet publié pour le moment.</p>
            </div>
            @endforelse
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