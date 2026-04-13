@extends('layouts.app')

@section('content')

    {{-- 1. HEADER (Déplacé à l'intérieur de la section pour la validité du fichier) --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full shadow-md">
            @include('components.navbar')
        </header>
    @endif

    {{-- 2. SECTION HERO --}}
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
                <!-- Titre Massive (font-black pour l'épaisseur maximale) -->
        <h1 class="text-6xl md:text-7xl font-black mb-6 tracking-tight leading-none">
            Nos Dernières Actualités
        </h1>

        <!-- Sous-titre aéré -->
        <p class="text-lg md:text-xl max-w-3xl mx-auto text-gray-200 leading-relaxed mb-10 font-medium">
            Découvrez l'histoire, la mission et les valeurs qui font de NAKAYO un leader dans les services 
        </p>

        <!-- Bouton Blanc Arrondi (Look moderne) -->
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
            <!-- Icone Chevron -->
            <span class="text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            <span class="text-white">Blog</span>
        </nav>
    </div>
</section>

    {{-- 3. GRILLE DES ARTICLES --}}
    <section class="py-16 md:py-24 bg-[#F8FAFC] font-sans">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <!-- En-tête -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black mb-4 uppercase tracking-tight">Actualités</h2>
                <div class="w-20 h-1.5 bg-[#FFB75E] rounded-full"></div>
            </div>
        </div>

        {{-- 1. ARTICLE MIS EN AVANT (FEATURED) --}}
        @php
            // Simulation : On imagine que le premier article est FEATURED
            $featuredArticle = [
                'title' => "Comment obtenir un crédit commerce : 5 étapes simples",
                'category' => "Financement",
                'status' => "Publié",
                'views' => "2.5k",
                'likes' => "850",
                'comments' => "24",
                'description' => "Découvrez les conditions d'éligibilité et les documents nécessaires pour financer votre activité commerciale sans tracas. Un guide complet pour les entrepreneurs.",
                'image' => "https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1200",
                'tag' => "#CREDIT",
                'slug' => "credit-commerce-etapes"
            ];
        @endphp

        <div class="mb-12">
            <article class="relative flex flex-col lg:flex-row bg-[#1B2E58] rounded-[40px] overflow-hidden shadow-2xl group">
                <!-- Image Featured -->
                <div class="lg:w-1/2 h-[300px] lg:h-[500px] overflow-hidden">
                    <img src="{{ $featuredArticle['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80" alt="">
                </div>
                <!-- Contenu Featured -->
                <div class="lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="bg-[#FFB75E] text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">À LA UNE</span>
                        <span class="text-white/60 text-[10px] font-black uppercase tracking-widest">{{ $featuredArticle['category'] }}</span>
                    </div>
                    <h3 class="text-white text-3xl lg:text-5xl font-black leading-tight mb-6">
                        {{ $featuredArticle['title'] }}
                    </h3>
                    <p class="text-white/70 text-lg mb-8 line-clamp-3">
                        {{ $featuredArticle['description'] }}
                    </p>
                    <div class="flex items-center gap-6 mb-10 text-white/50">
                        <div class="flex items-center gap-2"><span>👁️</span> <span class="text-xs font-bold">{{ $featuredArticle['views'] }}</span></div>
                        <div class="flex items-center gap-2"><span>❤️</span> <span class="text-xs font-bold">{{ $featuredArticle['likes'] }}</span></div>
                        <div class="flex items-center gap-2"><span>💬</span> <span class="text-xs font-bold">{{ $featuredArticle['comments'] }}</span></div>
                    </div>
                    <a href="{{ route('blog.show', $featuredArticle['slug']) }}" class="inline-flex items-center justify-center bg-white text-[#1B2E58] w-fit px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#FFB75E] hover:text-white transition-all shadow-xl">
                        Lire l'article complet
                    </a>
                </div>
            </article>
        </div>

        {{-- 2. GRILLE DES AUTRES ARTICLES --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for ($i = 2; $i <= 7; $i++)
            <article class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100">
                <!-- ZONE IMAGE -->
                <div class="relative overflow-hidden aspect-[16/10]">
                    <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=800" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors"></div>

                    <!-- BADGES HAUT (Catégorie + Statut) -->
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <div class="flex flex-col gap-2">
                            <span class="bg-white/90 backdrop-blur-md text-[#1B2E58] px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider">
                                Financement
                            </span>
                            <div class="flex items-center gap-2 bg-[#1B2E58]/50 backdrop-blur-md px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                <span class="text-[9px] font-bold text-white uppercase tracking-widest">Publié</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTENU -->
                <div class="p-8 flex-1 flex flex-col">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">24 Nov 2025</span>
                    <h3 class="text-[#1B2E58] text-xl font-black leading-tight mb-4 group-hover:text-[#FFB75E] transition-colors line-clamp-2">
                        Titre de l'actualité numéro {{ $i }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
                        Découvrez comment nous accompagnons les entrepreneurs dans la concrétisation de leurs projets.
                    </p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="text-[9px] font-bold bg-slate-100 text-slate-500 px-2 py-1 rounded">#CREDIT</span>
                    </div>

                    <!-- STATS ET LIEN -->
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-3 text-gray-400">
                            <span class="text-[10px] font-bold">👁️ 1.2k</span>
                            <span class="text-[10px] font-bold">❤️ 45</span>
                        </div>
                        <!-- LIEN LIRE -->
                        <a href="{{ route('blog.show', 'slug-article-'.$i) }}" class="flex items-center gap-2 text-[#1B2E58] font-black uppercase text-[10px] tracking-widest hover:text-[#FFB75E] transition-colors">
                            Lire plus <span>↗</span>
                        </a>
                    </div>
                </div>
            </article>
            @endfor
        </div>
    </div>
</section>

@endsection {{-- TRÈS IMPORTANT : Ne pas oublier d'ouvrir et fermer la section --}}