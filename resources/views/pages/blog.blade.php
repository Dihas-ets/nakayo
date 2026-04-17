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
   


<div class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-[#1B2E58] text-3xl md:text-4xl font-black mb-4 uppercase tracking-tight">Actualités</h2>
            <div class="w-20 h-1.5 bg-[#FFB75E] rounded-full"></div>
        </div>
    </div>

    {{-- 1. ARTICLE MIS EN AVANT (FEATURED) --}}
    @if(isset($featuredArticle))
        <article class="relative flex flex-col lg:flex-row bg-[#1B2E58] rounded-[40px] overflow-hidden shadow-2xl group mb-16">
            <div class="lg:w-1/2 h-[300px] lg:h-[500px] overflow-hidden">
                <img src="{{ url('storage/' . $featuredArticle->media) }}" 
                     alt="{{ $featuredArticle->titre }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80">
            </div>

            <div class="lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center">
                <div class="flex items-center gap-4 mb-6">
                    <span class="bg-[#FFB75E] text-white px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">À LA UNE</span>
                    <span class="text-white/60 text-[10px] font-black uppercase tracking-widest">{{ $featuredArticle->category_name }}</span>
                </div>

                <h3 class="text-white text-3xl lg:text-5xl font-black leading-tight mb-6">
                    {{ $featuredArticle->titre }}
                </h3>

                <div class="text-white/70 text-lg mb-8 line-clamp-3">
                    {!! Str::limit(strip_tags($featuredArticle->description), 150) !!}
                </div>

                <div class="flex items-center gap-6 mb-10 text-white/50">
                    <div class="flex items-center gap-2"><span>👁️</span> <span class="text-xs font-bold">{{ $featuredArticle->vue }}</span></div>
                    <div class="flex items-center gap-2"><span>❤️</span> <span class="text-xs font-bold">{{ $featuredArticle->likes }}</span></div>
                </div>

                {{-- Lien vers le détail via slug ou id --}}
                <a href="{{ route('blog.show', $featuredArticle->slug ?? $featuredArticle->id) }}" 
                   class="inline-flex items-center justify-center bg-white text-[#1B2E58] w-fit px-8 py-4 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-[#FFB75E] hover:text-white transition-all shadow-xl">
                    Lire l'article complet
                </a>
            </div>
        </article>
    @endif

    {{-- 2. LISTE DES AUTRES ARTICLES --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($otherArticles as $article)
            <a href="{{ route('blog.show', $article->slug ?? $article->id) }}" class="group block">
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ url('storage/' . $article->media) }}" 
                             alt="{{ $article->titre }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <span class="text-[#FFB75E] text-[10px] font-black uppercase tracking-widest">{{ $article->category_name }}</span>
                        <h4 class="text-[#1B2E58] text-xl font-bold mt-2 mb-4 group-hover:text-[#FFB75E] transition-colors">
                            {{ $article->titre }}
                        </h4>
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {!! Str::limit(strip_tags($article->description), 80) !!}
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-gray-500 italic">Aucun autre article disponible pour le moment.</p>
        @endforelse
    </div>
</div>

@endsection