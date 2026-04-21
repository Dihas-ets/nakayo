@extends('layouts.app')

@section('title', 'Articles')

@section('content')

    {{-- 1. TON MENU EXISTANT --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
            @include('components.navbar')
        </header>
    @endif

    {{-- 2. HERO SECTION : DROITE & CINÉMATIQUE --}}
    <section class="relative h-[450px] md:h-[550px] flex items-center">
        <!-- Image de fond (Droit, sans rotation) -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070" 
                 class="w-full h-full object-cover" alt="Hero Background">
            <!-- Overlay sombre Nakayo -->
            <div class="absolute inset-0 bg-[#1B2E58]/80"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full text-center md:text-left">
            <div class="max-w-3xl">
                <!-- <div class="inline-flex items-center gap-3 bg-[#FFB75E] text-white px-4 py-1.5 rounded-full mb-6">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">Insights & Actualités</span>
                </div> -->
                <h1 class="text-white text-5xl md:text-7xl font-black leading-tight tracking-tighter mb-6">
                    Propulsez votre vision <br> avec <span class="text-[#FF9F29]">Nakayo.</span>
                </h1>
                <p class="text-gray-300 text-lg md:text-xl font-medium max-w-xl mb-10 leading-relaxed">
                    Analyses stratégiques, innovations technologiques et conseils d'experts pour transformer vos idées en succès.
                </p>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="#featured" class="bg-[#FF9F29] text-white px-10 py-4 rounded-xl font-black uppercase text-xs tracking-widest hover:scale-105 transition-all shadow-xl">
                        Explorer le Blog
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. SECTION PRINCIPALE --}}
    <main id="featured" class="max-w-7xl mx-auto px-6 py-20">
    
    <!-- SECTION 1 : TITRE DE LA PAGE -->
    <div class="flex items-center gap-4 mb-10">
        <h2 class="text-[#1B2E58] font-black text-3xl uppercase tracking-tighter ">L'Essentiel Nakayo</h2>
        <div class="flex-1 h-[2px] bg-gray-100"></div>
    </div>

    <!-- SECTION 2 : ARTICLE VEDETTE + TENDANCES -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-28">
        
        <!-- GAUCHE : L'ARTICLE VEDETTE (Le plus récent coché 'featured') -->
        <div class="lg:col-span-8">
            @if($featuredArticle)
                <div class="relative h-[550px] rounded-[30px] overflow-hidden group shadow-2xl">
                    <img src="{{ url('storage/' . $featuredArticle->media) }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" 
                         alt="{{ $featuredArticle->titre }}">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1B2E58] via-transparent to-transparent opacity-95"></div>
                    
                    <div class="absolute bottom-0 p-12">
                        <span class="bg-white/10 backdrop-blur-md text-[#FFB75E] px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest mb-4 inline-block border border-white/20">
                            Article Vedette
                        </span>
                        <h2 class="text-white text-3xl md:text-5xl font-black leading-tight mb-8">
                            {{ $featuredArticle->titre }}
                        </h2>
                        <a href="{{ route('blog.show', $featuredArticle->slug) }}" 
                           class="bg-[#FF9F29] text-white px-8 py-3.5 rounded-xl font-bold inline-flex items-center gap-3 hover:bg-white hover:text-[#1B2E58] transition-all">
                            Lire la suite
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="h-[550px] rounded-[30px] bg-gray-100 flex items-center justify-center">
                    <p class="text-gray-400">Aucun article vedette pour le moment.</p>
                </div>
            @endif
        </div>

        <!-- DROITE : TENDANCES (Les 5 derniers articles après le vedette) -->
        <div class="lg:col-span-4">
            <h3 class="text-[#1B2E58] font-black text-xl mb-8">Tendances du moment</h3>
            <div class="space-y-8">
                @forelse($trendingArticles as $sideArticle)
                    <a href="{{ route('blog.show', $sideArticle->slug) }}" class="flex gap-5 group items-center">
                        <div class="w-24 h-20 flex-shrink-0 rounded-2xl overflow-hidden shadow-md">
                            <img src="{{ url('storage/' . $sideArticle->media) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[#1B2E58] font-bold text-sm leading-tight group-hover:text-[#FFB75E] transition line-clamp-2">
                                {{ $sideArticle->titre }}
                            </h4>
                            <span class="text-gray-400 text-[10px] font-black uppercase mt-2 block tracking-widest">
                                {{ $sideArticle->category_name ?? 'Inspiration' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-400 text-sm">Pas d'autres articles récents.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- SECTION 3 : AUTRES ARTICLES (Le reste des archives) -->
    <div class="flex items-center gap-4 mb-16">
        <h2 class="text-[#1B2E58] text-3xl font-black tracking-tighter">Parcourir les archives</h2>
        <div class="flex-1 h-[1px] bg-gray-100"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @forelse($otherArticles as $article)
            <article class="group">
                <!-- Image de la carte -->
                <div class="rounded-[30px] overflow-hidden mb-8 shadow-xl h-72 border border-gray-100 relative">
                    <img src="{{ url('storage/' . $article->media) }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         alt="{{ $article->titre }}">
                </div>

                <!-- Contenu de la carte -->
                <div class="px-2">
                    <h3 class="text-[#1B2E58] text-2xl font-black leading-tight mb-4 group-hover:text-[#FF9F29] transition">
                        <a href="{{ route('blog.show', $article->slug) }}">
                            {{ $article->titre }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 font-medium text-sm leading-relaxed mb-8 line-clamp-2">
                        {{ Str::limit(strip_tags($article->description), 120) }}
                    </p>
                    
                    <!-- Pied de carte : Auteur et Infos -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#1B2E58] flex items-center justify-center text-white text-[10px] font-black border-2 border-[#FF9F29]">
                                {{ strtoupper(substr($article->user->name ?? 'NK', 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-xs font-black text-[#1B2E58]">{{ $article->user->name ?? 'Équipe Nakayo' }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                    {{ $article->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">{{ $article->vue ?? 0 }} vues</span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-20 bg-gray-50 rounded-[30px] border-2 border-dashed border-gray-200">
                <p class="text-[#1B2E58] font-bold italic">Notre bibliothèque d'articles s'agrandit, revenez bientôt !</p>
            </div>
        @endforelse
    </div>
</main>

@endsection