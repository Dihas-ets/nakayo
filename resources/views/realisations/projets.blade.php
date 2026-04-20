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

<section class="py-8 bg-[#F8FAFC]" x-data="{ activeFilter: 'tous' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- En-tête encore plus compact -->
        <div class="text-center mb-6">
            <h2 class="text-[#1B2E58] text-2xl md:text-3xl font-black uppercase tracking-tighter mb-1">
                Nos Réalisations
            </h2>
            <div class="h-1 w-12 bg-[#FF9F29] mx-auto mb-2 rounded-full"></div>
        </div>

        <!-- Grille -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($projets as $p)
            <div 
                x-show="activeFilter === 'tous' || activeFilter === '{{ $p->cat_slug }}'"
                class="group relative bg-white rounded-[1.5rem] overflow-hidden shadow-sm hover:shadow-md transition-all duration-500 border border-gray-100 flex flex-col">
                
                <!-- Image : Hauteur réduite de h-56 à h-40 -->
                <div class="h-40 overflow-hidden relative">
                    <img src="{{ url('storage/' . $p->image) }}" 
                         alt="{{ $p->nom }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute top-3 left-3 bg-[#1B2E58]/90 backdrop-blur-md text-white px-2 py-0.5 rounded-full text-[7px] font-black uppercase tracking-widest">
                        {{ $p->service_nom }}
                    </div>
                </div>

                <!-- Contenu : Padding réduit de p-6 à p-4 -->
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[#FF9F29] font-black text-[8px] uppercase tracking-widest">
                            {{ $p->lieu ?? 'Bénin' }}
                        </span>
                        <div class="h-px flex-1 bg-gray-50"></div>
                    </div>

                    <!-- Titre : Marge réduite -->
                    <h3 class="text-base font-black text-[#1B2E58] mb-1 uppercase tracking-tighter leading-tight group-hover:text-[#FF9F29] transition-colors line-clamp-1">
                        <a href="{{ route('projets.show', $p->id_projet) }}">
                            {{ $p->nom }}
                        </a>
                    </h3>
                    
                    <!-- Description : Passage à 2 lignes maximum (line-clamp-2) et réduction marge -->
                    <p class="text-gray-500 mb-4 leading-snug text-[11px] line-clamp-2 italic">
                        "{{ $p->description }}"
                    </p>

                    <!-- Footer de carte compact -->
                    <div class="mt-auto flex justify-between items-center pt-2 border-t border-gray-50">
                        <a href="{{ route('projets.show', $p->id_projet) }}" 
                           class="inline-flex items-center gap-2 text-[#1B2E58] font-black text-[8px] uppercase tracking-widest group/link">
                            Détails
                            <i class="fas fa-arrow-right text-[7px] group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <span class="text-gray-300 text-[8px] font-bold">
                            {{ $p->date_realisation ? \Carbon\Carbon::parse($p->date_realisation)->format('Y') : '2026' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Aucun projet disponible.</p>
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
        <h2 class="text-white text-3xl md:text-4xl font-black mb-10 uppercase tracking-tight leading-none">
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