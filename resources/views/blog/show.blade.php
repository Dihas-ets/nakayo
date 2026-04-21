@extends('layouts.app')

@section('title', $article->titre)

@section('content')

    {{-- MENU EXISTANT --}}
    @if(!Route::is('login', 'register', 'admin.dashboard', 'abonner.dashboard'))
        <header class="sticky top-0 z-[100] w-full bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
            @include('components.navbar')
        </header>
    @endif

<div class="bg-[#F3F4F6]/30 min-h-screen">

    {{-- 1. BREADCRUMBS HERO --}}
    <section class="relative h-64 flex items-center justify-center overflow-hidden">
        <img src="{{ asset('storage/' . $article->media) }}" class="absolute inset-0 w-full h-full object-cover blur-md opacity-30" alt="">
        <div class="absolute inset-0 bg-[#1B2E58]/70"></div>
        <div class="relative z-10 text-center">
            <nav class="text-white/80 text-sm font-bold tracking-widest uppercase flex items-center justify-center gap-3">
                <a href="/" class="hover:text-[#FF9F29] transition">Accueil</a> 
                <span class="text-[#FF9F29]">/</span> 
                <a href="{{ route('blog.index') }}" class="hover:text-[#FF9F29] transition">Blog</a> 
                <span class="text-[#FF9F29]">/</span> 
                <span class="text-white">{{ Str::limit($article->titre, 40) }}</span>
            </nav>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 -mt-20 relative z-20 pb-20">
        
        {{-- 2. EN-TÊTE DE L'ARTICLE (Style Travel Time) --}}
        <div class="bg-white rounded-t-[2.5rem] p-8 md:p-12 shadow-sm border-b border-gray-100">
            <div class="flex flex-wrap items-center justify-between gap-6 mb-10">
                <div class="flex items-center gap-4">
                    <!-- Photo de profil ou Initiales -->
                    <div class="w-14 h-14 rounded-full bg-[#1B2E58] flex items-center justify-center text-white font-black border-2 border-[#FF9F29] overflow-hidden">
                        @if($article->user && $article->user->profile_photo_path)
                            {{-- Si l'utilisateur a une photo --}}
                            <img src="{{ asset('storage/' . $article->user->profile_photo_path) }}" alt="Profil" class="w-full h-full object-cover">
                        @else
                            {{-- Sinon on affiche ses initiales (ex: AB) --}}
                            {{ strtoupper(substr($article->user->name ?? 'NK', 0, 2)) }}
                        @endif
                    </div>

    <div>
        <div class="flex items-center gap-3 text-sm font-bold text-[#1B2E58]">
            {{-- Nom de l'utilisateur --}}
            <span class="text-gray-500">Par {{ $article->user->name ?? 'L\'Équipe Nakayo' }}</span>
        </div>
        
        {{-- Tu peux afficher le rôle de l'utilisateur s'il y a une colonne 'role' dans ta table users --}}
        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-1">
            {{ $article->user->role ?? 'Expertise & Conseil' }}
        </p>
    </div>
</div>
                
                <div class="flex items-center gap-4">
                    <!-- Like Dynamique -->
                    @if(session()->has('liked_article_' . $article->id_article))
                        <!-- Bouton grisé ou différent si déjà liké -->
                        <button class="flex items-center gap-2 text-blue-600 font-bold opacity-50 cursor-not-allowed" disabled>
                            <i class="fas fa-thumbs-up"></i> {{ $article->likes }} J'aime
                        </button>
                    @else
                        <!-- Bouton cliquable -->
                        <form action="{{ route('blog.like', $article->id_article) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition font-bold">
                                <i class="far fa-thumbs-up"></i> {{ $article->likes }} J'aime
                            </button>
                        </form>
                    @endif
                    <div class="flex items-center gap-2 px-6 py-3 bg-gray-50 rounded-full text-gray-400">
                        <span class="flex items-center gap-1">
                            👁️ {{ $article->vue }} vues
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-[#1B2E58] leading-[1.1] mb-6">
                        {{ $article->titre }}
                    </h1>
                    <div class="flex items-center gap-3">
                        <div class="h-1 w-12 bg-[#FF9F29]"></div>
                        <span class="text-[#FF9F29] font-black uppercase text-xs tracking-widest">
                            {{ $article->categorie->nom ?? 'Innovation' }}
                        </span>
                    </div>
                </div>
                <div class="text-gray-400 font-medium leading-relaxed italic border-l-4 border-gray-100 pl-6">
                    {{ Str::limit(strip_tags($article->description), 250) }}
                </div>
            </div>
        </div>

        {{-- 3. IMAGE PRINCIPALE --}}
        <div class="bg-white px-8 pb-12">
            <img src="{{ asset('storage/' . $article->media) }}" class="w-full h-[550px] object-cover rounded-[2.5rem] shadow-2xl" alt="{{ $article->titre }}">
        </div>

        {{-- 4. CORPS DE L'ARTICLE --}}
        <div class="bg-white p-8 md:p-12 rounded-b-[2.5rem] shadow-sm mb-20">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-4 mb-12 text-gray-400 text-xs font-black uppercase tracking-widest border-b pb-6">
                    <span class="text-[#1B2E58]">Date de publication :</span>
                    <span>{{ \Carbon\Carbon::parse($article->created_at)->locale('fr')->translatedFormat('d F Y') }}</span>
                    @if($article->tag)
                        <span class="text-gray-200">|</span>
                        <span class="text-[#FF9F29]">#{{ $article->tag }}</span>
                    @endif
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 leading-[1.9] mb-20">
                    {!! $article->description !!}
                </div>

                <!-- SECTION COMMENTAIRES -->
                <div class="pt-20 border-t border-gray-100">
                    <h3 class="text-[#1B2E58] font-black text-3xl mb-10 flex items-center gap-4">
                        Avis des lecteurs
                        <span class="text-sm bg-gray-100 px-3 py-1 rounded-full text-gray-500">{{ $article->commentaires->count() }}</span>
                    </h3>

                    <div class="space-y-8 mb-16">
                        @forelse($article->commentaires as $comment)
                        <div class="flex gap-5 bg-gray-50/50 p-6 rounded-[2rem] border border-gray-50">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#1B2E58] to-[#FF9F29] flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ strtoupper(substr($comment->nom_auteur, 0, 1)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h5 class="font-black text-[#1B2E58]">{{ $comment->nom_auteur }}</h5>
                                    <span class="text-[10px] text-gray-400 uppercase font-bold">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-500 leading-relaxed text-sm">{{ $comment->contenu }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-400 italic">Soyez le premier à laisser un avis sur cet article.</p>
                        @endforelse
                    </div>

                    <!-- FORMULAIRE -->
                    <div class="bg-gray-50 p-8 md:p-10 rounded-[2.5rem]">
                        <h4 class="text-[#1B2E58] font-black text-xl mb-6 text-center">Partagez votre avis</h4>
                        {{-- Dans show.blade.php --}}

                        <form action="{{ route('blog.comment.store', $article->id_article) }}" method="POST">
                            @csrf {{-- NE PAS OUBLIER : C'est obligatoire pour le POST --}}
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <input type="text" name="nom_auteur" placeholder="Votre nom" required 
                                    class="bg-gray-50 border-none rounded-xl p-4 focus:ring-2 focus:ring-[#FF9F29]">
                                
                                <input type="email" name="email_auteur" placeholder="Votre email" required 
                                    class="bg-gray-50 border-none rounded-xl p-4 focus:ring-2 focus:ring-[#FF9F29]">
                            </div>

                            <div class="relative">
                                <textarea name="contenu" placeholder="Votre message..." required 
                                        class="w-full bg-gray-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-[#FF9F29] min-h-[150px]"></textarea>
                                
                                <button type="submit" class="absolute bottom-4 right-4 bg-[#FF9F29] text-white px-8 py-3 rounded-xl font-bold hover:scale-105 transition shadow-lg">
                                    Envoyer →
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        

            {{-- 5. ARTICLES SIMILAIRES --}}
<div class="mt-24">
    <div class="flex justify-between items-end mb-12">
        <div>
            <div class="w-16 h-1.5 bg-[#FF9F29] mb-4"></div>
            <h2 class="text-[#1B2E58] text-4xl font-black italic tracking-tighter">Les autres articles</h2>
        </div>
        <a href="{{ route('blog.index') }}" class="text-sm font-black text-[#1B2E58] border-b-2 border-[#FF9F29] pb-1">VOIR TOUT LE BLOG</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        {{-- ON UTILISE $recentArticles ICI CAR ELLE EST DÉJÀ DANS TA MÉMOIRE --}}
        @foreach($recentArticles->take(3) as $item)
        <div class="bg-white rounded-[2.5rem] overflow-hidden group shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('storage/' . $item->media) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="">
                <div class="absolute bottom-0 right-0 bg-[#1B2E58] text-white p-5">
                    <svg class="w-6 h-6 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </div>
            </div>
            <div class="p-8">
                <h4 class="text-[#1B2E58] font-black text-xl leading-tight mb-4 group-hover:text-[#FF9F29] transition uppercase tracking-tighter">
                    <a href="{{ route('blog.show', $item->slug) }}">{{ Str::limit($item->titre, 45) }}</a>
                </h4>
                <div class="flex items-center gap-2 mb-6">
                    <div class="h-[1px] w-8 bg-[#FF9F29]"></div>
                    <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest">{{ $item->categorie->nom ?? 'Expertise' }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
        </div>
    </div>
</div>
@endsection