@extends('layouts.app')

@section('title', 'Recrutement')

@section('content')

{{-- 1. NAVBAR --}}
@if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
    <header class="sticky top-0 z-[100] w-full shadow-md bg-white">
        @include('components.navbar')
    </header>
@endif

{{-- 2. HERO SECTION --}}
<section class="relative h-[550px] flex flex-col items-center justify-center text-white overflow-hidden">
    <!-- Image de fond avec l'overlay spécifique -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1920" 
             alt="Background" 
             class="w-full h-full object-cover">
        <!-- Overlay teinté (Multiply) pour le look professionnel sombre -->
        <div class="absolute inset-0 bg-[#0a1d21]/85 mix-blend-multiply"></div>
    </div>

    <!-- Contenu Central -->
    <div class="container mx-auto px-6 relative z-10 text-center">
        <!-- Titre Massive (font-black) -->
        <h1 class="text-6xl md:text-7xl font-black mb-6 tracking-tight leading-none uppercase">
            Rejoignez <br> l'Aventure
        </h1>

        <!-- Sous-titre aéré -->
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed mb-10 font-medium">
            Donnez du sens à votre carrière en contribuant à l'inclusion financière au Bénin et en intégrant une équipe passionnée.
        </p>

        <!-- Bouton Blanc Arrondi -->
        <div class="flex justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-[#0a1d21] px-10 py-4 rounded-xl font-bold flex items-center gap-3 hover:bg-gray-100 transition shadow-lg group">
                Nous Contactez
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Fil d'ariane (Breadcrumbs) : Positionné strictement en bas au centre -->
    <div class="absolute bottom-10 w-full text-center z-10">
        <nav class="flex justify-center items-center gap-2 text-sm font-medium text-gray-300">
            <a href="/" class="hover:text-white transition">Accueil</a>
            <span class="text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white">Recrutement</span>
        </nav>
    </div>
</section>




{{-- 4. LISTE DES OFFRES --}}
<section class="py-24 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black uppercase">Offres de recrutement</h2>
            <div class="w-16 h-1 bg-orange-400 mx-auto mt-4"></div>
        </div>

        <div class="space-y-4">
            @forelse($offres as $offre)
                <div class="group bg-white border border-gray-100 p-6 md:px-10 rounded-3xl flex flex-col md:flex-row md:items-center justify-between hover:shadow-2xl transition-all duration-300">
                    <div class="flex flex-col">
                        <span class="text-orange-500 text-[10px] font-bold uppercase tracking-widest mb-1">
                            {{ $offre->agence ?? 'Recrutement' }}
                        </span>
                        
                        <h3 class="text-[#1B2E58] text-xl font-extrabold group-hover:text-blue-600 transition-colors">
                            {{ $offre->nom }}
                        </h3>
                        
                        <div class="flex flex-wrap items-center gap-4 text-gray-400 text-sm mt-2">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $offre->lieu }}</span>
                            <span><i class="fas fa-clock"></i> {{ $offre->type }}</span>
                            <span class="text-red-400 font-semibold">
                                <i class="fas fa-calendar-alt"></i> Limite : {{ \Carbon\Carbon::parse($offre->date_limite)->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Remplacez l'ancien bouton par celui-ci --}}
                    <a href="{{ route('recrutement.show', $offre->id_recrutement) }}" 
                    class="mt-6 md:mt-0 bg-[#1B2E58] text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-orange-400 transition-all shadow-lg text-center">
                        Consulter & Postuler
                    </a>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-gray-500 italic">Aucune offre disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection