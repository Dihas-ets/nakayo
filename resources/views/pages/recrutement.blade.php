@extends('layouts.app')

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
        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=1920" 
             alt="Recrutement Access Finance" 
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
            <a href="#" class="bg-white text-[#0a1d21] px-10 py-4 rounded-xl font-bold flex items-center gap-3 hover:bg-gray-100 transition shadow-lg group">
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
</section><br><br><br><br><br>


{{-- 3. SECTION STATS (INTÉGRÉE DIRECTEMENT - PAS DE X-STATS-IMPACT) --}}
<section class="relative z-20 -mt-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            
            <!-- Carte 1 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border-b-4 border-orange-400 flex flex-col items-center text-center hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-[#1B2E58] mb-4 group-hover:bg-[#1B2E58] group-hover:text-white transition-colors">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <span class="text-2xl font-black text-[#1B2E58]">150+</span>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Collaborateurs</p>
            </div>

            <!-- Carte 2 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border-b-4 border-orange-400 flex flex-col items-center text-center hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 mb-4 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i class="fas fa-venus text-xl"></i>
                </div>
                <span class="text-2xl font-black text-[#1B2E58]">45%</span>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Femmes Managers</p>
            </div>

            <!-- Carte 3 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border-b-4 border-orange-400 flex flex-col items-center text-center hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <span class="text-2xl font-black text-[#1B2E58]">1200h</span>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Formation / an</p>
            </div>

            <!-- Carte 4 -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border-b-4 border-orange-400 flex flex-col items-center text-center hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-500 mb-4 group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <span class="text-2xl font-black text-[#1B2E58]">92%</span>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Promotion Interne</p>
            </div>

        </div>
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
            <!-- Exemple Job -->
            <div class="group bg-white border border-gray-100 p-6 md:px-10 rounded-3xl flex flex-col md:flex-row md:items-center justify-between hover:shadow-2xl transition-all duration-300">
                <div class="flex flex-col">
                    <span class="text-orange-500 text-[10px] font-bold uppercase tracking-widest mb-1">Opérations</span>
                    <h3 class="text-[#1B2E58] text-xl font-extrabold group-hover:text-blue-600 transition-colors">Gestionnaire de Portefeuille</h3>
                    <div class="flex items-center gap-4 text-gray-400 text-sm mt-2">
                        <span><i class="fas fa-map-marker-alt"></i> Cotonou</span>
                        <span><i class="fas fa-clock"></i> CDI</span>
                    </div>
                </div>
                <a href="mailto:recrutement@accessfinance.bj" class="mt-6 md:mt-0 bg-[#1B2E58] text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-orange-400 transition-all shadow-lg text-center">
                    Postuler
                </a>
            </div>
        </div>
    </div>
</section>

@endsection